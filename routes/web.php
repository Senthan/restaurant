<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$router->resource('admin/restaurant', 'Admin\RestaurantController');
$router->get('admin/restaurant/{restaurant}/delete', ['uses' => 'Admin\RestaurantController@delete', 'as' => 'restaurant.delete']);

$router->post('admin/restaurant/category', ['uses' => 'Admin\RestaurantCategoryController@store', 'as' => 'category.store']);
$router->get('admin/restaurant/category/create', ['uses' => 'Admin\RestaurantCategoryController@create', 'as' => 'category.create']);

Route::get('/', 'RestaurantController@index')->name('home');
