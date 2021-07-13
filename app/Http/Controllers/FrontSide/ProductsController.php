<?php

namespace App\Http\Controllers\FrontSide;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Newsfeed;
class ProductsController extends Controller
{
    public function getProducts()
    {
        $products = Product::with('vendor')->orderBy('name')->get();
        return response()->json($products, 200);
    }
    public function getProductsByVendorId($vendor_id)
    {
        $products = Product::with('vendor')->where('user_Id', $vendor_id)->orderBy('name')->get();
        return response()->json($products, 200);
    }

    public function getFeeds(){
        // dd('test');
        $feeds = Newsfeed::all();
        return response()->json($feeds,200);
    }
}
