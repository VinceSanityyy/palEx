<?php

namespace App\Http\Controllers\FrontSide;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function getProducts(){
        $products = Product::with('vendor')->orderBy('name')->get();
        return response()->json($products, 200);
    }
}
