<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\DiscountController;
use App\Http\Controllers\admin\TypeOfFoodController;
use App\Http\Controllers\admin\TypeOfRestaurantController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\restaurants\RestaurantsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [HomeController::class , 'index'] );


//Auth Routes
Route::get('/login' , [LoginController::class , 'index'])->name('login');
Route::post('/login' , [LoginController::class , 'login']);
Route::get('/register' , [RegisterController::class , 'index'])->name('register');
Route::post('/register' , [RegisterController::class , 'register']);


//Admin Routes
Route::group(['middleware' => 'admin'],function (){
    //Basic Routes
    Route::get('/admin',[AdminController::class , 'index'])->name('admin.home');
    Route::post('admin/logout' , [AdminController::class , 'logout']);
    //Delete Comments
    Route::put('/admin/{id}' , [AdminController::class , 'stayComment']);
    Route::delete('/admin/{id}' , [AdminController::class , 'deleteComment']);


    //Food Types
    Route::get('/admin/food_types' , [TypeOfFoodController::class , 'index'])->name('admin.food_types');
    Route::post('/admin/food_types' , [TypeOfFoodController::class , 'store']);
    Route::delete('/admin/food_types/{id}' , [TypeOfFoodController::class , 'delete']);
    Route::put('/admin/food_types/{id}', [TypeOfFoodController::class , 'update']);

    //Restaurant Types
    Route::get('/admin/restaurant_types' , [TypeOfRestaurantController::class , 'index'])->name('admin.restaurant_types');
    Route::post('/admin/restaurant_types' , [TypeOfRestaurantController::class , 'store']);
    Route::delete('/admin/restaurant_types/{id}' , [TypeOfRestaurantController::class , 'delete']);
    Route::put('/admin/restaurant_types/{id}', [TypeOfRestaurantController::class , 'update']);

    //Discount
    Route::get('/admin/discounts' , [DiscountController::class , 'index'])->name('admin.discounts');
    Route::delete('/admin/discounts/{id}' , [DiscountController::class , 'delete']);
    Route::post('admin/discounts',[DiscountController::class , 'store']);

});


//Restaurant Routes
Route::get('/restaurants/{name}' , [RestaurantsController::class , 'index'])->name('restaurant.home');

