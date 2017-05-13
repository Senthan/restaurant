<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;

class RestaurantController extends Controller
{
     
    public function index()
    {
		$restaurants = Restaurant::with('category')->get();

        return view('home.index', compact('restaurants'));  
    }
}
