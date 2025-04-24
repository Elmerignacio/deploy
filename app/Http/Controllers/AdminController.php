<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{    
     
        public function AdDashboard()
        {
            $firstname = session('firstname', 'Guest');
            $lastname = session('lastname', '');
            $role = session('role', 'Guest');
        
            $totalAmount = DB::table('createpayable')->sum('amount');
        
            $totalExpenses = DB::table('expenses')->sum('amount');  
        
    
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
        
            $cashOnHand = DB::table('funds')->value('cash_on_hand');
        
            $profile = DB::table('avatar')
                ->where('student_id', session('id'))
                ->select('profile')
                ->first();
        
            return view('admin.AdDashboard', compact('profile', 'firstname', 'lastname', 'role', 'totalAmount', 'Payables', 'cashOnHand', 'totalExpenses'));
        }
        
    
    
        public function getUserInfo(Request $request)
        {
            return response()->json([
                'firstname' => session('firstname', 'Guest'),
                'lastname' => session('lastname', '')
            ]);
        }
        public function AdExpense()
        {
            $availableDescriptions = DB::table('available_description')
            ->select('description', 'total_amount_collected')
            ->get();
    
        $paidData = [];
        foreach ($availableDescriptions as $item) {
            $paidData[$item->description] = $item->total_amount_collected;
        }
    
        $expenses = DB::table('expenses')
            ->select('description', 'quantity', 'label', 'price', 'amount', 'date', 'source')
            ->get();
    
        $groupedExpenses = $expenses->groupBy(function ($item) {
            return $item->date;
        });

        foreach ($groupedExpenses as $date => $expensesForDate) {
            $groupedExpenses[$date] = $expensesForDate->groupBy('source');
        }
        $sourcesByDate = [];
        foreach ($groupedExpenses as $date => $expensesForDate) {
            $sourcesByDate[$date] = array_keys($expensesForDate->toArray()); 
        }
        $profile = DB::table('avatar')
            ->where('student_id', session('id'))
            ->select('profile')
            ->first();
    
        $firstname = session('firstname');
        $lastname = session('lastname');
    
        return view('admin.AdExpense', compact('firstname', 'lastname', 'paidData', 'groupedExpenses', 'profile', 'sourcesByDate') + [
            'descriptions' => $availableDescriptions->pluck('description'),
        ]);
    
        }
        
    public function getAdExpensesByDateAndSource($date, $source)
    {
        
        $expenses = DB::table('expenses')
            ->whereDate('date', $date)
            ->where('source', $source)
            ->get(['description', 'amount']);
        
        return response()->json($expenses); 
    }

    public function AddStoreExpense(Request $request)
    {
        $request->validate([
            'description' => 'required|string',
            'date' => 'required|date',
            'items' => 'required|array',
            'items.*.description' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.label' => 'required|string',
            'items.*.price' => 'required|numeric|min:0',
            'items.*.amount' => 'required|numeric|min:0',
        ]);

        $description = $request->description;
        $date = $request->date;
        $totalAmount = 0;

        foreach ($request->items as $item) {
            DB::table('expenses')->insert([
                'description' => $item['description'],
                'quantity' => $item['quantity'],
                'label' => $item['label'],
                'price' => $item['price'],
                'amount' => $item['amount'],
                'date' => $date,
                'source' => $description,
            ]);
            $totalAmount += $item['amount'];
        }

        DB::table('available_description')
            ->where('description', $description)
            ->decrement('total_amount_collected', $totalAmount);

        DB::table('funds')
            ->decrement('cash_on_hand', $totalAmount);

        return redirect()->back()->with('success', 'Expenses recorded and balance updated.');
    }    
    
        function AdManageUser()
        {
            $students = DB::table('createuser')
            ->where('role', '!=', 'admin')  
            ->orderBy('lastname', 'asc')
            ->get();
        
    
            $profile = DB::table('avatar')
                ->where('student_id', session('id'))
                ->select('profile')
                ->first();
    
                $firstname = session('firstname');
                $lastname = session('lastname');
            return view('Admin/AdManageUser', compact('students', 'profile', 'firstname', 'lastname'));
        }
    
        function AdPayableManagement()
        {
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
    
            $profile = DB::table('avatar')
                ->where('student_id', session('id'))
                ->select('profile')
                ->first();
    
                $firstname = session('firstname');
                $lastname = session('lastname');
            return view('Admin/AdPayableManagement', compact('Payables', 'yearLevels', 'profile', 'firstname', 'lastname'));
        }
    
        public function AdStudentBalance()
        {
            $students = DB::table('createuser')
                ->select('IDNumber', 'lastname', 'firstname', 'yearLevel', 'block', 'role')
                ->whereIn('role', ['student', 'treasurer', 'representative'])
                ->orderBy('lastname', 'asc')
                ->get();
    
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
                    $key = strtoupper($student->yearLevel) . ' - ' . strtoupper($student->block);
                    $representatives[$key] = $student->firstname . ' ' . $student->lastname;
                }
            }
    
            $cashOnHand = [];
            $remittancesCash = DB::table('remittance')
                ->select('collectedBy', DB::raw('SUM(paid) as total_paid'))
                ->whereIn('status', ['COLLECTED', 'TO TREASURER'])
                ->groupBy('collectedBy')
                ->get();
    
            foreach ($remittancesCash as $remit) {
                $cashOnHand[$remit->collectedBy] = $remit->total_paid;
            }
    
    
            $remitted = [];
            $remittancesRemitted = DB::table('remittance')
                ->select('collectedBy', DB::raw('SUM(paid) as total_remitted'))
                ->where('status', 'REMITTED')
                ->groupBy('collectedBy')
                ->get();
    
            foreach ($remittancesRemitted as $remit) {
                $remitted[$remit->collectedBy] = $remit->total_remitted;
            }
    
            $profile = DB::table('avatar')
                ->where('student_id', session('id'))
                ->select('profile')
                ->first();
    
                $firstname = session('firstname');
                $lastname = session('lastname');
    
            return view('Admin.AdStudentBalance', compact(
                'students',
                'payables',
                'yearLevels',
                'blocks',
                'representatives',
                'cashOnHand',
                'remitted',
                'profile',
                'firstname',
                'lastname'
            ));
        }
    
    

        function Createpayable()
        {
            $yearLevels = DB::table('createuser')
                ->select('yearLevel')
                ->distinct()
                ->orderByRaw("FIELD(yearLevel, '1st year', '2nd year', '3rd year', '4th year')")
                ->get();
    
            $profile = DB::table('avatar')
                ->where('student_id', session('id'))
                ->select('profile')
                ->first();
    
                $firstname = session('firstname');
                $lastname = session('lastname');
    
            return view('Admin/createPayable', compact('yearLevels', 'profile' , 'firstname', 'lastname'));
        }

    
        function savePayable(Request $req)
        {
            $yearLevel = $req->yearLevel;
            $block = $req->block;
            $student = $req->IDNumber;
    
            $query = DB::table('createuser')
                ->whereIn('role', ['student', 'representative', 'treasurer'])
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
    
        public function AdArchiveUser()
        {
            $students = DB::table('createuser')->get();
            $archivedStudents = DB::table('archive')->get();
    
            $profile = DB::table('avatar')
                ->where('student_id', session('id'))
                ->select('profile')
                ->first();
    
                $firstname = session('firstname');
                $lastname = session('lastname');
    
            return view('Admin/AdArchiveUser', compact('students', 'archivedStudents', 'profile','firstname','lastname'));
        }
        public function archiveUsers(Request $request)
        {
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
    
    
        public function SavePayment(Request $req)
        {
            \Log::info('Request data:', $req->all());
    
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
    
                        $status = ($role == 'REPRESENTATIVE') ? 'COLLECTED' : 'COLLECTED BY TREASURER';
    
                        \Log::info('Processing payment for: ' . $firstname . ' ' . $lastname . ' with status ' . $status);
    
                        $existingPayment = DB::table('remittance')
                            ->where('firstName', $firstname)
                            ->where('lastName', $lastname)
                            ->where('description', $payable->description)
                            ->where('date', $date)
                            ->where('collectedBy', $collectedBy)
                            ->where('status', $status)
                            ->first();
    
                        if (!$existingPayment) {
                            DB::table('remittance')->insert([
                                'IDNumber' => $payable->IDNumber,
                                'firstName' => $firstname,
                                'lastName' => $lastname,
                                'yearLevel' => $payable->yearLevel,
                                'block' => $payable->block,
                                'description' => $payable->description,
                                'paid' => $amountPaid,
                                'role' => $role,
                                'date' => $date,
                                'status' => $status,
                                'date_remitted' => $date,
                                'collectedBy' => $collectedBy,
                                'created_at' => now(),
                                'updated_at' => now()
                            ]);
                        } else {
                            $newPaidAmount = $existingPayment->paid + $amountPaid;
    
                            DB::table('remittance')->where('id', $existingPayment->id)->update([
                                'paid' => $newPaidAmount,
                                'updated_at' => now()
                            ]);
                        }
                    }
                }
    
                DB::commit();
                \Log::info('Payment saved successfully.');
                return redirect()->back()->with('success', 'Payment saved successfully.');
            } catch (\Exception $e) {
                DB::rollBack();
                \Log::error('Error while saving payment: ' . $e->getMessage());
                return back()->with('error', 'An error occurred while saving the payment.');
            }
        }
    
 
    
    
        public function AdUserDetails()
        {
            $role = session('role', 'Guest');
            $id = session('id', '');
            $firstname = session('firstname', '');
            $lastname = session('lastname', '');
            $yearLevel = session('yearLevel', '');
            $block = session('block', '');
            $gender = session('gender', '');
            $username = session('username', '');
            $password = session('password', '');
    
            $profile = DB::table('avatar')
                ->where('student_id', $id)
                ->select('profile')
                ->first();
            //    dd()
    
    
    
            return view('Admin.AdUserDetails', compact('profile', 'id', 'firstname', 'lastname', 'role', 'yearLevel', 'block', 'username', 'password', 'gender'));
        }
    
    
        public function AdStudentLedger($id)
        {
            $student = DB::table('createuser')
                ->where('IDNumber', $id)
                ->first();
    
            $payables = DB::table('createpayable')
                ->where('IDNumber', $id)
                ->select('description', DB::raw('COALESCE(SUM(amount), 0) as total_balance'))
                ->groupBy('description')
                ->get();
    
            $settledPayables = DB::table('remittance')
                ->where('IDNumber', $id)
                ->select('date', 'description', 'paid', 'collectedBy', 'status')
                ->orderBy('date', 'asc')
                ->get();
    
            $profile = DB::table('avatar')
                ->where('student_id', session('id'))
                ->select('profile')
                ->first();
    
                $firstname = session('firstname');
                $lastname = session('lastname');
    
            return view('Admin.AdStudentLedger', compact('student', 'payables', 'settledPayables', 'profile','firstname','lastname'));
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
        
    
    
    
        public function saveUserImage(Request $request)
        {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'IDNumber' => 'required'
            ]);
    
            $image = $request->file('image');
            $filename = $request->IDNumber . '_' . time() . '.' . $image->getClientOriginalExtension();
    
            $destinationPath = public_path('user_images');
            $image->move($destinationPath, $filename);
    
            DB::table('createuser')->where('IDNumber', $request->IDNumber)->update(['profile_image' => $filename]);
    
            return redirect()->back()->with('success', 'Profile image uploaded successfully.');
        }
    
    
    
        public function Adchange(Request $request)
        {
    
            $userId = session('id', '');
    
            if (!$userId) {
                return redirect()->route('login')->with('error', 'You need to be logged in.');
            }
    
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|string|min:3|confirmed',
            ]);
    
    
            $user = DB::table('createuser')
                ->where('id', $userId)
                ->first();
    
    
            if (!$user) {
                return back()->with('error', 'User not found.');
            }
    
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->with('error', 'Current password is incorrect.');
            }
    
    
            DB::table('createuser')
                ->where('id', $user->id)
                ->update([
                    'password' => Hash::make($request->new_password),
                ]);
    
    
            return back()->with('success', 'Password changed successfully.');
        }
    
        
function AdsaveUser(Request $req) {
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
    
    
    
    
}
