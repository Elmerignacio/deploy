<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TreasurerController;
use App\Http\Middleware\AuthUser;

Route::get('/login', [TreasurerController::class, 'showLoginForm'])->name('login');
Route::post('/login', [TreasurerController::class, 'authenticate']);
Route::post('/logout', [TreasurerController::class, 'logout'])->name('logout');


Route::get('/',[TreasurerController::class, 'Login']);

Route::get('userDetails',[TreasurerController::class, 'userDetails']);


  Route::get('expense', [TreasurerController::class, 'expense']);
  Route::get('remitted', [TreasurerController::class, 'Remitted']);
  Route::get('dashboard', [TreasurerController::class, 'dashboard'])->name('dashboard');
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
  Route::get('/get-user-info', [TreasurerController::class, 'getUserInfo']);
  

  //representative
  Route::get('/repdashboard', [TreasurerController::class, 'RepDashboard'])->name('repdashboard');


  Route::post('/save-user-image', [TreasurerController::class, 'saveUserImage'])->name('saveUserImage');








