<?php

namespace App\Http\Controllers\restaurants;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\FoodParty;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class FoodPartyController extends Controller
{
    public function store(Request $request , string $name , string $id)
    {
        $restaurant = Restaurant::where('name' , $name)->first();
        $request->validate([
            'percent' => 'required|min:1|max:100',
            'quantity' => 'required'
        ]);

        $this->authorize('foodPartyCreate' , $restaurant);

        FoodParty::create([
            'food_id' => Food::where('id' , $id)->first()->id,
            'discount_percent' => $request->input('percent'),
            'quantity' => $request->input('quantity')
        ]);

        return redirect()->back();
    }
}
