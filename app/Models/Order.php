<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;


    protected $casts = [
        'created_at' => 'datetime:M-d-Y',
    ];

    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }
}
