<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RestaurantCategoryStoreRequest;
use App\RestaurantCategory;


class RestaurantCategoryController extends Controller
{
 
    public function create()
    {
        return view('admin.category.create');  
    }

    public function store(RestaurantCategoryStoreRequest $request)
    {
        RestaurantCategory::create($request->only(['name', 'description'])); 
        return redirect()->route('restaurant.create');
    }

}
