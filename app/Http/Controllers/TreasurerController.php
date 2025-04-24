<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TreasurerController extends Controller
{

    public function dashboard()
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
    
        return view('treasurer.dashboard', compact('profile', 'firstname', 'lastname', 'role', 'totalAmount', 'Payables', 'cashOnHand', 'totalExpenses'));
    }

    public function getUserInfo(Request $request)
    {
        return response()->json([
            'firstname' => session('firstname', 'Guest'),
            'lastname' => session('lastname', '')
        ]);
    }
    public function expense()
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
    
        return view('Treasurer.expense', compact('firstname', 'lastname', 'paidData', 'groupedExpenses', 'profile', 'sourcesByDate') + [
            'descriptions' => $availableDescriptions->pluck('description'),
        ]);
    }
    
    
    public function getExpensesByDateAndSource($date, $source)
    {
        
        $expenses = DB::table('expenses')
            ->whereDate('date', $date)
            ->where('source', $source)
            ->get(['description', 'amount']);
        
        return response()->json($expenses); 
    }
    
    public function storeExpense(Request $request)
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


    function Manageuser()
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
        return view('Treasurer/manageUser', compact('students', 'profile', 'firstname', 'lastname'));
    }

    function Payablemanagement()
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
        return view('Treasurer/payableManagement', compact('Payables', 'yearLevels', 'profile', 'firstname', 'lastname'));
    }

    public function Studentbalance()
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

        return view('Treasurer.studentBalance', compact(
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


    public function Collection()
    {
        $students = DB::table('createuser')
            ->whereIn('role', ['representative', 'student', 'treasurer'])
            ->orderBy('lastname', 'asc')
            ->get();

        $profile = DB::table('avatar')
            ->where('student_id', session('id'))
            ->select('profile')
            ->first();

        $firstname = session('firstname');
        $lastname = session('lastname');



        return view('Treasurer/collection', compact('students', 'profile', 'firstname', 'lastname'));
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

        return view('Treasurer/createPayable', compact('yearLevels', 'profile' , 'firstname', 'lastname'));
    }
    function getStudentsAndBlocks(Request $request)
    {
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

    public function ArchiveUser()
    {
        $students = DB::table('createuser')->get();
        $archivedStudents = DB::table('archive')->get();

        $profile = DB::table('avatar')
            ->where('student_id', session('id'))
            ->select('profile')
            ->first();

            $firstname = session('firstname');
            $lastname = session('lastname');

        return view('Treasurer/archiveUser', compact('students', 'archivedStudents', 'profile','firstname','lastname'));
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


    public function Remitted()
    {
        $userYearLevel = session('yearLevel');
        $userBlock = session('block');

        $remittances = DB::table('remittance')
            ->leftJoin('createuser', function ($join) {
                $join->on('remittance.yearLevel', '=', 'createuser.yearLevel')
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
            ->orderBy('remittance.date_remitted', 'asc')
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
            ->select('paid', 'description', 'yearLevel', 'block', 'date', 'collectedBy', 'status')
            ->get();

        $collectors = DB::table('createuser')
            ->whereIn('role', ['TREASURER', 'REPRESENTATIVE'])
            ->select('firstname', 'lastname', 'role', 'yearLevel', 'block')
            ->get();

        $profile = DB::table('avatar')
            ->where('student_id', session('id'))
            ->select('profile')
            ->first();

            $firstname = session('firstname');
            $lastname = session('lastname');

        return view('treasurer.remitted', compact('remittances', 'collectors', 'balances', 'paids', 'profile','firstname','lastname'));
    }

    public function CashOnHand()
    {
        $remittances = DB::table('remittance')
            ->leftJoin('createuser', function ($join) {
                $join->on('remittance.yearLevel', '=', 'createuser.yearLevel')
                    ->on('remittance.block', '=', 'createuser.block')
                    ->on('remittance.role', '=', 'createuser.role')
                    ->whereIn('createuser.role', ['TREASURER', 'REPRESENTATIVE']);
            })
            ->select(
                'remittance.*',
                'createuser.yearLevel as userYearLevel',
                'createuser.block as userBlock',
                'remittance.collectedBy'
            )
            ->whereIn('remittance.status', ['TO TREASURER', 'COLLECTED BY TREASURER'])
            ->orderBy('remittance.status', 'asc')
            ->get();

        $balances = DB::table('createpayable')
            ->select('balance', 'description', 'yearLevel', 'block')
            ->get();

        $paids = DB::table('remittance')
            ->select('paid', 'description', 'yearLevel', 'block', 'date_remitted', 'status')
            ->get();

        $denominations = DB::table('denomination')
            ->select('date', 'thousand', 'five_hundred', 'two_hundred', 'one_hundred', 'fifty', 'twenty', 'ten', 'five', 'one', 'twenty_five_cents', 'totalAmount', 'collectedBy')
            ->get();

        $latestDenomination = DB::table('denomination')
            ->orderByDesc('date')
            ->first();

        $collectors = DB::table('createuser')
            ->select('firstname', 'lastname', 'role', 'yearLevel', 'block')
            ->whereIn('role', ['TREASURER', 'REPRESENTATIVE'])
            ->get();

        // Format the date for each remittance
        foreach ($remittances as $remittance) {
            $remittance->formattedDate = \Carbon\Carbon::parse($remittance->date)->format('Y-m-d');
        }

        $profile = DB::table('avatar')
            ->where('student_id', session('id'))
            ->select('profile')
            ->first();

            $firstname = session('firstname');
            $lastname = session('lastname');

        return view('treasurer.CashOnHand', compact(
            'remittances',
            'balances',
            'denominations',
            'latestDenomination',
            'paids',
            'collectors',
            'profile',
            'firstname',
            'lastname'
        ));
    }


    public function getDenomination(Request $request)
    {
        $date = $request->query('date');
        $collectedBy = $request->query('collectedBy');

        $denomination = DB::table('denomination')
            ->whereDate('date', $date)
            ->where('collectedBy', $collectedBy)
            ->where('status', 'TO TREASURER')
            ->first();

        if (!$denomination) {
            return response()->json(['success' => false]);
        }

        return response()->json([
            'success' => true,
            'date' => $denomination->date,
            'denomination' => $denomination
        ]);
    }

    public function updateRemittanceStatus(Request $request)
    {
        $validated = $request->validate([
            'date_remitted' => 'required|date_format:Y-m-d',
            'collected_by' => 'required|string',
        ]);

        $date_remitted = $validated['date_remitted'];
        $collectedBy = $validated['collected_by'];

        $remittanceIds = DB::table('remittance')
            ->whereDate('date_remitted', $date_remitted)
            ->where('collectedBy', $collectedBy)
            ->where('status', '!=', 'REMITTED')
            ->pluck('id');


        if ($remittanceIds->isEmpty()) {
            return redirect()->back()->with('info', 'No new remittances to update.');
        }

        $updatedRemittance = DB::table('remittance')
            ->whereIn('id', $remittanceIds)
            ->update([
                'status' => 'REMITTED',
                'updated_at' => now(),
            ]);

        $updatedDenomination = DB::table('denomination')
            ->whereDate('date', $date_remitted)
            ->where('collectedBy', $collectedBy)
            ->update(['status' => 'REMITTED']);

        if ($updatedRemittance && $updatedDenomination) {
            $totalAmount = DB::table('remittance')
                ->whereIn('id', $remittanceIds)
                ->sum('paid');

            $existingFund = DB::table('funds')->first();

            if ($existingFund) {
                DB::table('funds')->update([
                    'cash_on_hand' => $existingFund->cash_on_hand + $totalAmount,
                ]);
            } else {
                DB::table('funds')->insert([
                    'cash_on_hand' => $totalAmount,
                    'expenses' => 0,
                    'receivable' => 0,
                ]);
            }
            $descriptions = DB::table('remittance')
                ->select('description', DB::raw('SUM(paid) as total_paid'))
                ->whereIn('id', $remittanceIds)
                ->groupBy('description')
                ->get();

            foreach ($descriptions as $desc) {
                $existing = DB::table('available_description')
                    ->where('description', $desc->description)
                    ->first();

                if ($existing) {
                    $newTotalAmount = $existing->total_amount_collected + $desc->total_paid;

                    if ($newTotalAmount > $existing->total_amount_collected) {
                        DB::table('available_description')
                            ->where('description', $desc->description)
                            ->update([
                                'total_amount_collected' => $newTotalAmount,
                            ]);
                    }
                } else {
                    DB::table('available_description')->insert([
                        'description' => $desc->description,
                        'total_amount_collected' => $desc->total_paid,
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Status updated, funds added, and available description updated!');
        } else {
            return redirect()->back()->with('error', 'Failed to update status.');
        }
    }


    public function storedenomination(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'thousand' => 'nullable|integer|min:0',
            'five_hundred' => 'nullable|integer|min:0',
            'two_hundred' => 'nullable|integer|min:0',
            'one_hundred' => 'nullable|integer|min:0',
            'fifty' => 'nullable|integer|min:0',
            'twenty' => 'nullable|integer|min:0',
            'ten' => 'nullable|integer|min:0',
            'five' => 'nullable|integer|min:0',
            'one' => 'nullable|integer|min:0',
            'twenty_five_cents' => 'nullable|integer|min:0',
        ]);

        $new = [
            'thousand' => $request->thousand ?? 0,
            'five_hundred' => $request->five_hundred ?? 0,
            'two_hundred' => $request->two_hundred ?? 0,
            'one_hundred' => $request->one_hundred ?? 0,
            'fifty' => $request->fifty ?? 0,
            'twenty' => $request->twenty ?? 0,
            'ten' => $request->ten ?? 0,
            'five' => $request->five ?? 0,
            'one' => $request->one ?? 0,
            'twenty_five_cents' => $request->twenty_five_cents ?? 0,
        ];

        $newTotalAmount =
            ($new['thousand'] * 1000) +
            ($new['five_hundred'] * 500) +
            ($new['two_hundred'] * 200) +
            ($new['one_hundred'] * 100) +
            ($new['fifty'] * 50) +
            ($new['twenty'] * 20) +
            ($new['ten'] * 10) +
            ($new['five'] * 5) +
            ($new['one'] * 1) +
            ($new['twenty_five_cents'] * 0.25);

        // Check if a denomination entry already exists for the same user and status
        $existingDenomination = DB::table('denomination')
            ->where('collectedBy', session('firstname') . ' ' . session('lastname'))
            ->where('status', 'REMITTED')
            ->first();

        if ($existingDenomination) {
            // Update existing denomination entry
            DB::table('denomination')
                ->where('id', $existingDenomination->id)
                ->update([
                    'totalAmount' => $existingDenomination->totalAmount + $newTotalAmount,
                ]);
        } else {
            // Insert a new denomination entry
            DB::table('denomination')->insert([
                'date' => $request->date,
                'thousand' => $new['thousand'],
                'five_hundred' => $new['five_hundred'],
                'two_hundred' => $new['two_hundred'],
                'one_hundred' => $new['one_hundred'],
                'fifty' => $new['fifty'],
                'twenty' => $new['twenty'],
                'ten' => $new['ten'],
                'five' => $new['five'],
                'one' => $new['one'],
                'twenty_five_cents' => $new['twenty_five_cents'],
                'totalAmount' => $newTotalAmount,
                'collectedBy' => session('firstname') . ' ' . session('lastname'),
                'status' => 'REMITTED',
            ]);
        }
        // Step 1: Update remittance records (same as before)
        DB::table('remittance')
            ->where('date_remitted', $request->selectedDateForRequest)
            ->where('status', 'COLLECTED BY TREASURER')
            ->update([
                'status' => 'REMITTED',
                'updated_at' => now(),
            ]);

        // Step 2: Get only the remittances updated just now
        $descriptions = DB::table('remittance')
            ->select('description', DB::raw('SUM(paid) as total_paid'))
            ->where('status', 'REMITTED')
            ->whereDate('updated_at', now()->toDateString())
            ->whereTime('updated_at', '>=', now()->subSeconds(10)->toTimeString())
            ->groupBy('description')
            ->get();

        // Step 3: Update available_description based on newly updated remittance
        foreach ($descriptions as $desc) {
            $existing = DB::table('available_description')
                ->where('description', $desc->description)
                ->first();

            if ($existing) {
                DB::table('available_description')
                    ->where('description', $desc->description)
                    ->update([
                        'total_amount_collected' => $existing->total_amount_collected + $desc->total_paid,
                    ]);
            } else {
                DB::table('available_description')->insert([
                    'description' => $desc->description,
                    'total_amount_collected' => $desc->total_paid,
                ]);
            }
        }





        // Update the cash on hand record
        $existingCash = DB::table('funds')->first();
        if ($existingCash) {
            DB::table('funds')->update([
                'cash_on_hand' => $existingCash->cash_on_hand + $newTotalAmount,
                'expenses' => 0,
                'receivable' => 0,
            ]);
        } else {
            DB::table('funds')->insert([
                'cash_on_hand' => $newTotalAmount,
                'expenses' => 0,
                'receivable' => 0,
            ]);
        }

        return redirect()->back()->with('success', 'Denomination saved and cash updated successfully!');
    }


    public function getStudentsWhoPaid(Request $request)
    {
        $date = $request->input('date');
        $collectedBy = $request->input('collectedBy');
        $description = $request->input('description');
        $status = $request->input('status');

        \Log::info("Fetching students for:", [
            'date' => $date,
            'collectedBy' => $collectedBy,
            'description' => $description,
            'status' => $status,
        ]);

        $students = DB::table('remittance')
            ->select(
                'firstname',
                'lastname',
                'yearLevel',
                'block',
                DB::raw('SUM(paid) as paid'),
                'status'
            )
            ->whereDate('date', $date)
            ->where('collectedBy', $collectedBy)
            ->where('description', $description)
            ->where('status', $status)
            ->groupBy('firstname', 'lastname', 'yearLevel', 'block', 'status')
            ->get();

        return response()->json($students);
    }

    public function userDetails()
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



        return view('Treasurer.userDetails', compact('profile', 'id', 'firstname', 'lastname', 'role', 'yearLevel', 'block', 'username', 'password', 'gender'));
    }


    public function showLedger($id)
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

        return view('Treasurer.studentLedger', compact('student', 'payables', 'settledPayables', 'profile','firstname','lastname'));
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

        // Save image to public/user_images/
        $destinationPath = public_path('user_images');
        $image->move($destinationPath, $filename);

        // Update the createuser table (not users)
        DB::table('createuser')->where('IDNumber', $request->IDNumber)->update(['profile_image' => $filename]);

        return redirect()->back()->with('success', 'Profile image uploaded successfully.');
    }

    public function change(Request $request)
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

    public function modifyUser(Request $request)
    {
        $action = $request->input('action');
        $idNumber = $request->input('students.0');
    
        if ($action === 'modify') {
            DB::table('createuser')
                ->where('IDNumber', $idNumber)
                ->update([
                    'firstname' => strtoupper($request->input('firstname')),
                    'lastname' => strtoupper($request->input('lastname')),
                    'gender' => strtolower($request->input('gender')),
                    'yearLevel' => $request->input('yearLevel'),
                    'block' => $request->input('block'),
                ]);
    
            DB::table('createpayable')
                ->where('IDNumber', $idNumber)
                ->update([
                    'studentName' => strtoupper($request->input('firstname')) . ' ' . strtoupper($request->input('lastname')),
                    'yearLevel' => $request->input('yearLevel'),
                    'block' => $request->input('block'),
                ]);
    
            DB::table('remittance')
                ->where('IDNumber', $idNumber)
                ->update([
                    'firstName' => strtoupper($request->input('firstname')),
                    'lastName' => strtoupper($request->input('lastname')),
                    'yearLevel' => $request->input('yearLevel'),
                    'block' => $request->input('block'),
                ]);
    
            return back()->with('success', 'User and related records modified successfully!');
        }
    
        if ($action === 'archive') {
            $user = DB::table('createuser')->where('IDNumber', $idNumber)->first();
    
            if ($user) {
                DB::table('archive')->insert([
                    'IDNumber' => $user->IDNumber,
                    'firstname' => $user->firstname,
                    'lastname' => $user->lastname,
                    'gender' => $user->gender,
                    'yearLevel' => $user->yearLevel,
                    'role' => $user->role,
                    'block' => $user->block,
                    'status' => 'DEACTIVATED',
                    'username' => $user->username,
                    'password' => $user->password,
                ]);
    
                DB::table('createuser')->where('IDNumber', $idNumber)->delete();
    
                DB::table('createpayable')->where('IDNumber', $idNumber)->delete();
    
                DB::table('remittance')
                ->where('IDNumber', $idNumber)
                ->where('status', '!=', 'remitted') 
                ->delete();
            
            return back()->with('success', 'User and related records archived and deleted successfully!');
            
            }
    
            return back()->with('error', 'User not found.');
        }
    
        return back()->with('error', 'Invalid action.');
    }
    
    
    


}

