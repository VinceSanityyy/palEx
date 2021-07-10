<?php

namespace App\Http\Controllers\FrontSide;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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



            $total_order_amount = 0;
            $total_items = 0;
            $total_items_qty = 0;

            foreach ($CartItems as $key => $value) {
                $value->vendor_id;
                $cart_items_per_vendor = CartItem::with('product:id,name,price,category,unit,photo')
                    ->where('cart_id',  $cart->id)
                    ->where('vendor_id', $value->vendor_id)
                    ->get();

                $subTotalPerVendor = 0;
                foreach ($cart_items_per_vendor as $key2 => $value2) {
                    $value2->subTotal = $value2->quantity * $value2->product->price;
                    $subTotalPerVendor =  $subTotalPerVendor + $value2->subTotal;
                    $total_order_amount =  $total_order_amount + $value2->subTotal;
                    $total_items = $total_items + 1;
                    $total_items_qty = $total_items_qty + $value2->quantity;
                }
                $value->subtotal =  $subTotalPerVendor;
                $value->items =  $cart_items_per_vendor;
            }

            $discount = 0;
            $over_all_total = $total_order_amount - $discount;

            $class = new stdClass;
            $class->total_order_amount =   $total_order_amount;
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
}
