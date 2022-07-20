<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\User;

class FrontsideController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('frontside');
    }

    public function vendorProfile($vendor_id)
    {
        $vendor = User::findOrFail($vendor_id);
        if ($vendor->role == 1) {
            return view('frontside');
        } else {
            abort(404);
        }
    }

    public function chatPageByConvId($conversation_id)
    {

        $user = \Auth::user();
        $conversation = Conversation::with('user_one:id,name,email,photo', 'user_two:id,name,email,photo')
            ->where('id', $conversation_id)
            ->where(function ($query) use ($user) {
                $query->where('user_one_id', $user->id)
                    ->orWhere('user_two_id', $user->id);
            })
            ->first();
        if (!empty($conversation)) {
            return view('frontside');
        } else {
            abort(404);
        }
    }


    public function orderDetailsPAge($order_id)
    {

        $user = \Auth::user();
        $order = Order::findOrFail($order_id);
        // dd($order);
        if ($order->customer_id == $user->id) {
            return view('frontside');
        } else {
            abort(404);
        }
    }



    public function getVendorProfile($vendor_id)
    {
        $vendor = User::findOrFail($vendor_id);
        if ($vendor->role == 1) {
            return response()->json($vendor, 200);
        } else {
            abort(404);
        }
    }
}
