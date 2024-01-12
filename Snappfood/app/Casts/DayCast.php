<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class DayCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if ($value == 0){
            return 'saturday';
        }elseif($value == 1) {
            return 'sunday';
        }elseif($value == 2) {
            return 'monday';
        }elseif($value == 3) {
            return 'tuesday';
        }elseif($value == 4) {
            return 'wednesday';
        }elseif($value == 5) {
            return 'thursday';
        }else{
            return 'friday';
        }
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if ($value == 'saturday'){
            return 0;
        }elseif($value == 'sunday') {
            return 1;
        }elseif($value == 'monday') {
            return 2;
        }elseif($value == 'tuesday') {
            return 3;
        }elseif($value == 'wednesday') {
            return 4;
        }elseif($value == 'thursday') {
            return 5;
        }else{
            return 6;
        }
    }
}
