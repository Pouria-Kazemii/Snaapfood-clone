<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable =[
      'value',
      'percent',
        'food_id'
    ];

    public function food()
    {
        return $this->belongsTo(Food::class);
    }
}
