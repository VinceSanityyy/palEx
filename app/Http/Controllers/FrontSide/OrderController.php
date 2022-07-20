<?php

namespace App\Http\Controllers\FrontSide;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShippingFee;
use Illuminate\Support\Facades\Auth;
use stdClass;


class OrderController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function placeOrder()
    {
        $CUSTOMER_ID = Auth::user()->id;
        $cartIsExist = Cart::where('customer_id', $CUSTOMER_ID)->exists();
        if ($cartIsExist) {
            $cart =  Cart::where('customer_id', $CUSTOMER_ID)->first();
            $CartPerVendors = CartItem::with('vendor:id,name,email')
                ->where('cart_id', $cart->id)
                ->selectRaw('vendor_id, count(*) as total_items')
                ->groupBy('vendor_id')
                ->get();

            foreach ($CartPerVendors as $key => $value) {

                $VENDOR_ID = $value->vendor_id;
                // $ShippingFee =   ShippingFee::where('vendor_id', $VENDOR_ID)->first();
                // $ShippingFee_Amount = $ShippingFee->shipping_fee_amount;
                $ShippingFee_Amount = 0;
                $CustomerAddress =  CustomerAddress::where('customer_id', $CUSTOMER_ID)
                    ->where('selected', 1)
                    ->first();

                $FullAddress =  $CustomerAddress->street . ", "
                    . $CustomerAddress->barangay . ", "
                    . $CustomerAddress->city . ", "
                    . $CustomerAddress->province . ", "
                    . $CustomerAddress->postal_code;

                $Order = new Order();
                $Order->customer_id = $CUSTOMER_ID;
                $Order->vendor_id = $VENDOR_ID;
                $Order->status = 'pending'; // 'pending', 'to ship', 'complete', 'cancelled';
                $Order->payment_method = 1; //  1 Cash On Delivery, 2 Online Payment, 3 Pickup; 
                $Order->customer_receiver_fullname = $CustomerAddress->full_name;
                $Order->customer_receiver_phone = $CustomerAddress->phone;
                $Order->customer_receiver_address = $FullAddress;
                $Order->shipping_fee = $ShippingFee_Amount;
                $Order->discount = 0;
                $Order->save();

                $cart_items_per_vendor = CartItem::with('product:id,name,price,category,unit,photo')
                    ->where('cart_id',  $cart->id)
                    ->where('vendor_id', $VENDOR_ID)
                    ->get();

                foreach ($cart_items_per_vendor as $key2 => $value2) {
                    $OrderItem = new OrderItem();
                    $OrderItem->order_id = $Order->id;
                    $OrderItem->vendor_id = $VENDOR_ID;
                    $OrderItem->product_id = $value2->product_id;
                    $OrderItem->quantity = $value2->quantity;
                    $OrderItem->price = $value2->product->price;
                    $OrderItem->save();
                }
            }


            $cart =  Cart::where('customer_id', $CUSTOMER_ID)->first();
            $CartItem = CartItem::where('cart_id', $cart->id)->delete();
            return response()->json([
                'status' => 'success'
            ]);
        } else {
            return response()->json("nothing in cart", 200);
        }
    }

    public function updateOrderStatus(Request $request){
        // dd($request->all());

        $order = Order::find($request->id);
        $order->status = $request->status;
        $order->save();
        return response()->json([
            'status' => 'success'
        ]);
    }

    public function getOrdersVendor(){
        $orders = Order::query()->where('vendor_id', Auth::user()->id)->with('orderItems')
            ->get();
        return response()->json($orders);
    }

    public function getCustomerOrders()
    {

        $CUSTOMER_ID = Auth::user()->id;
        $Orders = Order::with('vendor:id,name,email')
            ->where('customer_id', $CUSTOMER_ID)
            ->orderBy('id', 'DESC')
            ->get();

        $class = new stdClass;
        $class->orders = $Orders;
        $class->orders_total =    Order::countCustomerOrder('all', $CUSTOMER_ID);
        $class->orders_pending =    Order::countCustomerOrder('pending', $CUSTOMER_ID);
        $class->orders_to_deliver =  Order::countCustomerOrder('to ship', $CUSTOMER_ID);
        $class->orders_completed = Order::countCustomerOrder('completed', $CUSTOMER_ID);
        $class->orders_cancelled =   Order::countCustomerOrder('cancelled', $CUSTOMER_ID);

        return response()->json($class, 200);
    }
}
