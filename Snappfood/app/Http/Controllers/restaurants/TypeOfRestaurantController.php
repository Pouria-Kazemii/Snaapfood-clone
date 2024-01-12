<?php

namespace App\Http\Controllers\restaurants;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\RestaurantType;
use App\Models\TypeOfRestaurant;
use App\Rules\TypeOfRestaurantRule;
use Illuminate\Http\Request;


class TypeOfRestaurantController extends Controller
{
    public function index(string $name)
    {
        $restaurant = Restaurant::where('name' , $name)->first();
        $typesOfRestaurant = TypeOfRestaurant::all();

        $this->authorize('setting' , $restaurant);

        return view('restaurant.setting.type_of_restaurant')->with(['restaurant' => $restaurant ,'typesOfRestaurant' => $typesOfRestaurant]);
    }

    public function create(string $name , Request $request)
    {
        $restaurant = Restaurant::where('name' , $name)->first();

        $this->authorize('setting' , $restaurant);

        $request->validate([
            'options' => ['required',new TypeOfRestaurantRule]
        ]);

        foreach($request->input('options') as $option ){
            RestaurantType::create([
                'type_of_restaurant_id' => $option,
                'restaurant_id' => $restaurant->id
            ]);
        };
        return redirect()->back();
    }

    public function delete(string $name , string $id)
    {
        RestaurantType::where('id' , $id)->delete();
        $restaurant = Restaurant::where('name' , $name)->first();

        $this->authorize('setting' , $restaurant);

        return redirect()->back();
    }

}
