<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $appends = [
        'total_price',
    ];
    
    public function getTotalPriceAttribute()
    {
        return $this->price * $this->quantity;
    }
}
