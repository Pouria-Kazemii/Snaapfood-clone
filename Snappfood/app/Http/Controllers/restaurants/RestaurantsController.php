<?php

namespace App\Http\Controllers\restaurants;

use App\Http\Controllers\Controller;

class RestaurantsController extends Controller
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
