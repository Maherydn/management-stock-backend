<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['title', 'total_amount', 'user_id', 'order_status_id'];

    public function orderItems ()
    {
        return $this->hasMany(OrderItem::class); 
    }}
