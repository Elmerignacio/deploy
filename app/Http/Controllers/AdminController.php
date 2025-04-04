<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{    
    public function AddDashboard()
    {
        $firstname = session('firstname', 'Guest'); 
        $lastname = session('lastname', '');
        $role = session('role', 'Guest');
        
        return view('admin.adminDashboard', compact('firstname', 'lastname', 'role'));
    }

    
    
}
