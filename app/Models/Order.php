<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
protected $fillable = ['user_id','customer_id','table_number', 'total', 'status'];

    // Order belongs to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Order has many Drinks (pivot)
    public function drinks()
    {
        return $this->belongsToMany(Drink::class, 'order_drink')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }


}
