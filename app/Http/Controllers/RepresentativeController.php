<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class RepresentativeController extends Controller
{
public function RepDashboard() {
    $firstname = session('firstname', 'Guest'); 
    $lastname = session('lastname', '');
    $role = session('role', 'Guest');


    return view('representative.repdashboard', compact('firstname', 'lastname', 'role'));

}

    
    
function repCollection() {
    $yearLevel = session('yearLevel');
    $block = session('block');

    $students = DB::table('createuser')
        ->whereIn('role', ['representative', 'student', 'treasurer'])
        ->where('yearLevel', $yearLevel)
        ->where('block', $block)
        ->orderBy('lastname', 'asc')
        ->get(); 

    return view('representative.repCollection', compact('students'));
}


public function RepRemitted()
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
    ->select('paid', 'description', 'yearLevel', 'block', 'date') 
    ->get();

foreach ($remittances as $remittance) {
    $matchingAmount = $paids->firstWhere(function ($payable) use ($remittance) {
        return $payable->description === $remittance->description
            && $payable->yearLevel === $remittance->yearLevel
            && $payable->block === $remittance->block
            && $payable->date === $remittance->date;
    });
 

    $remittance->paid = $matchingAmount ? $matchingAmount->paid : 0;
}


    $collectors = DB::table('createuser')
        ->whereIn('role', ['TREASURER', 'REPRESENTATIVE'])
        ->select('firstname', 'lastname', 'role', 'yearLevel', 'block')
        ->get();

    return view('representative.repRemitted', compact('remittances', 'collectors', 'balances','paids'));
}


public function RepSavePayment(Request $req) {
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



}
