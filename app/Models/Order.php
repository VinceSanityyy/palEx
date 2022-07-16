<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;


    protected $guarded  = [];
    protected $appends = [
        'order_total_amount',
        'order_overall_total_amount',
        'order_products',
        'order_first_five_pictures'
    ];


    public function getOrderTotalAmountAttribute()
    {
        return $this->get_order_items_total();
    }

    public function getOrderOverallTotalAmountAttribute()
    {
        $overall_total = 0;
        $discount = $this->discount;
        $discount = 0;
        // $shipping_fee =  $this->shipping_fee;
        $shipping_fee =  0;
        $total_amount = $this->get_order_items_total();
        $overall_total = $total_amount + 0;
        $overall_total = $overall_total - $discount;
        return $overall_total;
    }

    public function getOrderProductsAttribute()
    {
        $ORDER_ID = $this->id;
        return OrderItem::with('product:id,name,category,unit,photo')
            ->where('order_id', $ORDER_ID)->get();;
    }

    public function getOrderFirstFivePicturesAttribute()
    {
        $ORDER_ID = $this->id;
        $pictures = [];

        $OrderItem = OrderItem::with('product:id,name,category,unit,photo')
            ->where('order_id', $ORDER_ID)->take(5)->get();
        foreach ($OrderItem as $key => $value) {
            array_push($pictures,  $value->product->image_link);
        }
        return $pictures;
    }


    public function get_order_items_total()
    {
        $total = 0;
        $ORDER_ID = $this->id;
        $OrderItems = OrderItem::where('order_id', $ORDER_ID)->get();
        foreach ($OrderItems as $key => $value) {
            $total = $total + ($value->price * $value->quantity);
        }
        return $total;
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\User', 'customer_id');
    }
    public function vendor()
    {
        return $this->belongsTo('App\Models\User', 'vendor_id');
    }


    public function scopeCountCustomerOrder($query, $status, $customer_id)
    {
        if ($status == 'all') {
            return $query->where('customer_id', $customer_id)->count();
        }
        return $query->where('status', $status)->where('customer_id', $customer_id)->count();
    }
}
