<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Feedback extends Model
{
    protected $fillable = ['order_id', 'rating', 'comment'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
