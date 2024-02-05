<?php

use App\Http\Controllers\customers\AddressController;
use App\Http\Controllers\customers\CommentController;
use App\Http\Controllers\customers\OrderController;
use App\Http\Controllers\customers\RestaurantController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    //Address
    Route::get('/addresses' , [AddressController::class , 'getUserAddress']);
    Route::post('/addresses' , [AddressController::class , 'addAddress']);
    Route::post('/addresses/{id}',[AddressController::class , 'updateAddress']);

    //Orders
    Route::get('/orders' , [OrderController::class , 'index']);
    Route::get('/orders/{id}' , [OrderController::class , 'read']);
    Route::post('/orders/add' , [OrderController::class , 'store']);
    Route::patch('/orders/add' , [OrderController::class , 'update']);
    Route::post('/orders/{id}/pay' , [OrderController::class , 'pay']);

    //Comments
    Route::post('/comments' , [CommentController::class , 'store']);

});

//Restaurants
Route::get('/restaurants/{id}' , [RestaurantController::class , 'index']);
Route::get('/restaurants' , [RestaurantController::class , 'search']);
Route::get('/restaurants/{id}/foods' , [RestaurantController::class , 'food']);

//Comments
Route::get('/comments' , [CommentController::class , 'index']);

