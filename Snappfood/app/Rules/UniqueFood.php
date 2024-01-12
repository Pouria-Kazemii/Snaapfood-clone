<?php

namespace App\Rules;

use App\Models\Food;
use App\Models\Restaurant;
use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueFood implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $restaurantId =Restaurant::where('user_id',auth()->id())->value('id');
        $foods = Food::where('restaurant_id',$restaurantId)->where('is_deleted' , false)->get();
        foreach($foods as $food){
            if ($food['name'] == $value){
             $fail("this $attribute already exist");
            }
        }
    }
}
