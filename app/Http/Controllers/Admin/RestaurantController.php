<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Restaurant;
use App\RestaurantCategory;
use Illuminate\Routing\ResponseFactory;
use App\Http\Requests\RestaurantUpdateRequest;
use App\Http\Requests\RestaurantStoreRequest;

class RestaurantController extends Controller
{
    protected $response;

    public function __construct(ResponseFactory $response)
    {
        $this->response = $response;
    }

 
    public function index()
    {
        $restaurants = Restaurant::with('category')->get()->values();
        if (request()->ajax()) {
            return $this->response->json($restaurants);
        }

        return view('admin.restaurant.index', compact('restaurants'));  
    }

 
    public function create()
    {
        $categories = RestaurantCategory::all();
        return view('admin.restaurant.create', compact('categories'));  
    }


    public function store(RestaurantStoreRequest $request)
    {
        Restaurant::create($request->only(['name', 'description', 'restaurant_category_id', 'latitude', 'longitude'])); 
        return redirect()->route('restaurant.index');
    }


    public function show(Restaurant $restaurant)
    {
        return view('admin.restaurant.show', compact('restaurant'));
    }

   
    public function edit(Restaurant $restaurant)
    {
        $categories = RestaurantCategory::all();
        return view('admin.restaurant.edit', compact('restaurant', 'categories'));
    }

    
    public function update(RestaurantUpdateRequest $request, Restaurant $restaurant)
    {
        $restaurant->update($request->only(['name', 'description', 'restaurant_category_id', 'latitude', 'longitude']));    
        return redirect()->route('restaurant.index');
    }

    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();
        return redirect()->route('restaurant.index');
    }

    public function delete(Restaurant $restaurant)
    {
        return view('admin.restaurant.delete', compact('restaurant'));
    }
}
