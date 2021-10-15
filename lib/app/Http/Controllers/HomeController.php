<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('ktralogin');
    }
    public function index()
    {
        return view('backend.home');
    }
    
}
