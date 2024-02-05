<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_finished',
        'status',
        'customer_id',
        'total_amount'
    ];

    public function calculateTotalAmount()
    {
        return $this->orderItems->sum(function ($item) {
            return $item->quantity * $item->food->price;
        });
    }

    protected $table = 'orders';
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
