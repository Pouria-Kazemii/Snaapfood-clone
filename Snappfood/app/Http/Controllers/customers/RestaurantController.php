<?php

namespace App\Http\Controllers\customers;

use App\Http\Controllers\Controller;
use App\Http\Resources\FoodResource;
use App\Http\Resources\RestaurantResource;
use App\Models\Comment;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class RestaurantController extends Controller
{
    public function index(string $id)
    {
        try {

            $restaurant =Cache::remember("restaurant_{$id}", 60 ,function () use ($id){
                return Restaurant::find($id);
            });

            if ($restaurant == null){
                Cache::forget("restaurant_{$id}");
                return response()->json([ 'error' => 'Not Found'] , 404);
            }

            $restaurantData = RestaurantResource::make($restaurant);
            Cache::forget("restaurant_{$id}");
            return response()->json($restaurantData);


        } catch (\Exception) {

            return response()->json(['error' => 'Internal Server Error'], 500);
        }

    }

    public function search(Request $request)
    {
        $restaurants = Restaurant::query();


        $is_open = $request->input('is_open');
        if ($is_open !== null) {
            $restaurants->where('is_open', $is_open);
        }

        $type = $request->input('type');
        if ($type !== null) {
            $restaurants->whereHas('restaurantTypes.typeOfRestaurant' , function ($query) use ($type) {
                $query->where('type' , $type);
            });
        }

        $result = $restaurants->get();

        return response()->json($result);
    }

    public function food(string $id)
    {
        $restaurant = Restaurant::find($id);

        if (!$restaurant) {
            // Handle the case where the restaurant is not found
            return response()->json(['error' => 'Restaurant not found'], 404);
        }

        $restaurant->load('foods.typeOfFood');

        $foodTypes = $restaurant->foods->pluck('typeOfFood.type','typeOfFood.id')->unique();

        $result = $foodTypes->map(function ($type , $id) use ($restaurant){
            $foodsForType = $restaurant->foods->where('type_of_food_id', $id)->where('is_deleted' , false);

            return [
              'id' => $id,
              'type' => $type,
                'foods' => FoodResource::collection($foodsForType),
            ];
        })->values()->toArray();

        return response()->json($result);
    }
}
