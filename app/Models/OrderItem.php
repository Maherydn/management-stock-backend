<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['product_id', 'order_id', 'unit_price', 'buying_price', 'quantity'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
