<?php

namespace App\Models;

use App\Casts\DayCast;
use App\Casts\RestauranStatusCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantHour extends Model
{
    protected $fillable = ['day' , 'opening_time' , 'closing_time' , 'restaurant_id' , 'is_open'];

    protected $casts = [
        'is_open' => RestauranStatusCast::class,
        'day' => DayCast::class
    ];
    use HasFactory;
}
