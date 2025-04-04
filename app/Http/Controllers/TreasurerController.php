<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TreasurerController extends Controller
{


public function dashboard() {
        $firstname = session('firstname', 'Guest'); 
        $lastname = session('lastname', '');
        $role = session('role', 'Guest');
        
        $totalAmount = DB::table('createpayable')->sum('amount');
        
        $Payables = DB::table('createpayable')
        ->select(
            'description', 
            'dueDate', 
            'balance as input_balance', 
            DB::raw('COUNT(id) as student_count'),
            DB::raw('(balance * COUNT(id)) as expected_receivable') 
        )
        ->groupBy('description', 'dueDate', 'balance') 
        ->get();

    
        return view('treasurer.dashboard', compact('firstname', 'lastname', 'role', 'totalAmount', 'Payables'));
    }
    


public function getUserInfo(Request $request)
{
    return response()->json([
        'firstname' => session('firstname', 'Guest'),
        'lastname' => session('lastname', '')
    ]);
}
    
    
function expense() {
    return view ('Treasurer/expense');
}

function saveUser(Request $req) {
    $firstNameUpper = strtoupper(trim($req->firstname));
    $lastNameUpper = strtoupper(trim($req->lastname));
    $genderUpper = strtoupper(trim($req->gender));
    $yearLevelUpper = strtoupper(trim($req->yearLevel));
    $roleUpper = strtoupper(trim($req->role));
    $blockUpper = strtoupper(trim($req->block));

    DB::table('createuser')->insert([
        'IDNumber' => $req->IDNumber,
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



function Manageuser() {
    $students = DB::table('createuser')->orderBy('lastname', 'asc')->get(); 
    return view('Treasurer/manageUser', compact('students'));
}

function Payablemanagement() {
    $yearLevels = DB::table('createuser')
        ->select('yearLevel')
        ->distinct()
        ->orderByRaw("FIELD(yearLevel, '1st year', '2nd year', '3rd year', '4th year')")
        ->get();

    $Payables = DB::table('createpayable')
        ->select(
            'description', 
            'dueDate', 
            'balance as input_balance', // Changed 'amount' to 'balance'
            DB::raw('COUNT(id) as student_count'),
            DB::raw('(balance * COUNT(id)) as expected_receivable') // Using 'balance' instead of 'amount'
        )
        ->groupBy('description', 'dueDate', 'balance') // Grouping by 'balance'
        ->get();

    return view('Treasurer/payableManagement', compact('Payables', 'yearLevels'));
}

    
    public function Studentbalance() {
        $students = DB::table('createuser')
            ->select('IDNumber', 'lastname', 'firstname', 'yearLevel', 'block', 'role')
            ->orderBy('lastname', 'asc')
            ->get();
    
        \Log::info('All Students:', $students->toArray());
    
        $payables = DB::table('createpayable')
            ->select('IDNumber', DB::raw('COALESCE(SUM(amount), 0) as total_balance'))
            ->groupBy('IDNumber')
            ->get()
            ->keyBy('IDNumber');
    
        $yearLevels = DB::table('createuser')
            ->select('yearLevel')
            ->distinct()
            ->orderByRaw("FIELD(yearLevel, '1st year', '2nd year', '3rd year', '4th year')")
            ->get();
    
        $blocks = DB::table('createuser')
            ->select('block')
            ->distinct()
            ->orderBy('block')
            ->get();
    
        $representatives = [];
        foreach ($students as $student) {
            if (strtolower($student->role) === 'representative') { 
                $key = strtoupper($student->yearLevel) . '-' . strtoupper($student->block);
                $representatives[$key] = $student->firstname . ' ' . $student->lastname; 
            }
        }
    
        return view('Treasurer/studentBalance', compact('students', 'payables', 'yearLevels', 'blocks', 'representatives'));
    }
    
    
    function Collection() {
        $students = DB::table('createuser')
        ->whereIn('role', ['REPRESENTATIVE', 'STUDENT']) 
            ->orderBy('lastname', 'asc')
            ->get(); 
    
        $payables = DB::table('createpayable')
            ->orderBy('amount', 'asc')
            ->get(); 
    
        return view('Treasurer/collection', compact('students', 'payables'));
    }
    
function Createpayable() {
    $yearLevels = DB::table('createuser')
        ->select('yearLevel')
        ->distinct()
        ->orderByRaw("FIELD(yearLevel, '1st year', '2nd year', '3rd year', '4th year')")
        ->get();

    return view('Treasurer/createPayable', compact('yearLevels'));
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
    $student = $req->IDNumber;

    $query = DB::table('createuser')
    ->whereIn('role', ['student', 'representative'])
    ->select('IDNumber', 'yearLevel', 'block', 'firstname', 'lastname', 'role'); 

    if ($yearLevel !== "all") {
        $query->where('yearLevel', $yearLevel);
    }

    if ($block !== "all") {
        $query->where('block', $block);
    }

    if ($student !== "all") {
        $query->where('IDNumber', $student); 
    }

    $students = $query->get();

    foreach ($students as $stud) {
        $fullName = strtoupper(trim(($stud->firstname ?? '') . ' ' . ($stud->lastname ?? ''))); 
        $yearLevelUpper = strtoupper($stud->yearLevel);
        $blockUpper = strtoupper($stud->block);
        $descriptionUpper = strtoupper($req->description);
        $amount = $req->amount;
        $dueDate = $req->dueDate;
        $role = strtoupper($stud->role);

        $existingPayable = DB::table('createpayable')
            ->where('IDNumber', $stud->IDNumber)
            ->where('description', $descriptionUpper)
            ->where('dueDate', $dueDate)
            ->first();

        if ($existingPayable) {
            DB::table('createpayable')
                ->where('IDNumber', $stud->IDNumber)
                ->where('description', $descriptionUpper)
                ->where('dueDate', $dueDate)
                ->update([
                    'amount' => $existingPayable->amount + $amount
                ]);
        } else {
            DB::table('createpayable')->insert([
                'description' => $descriptionUpper,
                'amount' => $amount,
                'balance' => $amount,
                'dueDate' => $dueDate,
                'yearLevel' => $yearLevelUpper,
                'block' => $blockUpper,
                'IDNumber' => $stud->IDNumber,
                'studentName' => $fullName,
                'role' => $role,

            ]);
        }
    }

    return redirect()->back()->with('success', 'PAYABLES SUCCESSFULLY ADDED FOR SELECTED STUDENTS.');
}

public function ArchiveUser() {
    $students = DB::table('createuser')->get();
    $archivedStudents = DB::table('archive')->get(); 

    return view('Treasurer/archiveUser', compact('students', 'archivedStudents'));
}
public function archiveUsers(Request $request) {
    $selectedStudents = $request->input('students');

    if (!$selectedStudents) {
        return redirect()->back()->with('error', 'No students selected.');
    }

    $students = DB::table('createuser')->whereIn('IDNumber', $selectedStudents)->get();

    foreach ($students as $student) {
        DB::table('archive')->insert([
            'IDNumber' => $student->IDNumber,
            'firstname' => $student->firstname,
            'lastname' => $student->lastname,
            'gender' => $student->gender,
            'yearLevel' => $student->yearLevel,
            'role' => $student->role,
            'block' => $student->block,
            'username' => $student->username,
            'password' => $student->password,
            'status' => 'DEACTIVATED', 
        ]);
    }

    DB::table('createuser')->whereIn('IDNumber', $selectedStudents)->delete();

    return redirect()->back()->with('success', 'Selected students archived successfully.');
}

public function getStudentPayables($studentId)
{
    $payables = DB::table('createpayable')
        ->where('IDNumber', $studentId)
        ->select('IDNumber', 'description', 'amount', 'id') 
        ->get();

    return response()->json($payables);
}

public function savePayment(Request $req) {
    $student_id = $req->student_id;
    $payable_ids = $req->payable_id;
    $amounts_paid = $req->amount_paid;
    $date = $req->date;

    if (!$student_id || !$payable_ids || !$amounts_paid || !$date) {
        return back()->with('error', 'All fields are required.');
    }

    $payable_ids = is_array($payable_ids) ? $payable_ids : [$payable_ids];
    $amounts_paid = is_array($amounts_paid) ? $amounts_paid : [$amounts_paid];

    $collectedBy = session('firstname') . ' ' . session('lastname');
    $collectorRole = session('role'); 

    foreach ($payable_ids as $index => $payable_id) {
        $payable = DB::table('createpayable')->where('id', $payable_id)->first();

        if ($payable) {
            $amount_paid = floatval($amounts_paid[$index] ?? 0);

            if ($amount_paid <= 0) {
                continue;
            }

            if ($amount_paid > $payable->balance) {
                return back()->with('error', 'Amount paid exceeds payable amount.');
            }

            // Update the remaining balance in createpayable
            $newBalance = $payable->balance - $amount_paid;
            DB::table('createpayable')->where('id', $payable_id)->update([
                'amount' => $newBalance
            ]);

            $description = $payable->description;
            $studentName = $payable->studentName;

            $nameParts = explode(' ', trim($studentName), 2);
            $firstname = $nameParts[0] ?? 'N/A';
            $lastname = $nameParts[1] ?? 'N/A';

            // Determine status based on role
            $status = ($collectorRole === 'REPRESENTATIVE') ? 'PENDING' : 'REMITTED';

            // Always insert a new row regardless of role
            DB::table('remittance')->insert([
                'firstname' => $firstname,
                'lastname' => $lastname,
                'yearLevel' => $payable->yearLevel,
                'block' => $payable->block,
                'description' => $description,
                'paid' => $amount_paid,
                'status' => $status,
                'date' => $date,
                'role' => $payable->role,
                'collectedBy' => $collectedBy
            ]);
        }
    }

    return redirect()->back()->with('success', 'Payment saved successfully.');
}


function Remitted() {
    $remittances = DB::table('remittance')
        ->leftJoin('createuser', function ($join) {
            $join->on('remittance.yearLevel', '=', 'createuser.yearLevel')
                 ->on('remittance.block', '=', 'createuser.block')
                 ->where('createuser.role', '=', 'REPRESENTATIVE');
        })
        ->select('remittance.*', 'remittance.firstname', 'remittance.lastname')
        ->orderBy('remittance.date', 'asc')
        ->get();
    $balances = DB::table('createpayable')
        ->select('balance', 'description', 'yearLevel', 'block')
        ->get();

    foreach ($remittances as $remittance) {
        $matchingAmount = $balances->firstWhere(function ($payable) use ($remittance) {
            return $payable->description === $remittance->description
                && $payable->yearLevel === $remittance->yearLevel
                && $payable->block === $remittance->block;
        });

        $remittance->balance = $matchingAmount ? $matchingAmount->balance : 0;
    }

    $representative = DB::table('createuser')
        ->where('role', 'REPRESENTATIVE')
        ->select('firstname', 'lastname', 'yearLevel', 'block')
        ->first();

    return view('Treasurer/remitted', compact('remittances', 'representative'));
}

public function userDetails()
    {
        $role = session('role', 'Guest');
        $firstname = session('firstname', ''); 
        $lastname = session('lastname', '');
        $yearLevel = session('yearLevel', '');
        $block = session('block', '');
        $gender = session('gender', '');
        $username = session('username', '');
        $password = session('password', '');
    
        return view('Treasurer.userDetails', compact('firstname', 'lastname', 'role','yearLevel','block' ,'username','password','gender'));
       
}


public function showLedger($id)
{
    $student = DB::table('createuser')
        ->where('IDNumber', $id)
        ->first();

    $payables = DB::table('createpayable')
        ->where('IDNumber', $id)
        ->select('description', DB::raw('COALESCE(SUM(amount), 0) as total_balance'))
        ->groupBy('description', 'IDNumber')
        ->get();

    $settledPayables = DB::table('remittance')
        ->where('role', 'student')
        ->where('lastname', $student->lastname)
        ->where('yearLevel', $student->yearLevel)
        ->where('block', $student->block)
        ->get();

    \Log::info('Settled Payables:', $settledPayables->toArray());

    return view('Treasurer.studentLedger', compact('student', 'payables', 'settledPayables'));
}




public function saveUserImage(Request $request)
{
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'IDNumber' => 'required'
    ]);

    $image = $request->file('image');
    $filename = $request->IDNumber . '_' . time() . '.' . $image->getClientOriginalExtension();

    // Save image to public/user_images/
    $destinationPath = public_path('user_images');
    $image->move($destinationPath, $filename);

    // Update the createuser table (not users)
    DB::table('createuser')->where('IDNumber', $request->IDNumber)->update(['profile_image' => $filename]);

    return redirect()->back()->with('success', 'Profile image uploaded successfully.');
}
}
