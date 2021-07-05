<?php

namespace App\Http\Controllers;

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
    { }

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
