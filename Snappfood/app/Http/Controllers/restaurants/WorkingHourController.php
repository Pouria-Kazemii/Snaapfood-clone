<?php

namespace App\Http\Controllers\restaurants;

use App\Http\Controllers\Controller;
use App\Http\Requests\WorkingHoursRequest;
use App\Models\Restaurant;
use App\Models\RestaurantHour;

class WorkingHourController extends Controller
{
    public function index(string $name)
    {
        $restaurant = Restaurant::where('name' , $name)->first();

        $this->authorize('setting' , $restaurant);

        return view('restaurant.setting.working_hours' , [
            'restaurant' => $restaurant
        ]);
    }

    public function create(string $name , WorkingHoursRequest $request)
    {
        $restaurant = Restaurant::where('name' , $name)->first();
        $validData = $request->validated();

        $this->authorize('setting' , $restaurant);

        if ($restaurant->restaurantHoures->count() > 1){
            foreach ($restaurant->restaurantHoures as $restaurantHour)
            {
                RestaurantHour::where('restaurant_id',$restaurant->id)->delete();
            }
        }
        RestaurantHour::insert([
            [
                'day' => '0',
                'is_open' => $validData['sat-open'],
                'opening_time' => $validData['sat_start'] ?? null,
                'closing_time' => $validData['sat_end']?? null,
                'restaurant_id' => $restaurant->id
            ],
            [
                'day' => '1',
                'is_open' => $validData['sun-open'],
                'opening_time' => $validData['sun_start'] ?? null,
                'closing_time' => $validData['sun_end']?? null,
                'restaurant_id' => $restaurant->id
            ],
            [
                'day' => '2',
                'is_open' => $validData['mon-open'],
                'opening_time' => $validData['mon_start'] ?? null,
                'closing_time' => $validData['mon_end']?? null,
                'restaurant_id' => $restaurant->id
            ],
            [
                'day' => '3',
                'is_open' => $validData['tue-open'],
                'opening_time' => $validData['tue_start'] ?? null,
                'closing_time' => $validData['tue_end']?? null,
                'restaurant_id' => $restaurant->id
            ],
            [
                'day' => '4',
                'is_open' => $validData['wed-open'],
                'opening_time' => $validData['wed_start'] ?? null,
                'closing_time' => $validData['wed_end']?? null,
                'restaurant_id' => $restaurant->id
            ],
            [
                'day' => '5',
                'is_open' => $validData['thu-open'],
                'opening_time' => $validData['thu_start'] ?? null,
                'closing_time' => $validData['thu_end']?? null,
                'restaurant_id' => $restaurant->id
            ],
            [
                'day' => '6',
                'is_open' => $validData['fri-open'],
                'opening_time' => $validData['fri_start'] ?? null,
                'closing_time' => $validData['fri_end']?? null,
                'restaurant_id' => $restaurant->id
            ]

            ]

        );

        return redirect()->route('restaurant.settings',['name' => $restaurant->name])->with(['restaurant' => $restaurant]);
    }
}
