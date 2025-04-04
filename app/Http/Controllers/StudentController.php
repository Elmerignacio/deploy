<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function studDashboard() {
        $firstname = session('firstname', 'Guest'); 
        $lastname = session('lastname', '');
        $role = session('role', 'Guest');
    
    
        return view('student.studDashboard', compact('firstname', 'lastname', 'role'));
    
    }
   //
}
