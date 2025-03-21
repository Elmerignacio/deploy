<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TreasurerController;


Route::get('/',[TreasurerController::class, 'Login']);

Route::get('createUser',[TreasurerController::class, 'CreateUser']);

Route::get('dashboard',[TreasurerController::class, 'Dashboard']);

Route::get('manageUser',[TreasurerController::class, 'Manageuser']);

Route::get('payableManagement',[TreasurerController::class, 'Payablemanagement']);

Route::get('createPayable',[TreasurerController::class, 'Createpayable']);

Route::get('studentBalance',[TreasurerController::class, 'Studentbalance']);

Route::get('collection',[TreasurerController::class, 'Collection']);


Route::get('archiveUser',[TreasurerController::class, 'ArchiveUser']);

Route::get('get-students-and-blocks',[TreasurerController::class, 'getStudentsAndBlocks']);

//post to database createuser
Route::post('saveData',[TreasurerController::class, 'saveuser']);


//post to database createpayable
Route::post('savePayable',[TreasurerController::class, 'savepayable']);

Route::post('/archive-users', [TreasurerController::class, 'archiveUsers'])->name('archive.users');



Route::get('/get-student-payables/{studentId}', [TreasurerController::class, 'getStudentPayables']);

Route::post('/save-payment', [TreasurerController::class, 'savePayment'])->name('save.payment');














