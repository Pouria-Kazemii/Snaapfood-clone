<?php

namespace App\Casts;

use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class RoleCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if ($value == 1){
            return 'admin';
        }elseif ($value == 2){
            return  'restaurant';
        }elseif($value == 3){
            return 'customer';
        }
        return true;
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if ($value == 'admin'){
            return 1;
        }elseif ($value == 'restaurant'){
            return 2;
        }elseif ($value == 'customer'){
            return 3;
        }
        return true;
    }
}
