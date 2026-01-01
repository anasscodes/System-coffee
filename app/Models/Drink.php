<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Drink extends Model
{
    protected $fillable = ['name', 'price', 'is_available'];

    // Drink belongs to many Orders
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_drink')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}
