<?php

namespace App\Http\Controllers\FrontSide;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Newsfeed;
use Illuminate\Support\Facades\Auth;
class ProductsController extends Controller
{
    public function getProducts()
    {
        $products = Product::with('vendor')->orderBy('name')->where('status','1')->get();
        return response()->json($products, 200);
    }
    public function getProductsByVendorId($vendor_id)
    {
        $products = Product::with('vendor')->where('user_Id', $vendor_id)->where('status','1')->orderBy('name')->get();
        return response()->json($products, 200);
    }

    public function getFeeds(){
        // dd('test');
        $feeds = Newsfeed::all();
        return response()->json($feeds,200);
    }

    public function changeProductStatus(Request $request, $id)
    {
        try {
            Product::where('id',$id)
            ->where('user_id', Auth::user()->id)
            ->update([
                'status' => $request->status
            ]);
            return response()->json('Success');
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }
}
