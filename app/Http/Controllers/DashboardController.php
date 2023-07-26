<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $pageName = "Dashboard";
        
        return view('user.dashboard', compact('pageName'));
    }
}
