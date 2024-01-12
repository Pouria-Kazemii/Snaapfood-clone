<?php

namespace App\Http\Controllers\restaurants;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DiscountController extends Controller
{
    public function store(Request $request , string $name , string $id)
    {
        $restaurant = Restaurant::where('name', $name)->first();
        $request->validate([
            'percent' => 'required|min:1|max:100'
        ]);

        $this->authorize('discountCreate' , $restaurant);

        $new_discount = Str::random(20);
        if (!Discount::where('value', 'LIKE', $new_discount)->first()) {
            Discount::create([
                'percent' => $request->input('percent'),
                'food_id' => Food::where('id',$id)->first()->id,
                'value' => $new_discount
            ]);
        }else{
            return redirect('restaurant/{name}/foods/{id}')->whitErrors('something wrong . plz try again');
        }

        return redirect()->back();
    }

}
