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
            'balance as input_balance', 
            DB::raw('COUNT(id) as student_count'),
            DB::raw('(balance * COUNT(id)) as expected_receivable') 
        )
        ->groupBy('description', 'dueDate', 'balance') 
        ->get();

    return view('Treasurer/payableManagement', compact('Payables', 'yearLevels'));
}

    
    public function Studentbalance() {
        $students = DB::table('createuser')
        ->select('IDNumber', 'lastname', 'firstname', 'yearLevel', 'block', 'role')
        ->whereIn('role', ['student', 'treasurer', 'representative'])
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
        ->whereIn('role', ['representative', 'student','treasurer']) 
            ->orderBy('lastname', 'asc')
            ->get(); 

        return view('Treasurer/collection', compact('students'));
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
        ->whereIn('role', ['student', 'representative', 'treasurer'])
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
    ->whereIn('role', ['student', 'representative','treasurer'])
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


public function SavePayment(Request $req) {
    $studentId = $req->student_id;
    $payableIds = $req->payable_id;
    $amountsPaid = $req->amount_paid;
    $date = $req->date;

    if (!$studentId || !$payableIds || !$amountsPaid || !$date) {
        return back()->with('error', 'All fields are required.');
    }

    $payableIds = is_array($payableIds) ? $payableIds : [$payableIds];
    $amountsPaid = is_array($amountsPaid) ? $amountsPaid : [$amountsPaid];

    $role = session('role');
    $collectedBy = session('firstname') . ' ' . session('lastname');

    DB::beginTransaction();

    try {
        foreach ($payableIds as $index => $payableId) {
            $payable = DB::table('createpayable')->where('id', $payableId)->first();

            if ($payable) {
                $amountPaid = floatval($amountsPaid[$index] ?? 0);

                if ($amountPaid <= 0) {
                    continue;  
                }
                if ($amountPaid > $payable->amount) {
                    return back()->with('error', 'Amount paid exceeds payable amount.');
                }

                $newBalance = $payable->amount - $amountPaid;

                DB::table('createpayable')->where('id', $payableId)->update([
                    'amount' => $newBalance
                ]);

                list($firstname, $lastname) = explode(' ', trim($payable->studentName), 2) + ['N/A', 'N/A'];

                $existingPayment = DB::table('remittance')
                    ->where('firstname', $firstname)
                    ->where('lastname', $lastname)
                    ->where('description', $payable->description)
                    ->where('date', $date)
                    ->first();

                $status = ($role == 'REPRESENTATIVE') ? 'PENDING' : 'REMITTED';

                if ($existingPayment) {
                    $newPaidAmount = $existingPayment->paid + $amountPaid;

                    DB::table('remittance')->where('id', $existingPayment->id)->update([
                        'paid' => $newPaidAmount,
                    ]);
                } else {
                    DB::table('remittance')->insert([
                        'firstname' => $firstname,
                        'lastname' => $lastname,
                        'yearLevel' => $payable->yearLevel,
                        'block' => $payable->block,
                        'description' => $payable->description,
                        'paid' => $amountPaid,
                        'status' => $status,  
                        'date' => $date,
                        'role' => $role,
                        'collectedBy' => $collectedBy
                    ]);
                }
            }
        }

        DB::commit();

        return redirect()->back()->with('success', 'Payment saved successfully.');
    } catch (\Exception $e) {
        DB::rollBack();

        return back()->with('error', 'An error occurred while saving the payment.');
    }
}

public function Remitted()
{
    $userYearLevel = session('yearLevel');
    $userBlock = session('block');
    
    $remittances = DB::table('remittance')
        ->leftJoin('createuser', function ($join) {
            $join
                 ->on('remittance.block', '=', 'createuser.block')
                 ->whereIn('createuser.role', ['TREASURER', 'REPRESENTATIVE']);
        })
        ->select(
            'remittance.*',
            'createuser.yearLevel as userYearLevel',
            'createuser.block as userBlock',
            'remittance.firstname',
            'remittance.lastname',
            'remittance.collectedBy'
        )
        ->where('remittance.yearLevel', $userYearLevel)  
        ->where('remittance.block', $userBlock)  
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

    $paids = DB::table('remittance')
    ->select('paid', 'description', 'yearLevel', 'block', 'date' ,'collectedBy') 
    ->get();

foreach ($remittances as $remittance) {
    $matchingAmount = $paids->firstWhere(function ($payable) use ($remittance) {
        return $payable->description === $remittance->description
            && $payable->yearLevel === $remittance->yearLevel
            && $payable->block === $remittance->block
            && $payable->date === $remittance->date
            && $payable->collectedBy === $remittance->collectedBy;
    });
 

    $remittance->paid = $matchingAmount ? $matchingAmount->paid : 0;
}


    $collectors = DB::table('createuser')
        ->whereIn('role', ['TREASURER', 'REPRESENTATIVE'])
        ->select('firstname', 'lastname', 'role', 'yearLevel', 'block')
        ->get();

        return view('treasurer.remitted', compact('remittances', 'collectors', 'balances','paids'));
}




public function getStudentsWhoPaid(Request $request)
{
    $date = $request->input('date');
    $collectedBy = $request->input('collectedBy');
    $description = $request->input('description');

    // Log the incoming request (optional for debugging)
    \Log::info("Fetching students for:", [
        'date' => $date,
        'collectedBy' => $collectedBy,
        'description' => $description,
    ]);

    $students = DB::table('remittance')
        ->whereDate('date', $date)
        ->where('collectedBy', $collectedBy)
        ->where('description', $description)
        ->select('firstname', 'lastname', 'yearLevel', 'block', 'paid', 'status')
        ->get();

    // Return as JSON
    return response()->json($students);
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
    // Get student details
    $student = DB::table('createuser')
        ->where('IDNumber', $id)
        ->first();

    // Get remaining balances grouped by description
    $payables = DB::table('createpayable')
        ->where('IDNumber', $id)
        ->select('description', DB::raw('COALESCE(SUM(amount), 0) as total_balance'))
        ->groupBy('description')
        ->get();

    // Fix: Use 'id' if 'remittance' table uses that instead of 'IDNumber'
    $settledPayables = DB::table('remittance')
        ->where('id', $id)
        ->where('role', 'student')
        ->select('date', 'description', 'paid', 'collectedBy', 'status')
        ->orderBy('date', 'asc')
        ->get();

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
