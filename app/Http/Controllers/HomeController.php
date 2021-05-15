<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function countVendors(){
        $count = User::where('role', 1)->count();
        return response()->json($count);
    }

    public function countCustomers(){
        $count = User::where('role', 2)->count();
        return response()->json($count);
    }

    public function countAcceptedVendors(){
        $count = User::where('status', 1)->where('role',1)->count();
        return response()->json($count);
    }
    
}
