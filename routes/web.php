<?php

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

Route::post('/saveUserImage', [TreasurerController::class, 'saveUserImage'])->name('saveUserImage');
Route::get('expense', [TreasurerController::class, 'expense']);
Route::get('remitted', [TreasurerController::class, 'Remitted']);
Route::get('treasurer/dashboard', [TreasurerController::class, 'dashboard'])->name('dashboard');
Route::get('manageUser', [TreasurerController::class, 'Manageuser']);
Route::get('payableManagement', [TreasurerController::class, 'Payablemanagement']);
Route::get('createPayable', [TreasurerController::class, 'Createpayable']);
Route::get('studentBalance', [TreasurerController::class, 'Studentbalance']);
Route::get('collection', [TreasurerController::class, 'Collection']);
Route::get('archiveUser', [TreasurerController::class, 'ArchiveUser']);
Route::get('get-students-and-blocks', [TreasurerController::class, 'getStudentsAndBlocks']);
Route::post('saveData', [TreasurerController::class, 'saveuser']);
Route::post('savePayable', [TreasurerController::class, 'savepayable']);
Route::post('/archive-users', [TreasurerController::class, 'archiveUsers'])->name('archive.users');
Route::get('/get-student-payables/{studentId}', [TreasurerController::class, 'getStudentPayables']);
Route::post('/save-payment', [TreasurerController::class, 'savePayment'])->name('save.payment');
Route::get('/student-ledger/{id}', [TreasurerController::class, 'showLedger'])->name('student.ledger');
Route::get('/remitted/students', [TreasurerController::class, 'getStudentsWhoPaid']);

Route::get('userDetails', [TreasurerController::class, 'userDetails']);
Route::get('/get-user-info', [TreasurerController::class, 'getUserInfo']);




  //representative
  Route::middleware('REPRESENTATIVE')->group(function () {  });
  Route::get('representative/dashboard', [RepresentativeController::class, 'RepDashboard'])->name('repdashboard');
  Route::get('representative/collection', [RepresentativeController::class, 'repCollection']);
  Route::get('representatve/remitted', [RepresentativeController::class, 'RepRemitted']);
  Route::post('representative/save-payment', [RepresentativeController::class, 'RepSavePayment'])->name('save.payment');





    //Admin
    Route::middleware('ADMIN')->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'AddDashboard'])->name('AdminDashboard');
  });
   
  Route::middleware('STUDENT')->group(function () {
  Route::get('student/dashboard', [StudentController::class, 'studDashboard'])->name('StudentDashboard');
});



