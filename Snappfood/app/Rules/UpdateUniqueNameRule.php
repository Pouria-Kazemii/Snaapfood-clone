<?php

namespace App\Rules;

use App\Models\Restaurant;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UpdateUniqueNameRule implements ValidationRule
{

    protected $existValue;
    public function __construct($existValue)
    {
        $this->existValue = $existValue;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $restaurants = Restaurant::all();
        foreach ($restaurants as $restaurant){
            if ($restaurant->name == $value and $value != $this->existValue){
                $fail('this name is already taken');
            }
        }
    }
}
