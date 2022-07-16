<?php

namespace App\Http\Controllers\FrontSide;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ShippingFee;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function place_order()
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
                $ShippingFee =   ShippingFee::where('vendor_id', $VENDOR_ID)->first();
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
                $Order->shipping_fee = $ShippingFee->shipping_fee_amount;
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

    public function getCartCounter()
    {
        $cartIsExist = Cart::where('customer_id', Auth::user()->id)->exists();
        if ($cartIsExist) {
            $cart =  Cart::where('customer_id', Auth::user()->id)->first();
            return  $cart->cart_items->count();
        } else {
            return 0;
        }
    }

    public function getCart()
    {
        $cartIsExist = Cart::where('customer_id', Auth::user()->id)->exists();
        if ($cartIsExist) {
            $cart =  Cart::where('customer_id', Auth::user()->id)->first();

            // $data = [];

            $CartItems = CartItem::with('vendor:id,name,email')
                ->where('cart_id', $cart->id)
                ->selectRaw('vendor_id, count(*) as total_items')
                ->groupBy('vendor_id')
                ->get();

            // dd($CartItems);

            // return response()->json($shippingFees, 200);

            $total_order_amount = 0;
            $total_order_amount_with_shipping_fee = 0;
            $total_items = 0;
            $total_items_qty = 0;
            $total_shipping_fee = 0;

            foreach ($CartItems as $key => $value) {
                $value->vendor_id;

                $cart_items_per_vendor = CartItem::with('product:id,name,price,category,unit,photo')
                    ->where('cart_id',  $cart->id)
                    ->where('vendor_id', $value->vendor_id)
                    ->get();

                $ShippingFee =   ShippingFee::where('vendor_id', $value->vendor_id)->first();


                $subTotalPerVendor = 0;
                foreach ($cart_items_per_vendor as $key2 => $value2) {
                    $value2->subTotal = $value2->quantity * $value2->product->price;
                    $subTotalPerVendor =  $subTotalPerVendor + $value2->subTotal;
                    $total_items = $total_items + 1;
                    $total_items_qty = $total_items_qty + $value2->quantity;
                }

                $value->subtotal =  $subTotalPerVendor;
                $value->vendor_shipping_fee_amount =  $ShippingFee->shipping_fee_amount;
                $value->subtotal_with_shipping_fee =  $subTotalPerVendor + $ShippingFee->shipping_fee_amount;
                $value->items =  $cart_items_per_vendor;

                // $total_order_amount =  $total_order_amount + $subTotalPerVendor;
                $total_order_amount =  $total_order_amount + $value->subtotal;
                $total_shipping_fee = $total_shipping_fee + $value->vendor_shipping_fee_amount;
            }

            $discount = 0;

            $total_order_amount_with_shipping_fee =  $total_order_amount + $total_shipping_fee;
            $over_all_total = ($total_order_amount + $total_shipping_fee) - $discount;


            $class = new stdClass;
            $class->total_order_amount =   $total_order_amount;
            $class->total_order_amount_with_shipping_fee =   $total_order_amount_with_shipping_fee;
            $class->total_shipping_fee =   $total_shipping_fee;
            $class->discount =   $discount;
            $class->over_all_total = $over_all_total;
            $class->total_items = $total_items;
            $class->total_items_qty = $total_items_qty;
            $class->details = $CartItems;
            $class->user_id = Auth::user()->id;

            return response()->json($class, 200);
        } else {
            return response()->json("nothing in cart", 200);
        }
    }

    public function addToCart(Request $request)
    {
        $isValid = $request->validate([
            'product_id' => ['required'],
            'vendor_id' => ['required'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);
        if ($isValid) {

            $cartIsExist = Cart::where('customer_id', Auth::user()->id)->exists();

            if ($cartIsExist) {
                $cart =  Cart::where('customer_id', Auth::user()->id)->first();
            } else {
                $cart = new Cart;
                $cart->customer_id =  Auth::user()->id;
                $cart->save();
            }

            $productIsExist = CartItem::where('cart_id', $cart->id)
                ->where('vendor_id', $request->vendor_id)
                ->where('product_id', $request->product_id)
                ->exists();

            if ($productIsExist) {

                $CartItem = CartItem::where('cart_id',  $cart->id)
                    ->where('vendor_id', $request->vendor_id)
                    ->where('product_id', $request->product_id)
                    ->first();
                $CartItem->quantity = ($CartItem->quantity + $request->quantity);
                $CartItem->save();
                return response()->json([
                    'status' => 'success'
                ]);
            } else {
                $CartItem = new CartItem;
                $CartItem->cart_id = $cart->id;
                $CartItem->vendor_id = $request->vendor_id;
                $CartItem->product_id = $request->product_id;
                $CartItem->quantity = $request->quantity;
                $CartItem->save();
                return response()->json([
                    'status' => 'success'
                ]);
            }
        }
    }
    public function updateCartItem(Request $request)
    {

        $isValid = $request->validate([
            'cart_item_id' => ['required'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);
        if ($isValid) {
            $cartContent = CartItem::findOrFail($request->cart_item_id);
            $cartContent->quantity = $request->quantity;
            $cartContent->save();
            return response()->json([
                'status' => 'success'
            ]);
        }
    }

    public function removeCartItem(Request $request)
    {
        $cartItem = CartItem::where('id', $request->cart_item_id)->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }

    public function clearCart()
    {
        try {
            $cart =  Cart::where('customer_id', Auth::user()->id)->first();
            // return $cart;
            $CartItem = CartItem::where('cart_id', $cart->id)->delete();
            return response()->json([
                'status' => 'success'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'fail',
                'error' => $th
            ]);
        }
    }
}
