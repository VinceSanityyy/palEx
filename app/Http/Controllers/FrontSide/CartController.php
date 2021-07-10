<?php

namespace App\Http\Controllers\FrontSide;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
