<?php

namespace App\Models;

use App\Casts\RestauranStatusCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'name',
        'phone_number',
        'address',
        'account_number',
        'banner_image_path',
        'profile_image_path',
        'is_open',
        'sending_price'
    ];

    protected $casts=[
      'is_open' => RestauranStatusCast::class
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function foods()
    {
        return $this->hasMany(Food::class);
    }

    public function restaurantHoures()
    {
        return $this->hasMany(RestaurantHour::class);
    }

    public function restaurantTypes()
    {
        return $this->hasMany(RestaurantType::class);
    }
}
