<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class TreasurerController extends Controller
{
function Login() {
    return view ('login');
}

function CreateUser() {
    return view ('createUser');
}

function saveUser(Request $req) {
    // Convert only specific fields to uppercase
    $firstNameUpper = strtoupper(trim($req->firstname));
    $lastNameUpper = strtoupper(trim($req->lastname));
    $genderUpper = strtoupper(trim($req->gender));
    $yearLevelUpper = strtoupper(trim($req->yearLevel));
    $roleUpper = strtoupper(trim($req->role));
    $blockUpper = strtoupper(trim($req->block));

    DB::table('createuser')->insert([
        'id' => $req->id,
        'firstname' => $firstNameUpper,
        'lastname' => $lastNameUpper,
        'gender' => $genderUpper,
        'yearLevel' => $yearLevelUpper,
        'role' => $roleUpper,
        'block' => $blockUpper,
        'username' => $req->username,
        'password' => Hash::make($req->password) 
    ]);

    return redirect()->back()->with('success', 'Successfully created a user');
}



function Dashboard() {
    return view ('dashboard');
}



function Manageuser() {
    $students = DB::table('createuser')->orderBy('lastname', 'asc')->get(); 
    return view('manageUser', compact('students'));
}

function Payablemanagement() {
    $Payables = DB::table('createpayable')
        ->select(
            'description', 
            'dueDate', 
            'amount as input_amount', 
            DB::raw('COUNT(student) as student_count'),
            DB::raw('(amount * COUNT(student)) as expected_receivable') 
        )
        ->groupBy('description', 'dueDate', 'amount')
        ->get();

    return view('payableManagement', compact('Payables'));
}



function Createpayable() {
    $yearLevels = DB::table('createuser')
        ->select('yearLevel')
        ->distinct()
        ->orderByRaw("FIELD(yearLevel, '1st year', '2nd year', '3rd year', '4th year')")
        ->get();

    return view('createPayable', compact('yearLevels'));
}   
function getStudentsAndBlocks(Request $request) {
    $yearLevel = $request->yearLevel;

    $students = DB::table('createuser')
        ->where('role', 'student')
        ->where('yearLevel', $yearLevel)
        ->get();

    $blocks = DB::table('createuser')
        ->where('yearLevel', $yearLevel)
        ->select('block')
        ->distinct()
        ->orderBy('block', 'asc')
        ->get();

    return response()->json(['students' => $students, 'blocks' => $blocks]);
}


function savePayable(Request $req) {
    $yearLevel = $req->yearLevel;
    $block = $req->block;
    $student = $req->student;

    $query = DB::table('createuser')
        ->where('role', 'student')
        ->select('id', 'yearLevel', 'block', 'firstName', 'lastName');

    if ($yearLevel !== "all") {
        $query->where('yearLevel', $yearLevel);
    }

    if ($block !== "all") {
        $query->where('block', $block);
    }

    if ($student !== "all") {
        $query->where('id', $student);
    }

    $students = $query->get();

    foreach ($students as $stud) {
        $fullName = strtoupper(trim(($stud->firstName ?? '') . ' ' . ($stud->lastName ?? ''))); // Convert to uppercase
        $yearLevelUpper = strtoupper($stud->yearLevel);
        $blockUpper = strtoupper($stud->block);
        $descriptionUpper = strtoupper($req->description);

        DB::table('createpayable')->insert([
            'description' => $descriptionUpper,
            'amount' => $req->amount,
            'dueDate' => $req->dueDate,
            'yearLevel' => $yearLevelUpper,
            'block' => $blockUpper,
            'student' => $stud->id,
            'studentName' => $fullName
        ]);
    }

    return redirect()->back()->with('success', 'PAYABLES SUCCESSFULLY ADDED FOR SELECTED STUDENTS.');
}

function Studentbalance() {
    $students = DB::table('createuser')->orderBy('lastname', 'asc')->get(); 
    $payables = DB::table('createpayable')->orderBy('amount', 'asc')->get(); 
    return view('studentBalance', compact('students', 'payables'));
}

function Collection() {
    $students = DB::table('createuser')->orderBy('lastname', 'asc')->get(); 
    $payables = DB::table('createpayable')->orderBy('amount', 'asc')->get(); 
    return view('collection', compact('students', 'payables'));


}

public function ArchiveUser() {
    $students = DB::table('createuser')->get();
    $archivedStudents = DB::table('archive')->get(); // Fetch archived users

    return view('archiveUser', compact('students', 'archivedStudents'));
}
public function archiveUsers(Request $request) {
    $selectedStudents = $request->input('students');

    if (!$selectedStudents) {
        return redirect()->back()->with('error', 'No students selected.');
    }

    $students = DB::table('createuser')->whereIn('id', $selectedStudents)->get();

    foreach ($students as $student) {
        DB::table('archive')->insert([
            'firstname' => $student->firstname,
            'lastname' => $student->lastname,
            'gender' => $student->gender,
            'yearLevel' => $student->yearLevel,
            'role' => $student->role,
            'block' => $student->block,
            'username' => $student->username,
            'password' => $student->password,
        ]);
    }

    DB::table('createuser')->whereIn('id', $selectedStudents)->delete();

    return redirect()->back()->with('success', 'Selected students archived successfully.');
}

public function getStudentPayables($studentId)
{
    $payables = DB::table('createpayable')
        ->where('student', $studentId)
        ->select('id', 'description', 'amount')
        ->get();

    return response()->json($payables);
}


public function savePayment(Request $req) {
    $student_id = $req->student_id;
    $payable_ids = $req->payable_id;
    $amounts_paid = $req->amount_paid;

    if (!$student_id || !$payable_ids || !$amounts_paid) {
        return response()->json(['success' => false, 'error' => 'Missing required fields']);
    }

    // Convert to array format
    $payable_ids = is_array($payable_ids) ? $payable_ids : [$payable_ids];
    $amounts_paid = is_array($amounts_paid) ? $amounts_paid : [$amounts_paid];

    $student = DB::table('createuser')->where('id', $student_id)->first();

    if (!$student) {
        return response()->json(['success' => false, 'error' => 'Student not found!']);
    }

    $totalPaid = 0;
    $description = '';

    foreach ($payable_ids as $index => $payable_id) {
        $payable = DB::table('createpayable')->where('id', $payable_id)->first();

        if ($payable) {
            $amount_paid = floatval($amounts_paid[$index] ?? 0);

            if ($amount_paid > $payable->amount) {
                return response()->json(['success' => false, 'error' => 'Payment exceeds remaining balance!']);
            }

            // Update payable balance
            $newBalance = $payable->amount - $amount_paid;
            DB::table('createpayable')->where('id', $payable_id)->update([
                'amount' => $newBalance
            ]);

            // Sum up the total paid amount
            $totalPaid += $amount_paid;
            $description .= $payable->description . ', ';
        }
    }

    // Remove trailing comma
    $description = rtrim($description, ', ');

    // Save the payment record in remittance table
    DB::table('remittance')->insert([
        'firstname' => $student->firstname,
        'lastname' => $student->lastname,
        'description' => $description,
        'paid' => $totalPaid,
        'status' => 'Pending',
        'date' => now()
    ]);

      return redirect()->back()->with('success', 'Selected students archived successfully.');
}








}
