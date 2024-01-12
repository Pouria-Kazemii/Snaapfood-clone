<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function PHPUnit\Framework\returnArgument;

class Customer extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customerAddresses()
    {
        return $this->hasMany(CustomerAddress::class);
    }
    public function findMainAddress()
    {
        foreach ($this->customerAddresses as $customerAddress){
            if ($customerAddress->is_default){
                return $customerAddress;
            }
        }
    }
}
