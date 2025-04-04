<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RepresentativeController extends Controller
{
public function RepDashboard() {
    $firstname = session('firstname', 'Guest'); 
    $lastname = session('lastname', '');
    $role = session('role', 'Guest');


    return view('representative.repdashboard', compact('firstname', 'lastname', 'role'));

}





}
