<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        "name",
        "buying_price",
        "unit_price",
        "quantity",
        "threshold_value",
        "expiry_date",
        "category_id",
        "supplier_id",
        "user_id"
    ];

    protected $appends = ['status_product'];

    public function getStatusProductAttribute()
    {
        $difference = $this->quantity - $this->threshold_value;

        if ($difference > 0) {
            return 'In stock';
        } elseif ($difference == 0) {
            return 'Low stock';
        } else {
            return 'Out stock';
        }
    }
}
