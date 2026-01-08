<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Models\Feedback;

class Order extends Model
{
protected $fillable = ['user_id',
    'customer_id',
    'table_number',
    'total',
    'status',
    'receipt_token' // ✅ ضروري];
];


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

    public function feedback()
{
    return $this->hasOne(Feedback::class);
}



}
