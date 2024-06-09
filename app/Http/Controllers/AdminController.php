<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');

    }

    public function users()
    {
        // Add your logic here
    }

    public function roles()
    {
        // Add your logic here
    }

    public function permissions()
    {
        // Add your logic here
    }
}