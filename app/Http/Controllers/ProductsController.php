<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function getProducts(){
        $products = Product::with('vendor')->get();
        return response()->json($products, 200);
    }
}
