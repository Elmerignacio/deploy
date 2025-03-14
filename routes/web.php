<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('dashboard', function () {
    return view('dashboard');
});

Route::get('createUser', function () {
    return view('createUser');
});

Route::get('manageUser', function () {
    return view('manageUser');
});


Route::get('payableManagement', function () {
    return view('payableManagement');
});

Route::get('createPayable', function () {
    return view('createPayable');
});

Route::get('studentBalance', function () {
    return view('studentBalance');
});




