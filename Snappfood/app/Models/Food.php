<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $table= 'foods';

    protected $fillable=[
      'name',
      'price',
      'raw_material',
        'image_path',
        'type_of_food_id',
        'restaurant_id',
        'is_deleted'
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function typeOfFood()
    {
        return $this->belongsTo(TypeOfFood::class);
    }

}
