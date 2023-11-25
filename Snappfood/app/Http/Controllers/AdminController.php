<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin') ;
    }

    public function index()
    {
        return view('admin.home');
    }
}
