<?php

use App\Http\Controllers\ProfileController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TreasurerController;

use App\Http\Controllers\RepresentativeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\AdminController;


Route::get('/login', [loginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [loginController::class, 'authenticate']);
Route::post('/logout', [loginController::class, 'logout'])->name('logout');

 //TREASURER
  Route::middleware('TREASURER')->group(function () {
});

Route::post('/treasurer/saveUserImage', [TreasurerController::class, 'saveUserImage'])->name('saveUserImage');
Route::get('/treasurer/expense', [TreasurerController::class, 'expense']);
Route::get('/treasurer/remitted', [TreasurerController::class, 'Remitted']);
Route::get('/treasurer/dashboard', [TreasurerController::class, 'dashboard'])->name('dashboard');
Route::get('/treasurer/manageUser', [TreasurerController::class, 'Manageuser']);
Route::get('/treasurer/payableManagement', [TreasurerController::class, 'Payablemanagement']);
Route::get('/treasurer/createPayable', [TreasurerController::class, 'Createpayable']);
Route::get('/treasurer/studentBalance', [TreasurerController::class, 'Studentbalance']);
Route::get('/treasurer/collection', [TreasurerController::class, 'Collection']);
Route::get('/treasurer/archiveUser', [TreasurerController::class, 'ArchiveUser']);
Route::get('/treasurer/get-students-and-blocks', [TreasurerController::class, 'getStudentsAndBlocks']);

Route::post('/treasurer/saveData', [TreasurerController::class, 'saveuser']);

Route::post('/treasurer/savePayable', [TreasurerController::class, 'savepayable']);
Route::post('/treasurer/archive-users', [TreasurerController::class, 'archiveUsers'])->name('archive.users');
Route::get('/treasurer/get-student-payables/{studentId}', [TreasurerController::class, 'getStudentPayables']);
Route::post('/treasurer/save-payment', [TreasurerController::class, 'savePayment'])->name('save.payment');
Route::get('/treasurer/student-ledger/{id}', [TreasurerController::class, 'showLedger'])->name('student.ledger');
Route::get('/treasurer/remitted/students', [TreasurerController::class, 'getStudentsWhoPaid']);

Route::post('/treasurer/save-payment', [TreasurerController::class, 'SavePayment'])->name('treasave.payment');

Route::get('/treasurer/CashOnHand', [TreasurerController::class, 'CashOnHand']);


Route::get('/treasurer/userDetails', [TreasurerController::class, 'userDetails']);
Route::get('/treasurer/get-user-info', [TreasurerController::class, 'getUserInfo']);

Route::get('/treasurer/get-denomination', [TreasurerController::class, 'getDenomination']);
Route::post('/treasurer/denomination', [TreasurerController::class, 'storedenomination'])->name('store.denomination');

Route::post('/treasurer/update-remittance-status', [TreasurerController::class, 'updateRemittanceStatus']);
Route::post('/treasurer/update-user', [TreasurerController::class, 'update'])->name('user.update');
Route::post('/treasurer/disburse/store', [TreasurerController::class, 'storeExpense'])->name('expenses.store');

Route::post('/treasurer/userDetails', [ProfileController::class, 'store'])->name('image.upload');

Route::put('/treasurer/change-password', [TreasurerController::class, 'change'])->name('password.change');




  //representative
  Route::middleware('REPRESENTATIVE')->group(function () {  });
  Route::get('/representative/dashboard', [RepresentativeController::class, 'RepDashboard'])->name('repdashboard');
  Route::get('representative/collection', [RepresentativeController::class, 'repCollection']);
  Route::get('representative/remitted', [RepresentativeController::class, 'RepRemitted']);
  Route::get('representative/CashOnHand', [RepresentativeController::class, 'RepCashOnHand']);
  Route::post('/denomination', [RepresentativeController::class, 'denomination'])->name('denomination.store');
  Route::post('/representative/save-payment', [RepresentativeController::class, 'RepSavePayment'])->name('repre.payment');
  Route::get('/representative/remitted/students', [RepresentativeController::class, 'getStudents']);
  Route::get('/representative/payableManagement', [RepresentativeController::class, 'repPayableManagement']);
  Route::get('/representative/userDetails', [RepresentativeController::class, 'RepUserDetails']);
  Route::put('/representative/change-password', [RepresentativeController::class, 'Repchange'])->name('password.Repchange');
  
  

    //Admin
    Route::middleware('ADMIN')->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'AddDashboard'])->name('AdminDashboard');
  });
   
  Route::middleware('STUDENT')->group(function () {
  Route::get('student/dashboard', [StudentController::class, 'studDashboard'])->name('StudentDashboard');
});



