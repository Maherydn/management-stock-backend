<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['title', 'total_amount', 'user_id'];

    public function saleItems ()
    {
        return $this->hasMany(SaleItem::class); 
    }
}
