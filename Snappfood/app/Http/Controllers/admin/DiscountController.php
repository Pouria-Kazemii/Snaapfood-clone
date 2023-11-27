<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DiscountRequest;
use App\Models\Discount;
use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Support\Str;

class DiscountController extends Controller
{
    public function index()
    {
        $foods = Food::all();
        return view('admin.discounts',[
            'foods' => $foods,
        ]);
    }

    public function delete(string $id)
    {
        Discount::find($id)->delete();

        return redirect()->route('admin.discounts');
    }

    public function store(DiscountRequest $request)
    {
        $discounts = Discount::all();
        $validateData = $request->validated();
        $new_discount = Str::random(20);
        foreach ($discounts as $discount){
            if ($discount == $new_discount){
                $new_discount = Str::random(20);
            }
        }

        Discount::create([
            'value' => $new_discount,
            'percent' => $validateData['percent'],
            'food_id' => $validateData['food_id']
        ]);

        return redirect()->route('admin.discounts');
    }
}
