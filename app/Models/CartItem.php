<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    public function Cart()
    {
        return $this->belongsTo('App\Models\Cart', 'cart_id');
    }
    public function vendor()
    {
        return $this->belongsTo('App\Models\User', 'vendor_id');
    }
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

}
