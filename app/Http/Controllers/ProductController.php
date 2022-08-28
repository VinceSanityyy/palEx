<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Enums\ProductStatus;
class ProductController extends Controller
{
    public function addProduct(Request $request){
        $isValid = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'string'],
            'category' => ['required',],
            'photo' => ['required','image'],
            'unit' => ['required']
        ]);
        if($isValid){
            $name = $request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->store('public/images/products');
            return Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'category' => $request->category,
                'unit' => $request->unit,
                'photo' => $path,
                'user_id' => \Auth::user()->id,
                'status' => $request->status
            ],200);
        }
    }
    public function getProductsPerVendor(){
        $products = Product::where('user_id',\Auth::user()->id)->get();
        return response()->json($products);
    }
    public function updateProduct(Request $request,$id){
        if($request->file('photo')) {
            $isValid = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'price' => ['required', 'string'],
                'category' => ['required',],
                'photo' => ['required','image'],
                'unit' => ['required']
            ]);
            if($isValid){
                $name = $request->file('photo')->getClientOriginalName();
                $path = $request->file('photo')->store('public/images/products');
                return Product::find($id)
                    ->update([
                    'name' => $request->name,
                    'price' => $request->price,
                    'category' => $request->category,
                    'unit' => $request->unit,
                    'photo' => $path,
                    'user_id' => \Auth::user()->id,
                    'status' => $request->status
                    ]);
            }
        }else{
            $isValid = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'price' => ['required', 'string'],
                'category' => ['required',],
                'unit' => ['required']
            ]);
            if($isValid){
                return Product::find($id)
                    ->update([
                    'name' => $request->name,
                    'price' => $request->price,
                    'category' => $request->category,
                    'unit' => $request->unit,
                    'user_id' => \Auth::user()->id,
                    'status' => $request->status
                    ]);
            }
        }

    }
}
