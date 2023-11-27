<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItme extends Model
{
    use HasFactory;

    protected $table = 'order_items';
    public function food()
    {
        return $this->belongsTo(Food::class);
    }
}
