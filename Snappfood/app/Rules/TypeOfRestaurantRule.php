<?php

namespace App\Rules;

use App\Models\RestaurantType;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class TypeOfRestaurantRule implements ValidationRule
{
    private $restaurantTypes;

    public function __construct()
    {
        $this->restaurantTypes = RestaurantType::all();
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        foreach ($this->restaurantTypes as $restaurantType){
            foreach ($value as $item) {
                if ($item ==  $restaurantType->type_of_restaurant_id and auth()->user()->restaurant->id == $restaurantType->restaurant_id){
                    $fail('you selected this type already');
                }
            }
        }
    }
}
