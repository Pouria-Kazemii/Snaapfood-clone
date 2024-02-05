<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    protected $fillable = [
        'address_title',
        'address',
        'latitude',
        'longitude',
        'is_default',
        'customer_id'
    ];

    use HasFactory;
}
