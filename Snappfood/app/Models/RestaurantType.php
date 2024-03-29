<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantType extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_of_restaurant_id',
        'restaurant_id'
    ];

    public function typeOfRestaurant()
    {
        return $this->belongsTo(TypeOfRestaurant::class);
    }
}
