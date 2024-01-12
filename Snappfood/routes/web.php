<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\DiscountController;
use App\Http\Controllers\admin\TypeOfFoodController;
use App\Http\Controllers\admin\TypeOfRestaurantController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\restaurants\CommentController;
use App\Http\Controllers\restaurants\FoodController;
use App\Http\Controllers\restaurants\FoodPartyController;
use App\Http\Controllers\restaurants\RestaurantsController;
use App\Http\Controllers\restaurants\SellReportController;
use App\Http\Controllers\restaurants\SettingController;
use App\Http\Controllers\restaurants\WorkingHourController;
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
    Route::get('/admin/discounts/' , [DiscountController::class , 'index'])->name('admin.discounts');
    Route::delete('/admin/discounts/{id}' , [DiscountController::class , 'delete']);
    Route::post('admin/discounts',[DiscountController::class , 'store']);

});

//Restaurant Routes
Route::group(['middleware' => 'restaurant'],function (){
    //Basic Routes
    Route::get('/restaurant/{name}' , [RestaurantsController::class , 'index'])->name('restaurant.home');
    Route::post('restaurant/{name}/logout' , [RestaurantsController::class , 'logout']);
    //Order Route
    Route::put('restaurant/{name}/{id}',[RestaurantsController::class , 'orders']);

    //Foods Routes
    Route::resource('/restaurant/{name}/foods' , FoodController::class);
    Route::post('/restaurant/{name}/foods/search' , [FoodController::class , 'search']);
    Route::post('/restaurant/{name}/foods/{id}' , [\App\Http\Controllers\restaurants\DiscountController::class , 'store']);
    Route::post('restaurant/{name}/foods/{id}/add_to_food_party' , [FoodPartyController::class , 'store']);

    //Sell Reports Routes
    Route::get('/restaurant/{name}/sell_report' , [SellReportController::class , 'index']);
    Route::post('/restaurant/{name}/sell_report' , [SellReportController::class , 'search']);

    //Comments Routes
    Route::get('/restaurant/{name}/comments',[CommentController::class , 'index']);
    Route::post('/restaurant/{name}/comments/{id}',[CommentController::class , 'sendResponse']);
    Route::put('/restaurant/{name}/comments/{id}',[CommentController::class , 'confirm']);
    Route::delete('/restaurant/{name}/comments/{id}',[CommentController::class , 'delete']);

    //Setting Routes
    Route::get('/restaurant/{name}/settings', [SettingController::class , 'index'])->name('restaurant.settings');
    Route::put('/restaurant/{name}/settings/update_status' , [SettingController::class , 'updateStatus']);
    Route::post('/restaurant/{name}/settings/update_restaurant',[SettingController::class , 'updateRestaurant']);
    Route::get('/restaurant/{name}/settings/working_hours' , [WorkingHourController::class , 'index']);
    Route::post('/restaurant/{name}/settings/change_working_hours' , [WorkingHourController::class , 'create']);
    Route::get('/restaurant/{name}/settings/type_of_restaurant' , [\App\Http\Controllers\restaurants\TypeOfRestaurantController::class , 'index']);
    Route::post('/restaurant/{name}/settings/type_of_restaurant' , [\App\Http\Controllers\restaurants\TypeOfRestaurantController::class , 'create']);
    Route::delete('/restaurant/{name}/settings/type_of_restaurant/{id}' , [\App\Http\Controllers\restaurants\TypeOfRestaurantController::class , 'delete']);


});

