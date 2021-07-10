<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;


    public function customer()
    {
        // return $this->belongsTo(User::class, 'foreign_key', 'other_key');
        return $this->belongsTo('App\Models\User', 'customer_id');
    }

    public function cart_items()
    {
        return $this->hasMany('App\Models\CartItem', 'cart_id');
    }
}
