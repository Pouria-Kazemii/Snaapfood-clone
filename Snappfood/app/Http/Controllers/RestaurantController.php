<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RestaurantController extends Controller
{

    public function __construct()
    {
        return $this->middleware('restaurant');
    }

    public function index()
    {
        return view('restaurant.home');
    }
}
