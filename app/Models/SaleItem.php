<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    protected $fillable = ['product_id', 'sale_id', 'unit_price', 'buying_price', 'quantity'];

    public function sales()
    {
        return $this->belongsTo(Sale::class);
    }
}
