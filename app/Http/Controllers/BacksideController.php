<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\NewsFeed;
use App\Models\VendorAddress;

class BacksideController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('backside');
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
            return view('backside');
        } else {
            abort(404);
        }
    }
    public function getFeeds(){
        $feeds = Newsfeed::all();
        return response()->json($feeds,200);
    }

    public function updateVendorDetails(Request $request, $id){


        if($request->hasFile('image')){
            $isValid = $request->validate([
                'image' => ['required', 'image'],
            ]);
    
            $path = $request->file('image')->store('public/images/vendors/user_id_' . $id);
            $vendor = User::where('id',$id)->with('vendor')->first();
            $vendor->name = $request->store_name;
            $vendor->email = $request->email;
            $vendor->phone = $request->phone;
            $vendor->photo = $path;
            $vendor->save();

            $vendorAddress = VendorAddress::where('vendor_id',$id)->first();
            $vendorAddress->store_name = $request->store_name;
            $vendorAddress->phone = $request->phone;
            $vendorAddress->street = $request->street;
            $vendorAddress->barangay = $request->barangay;
            $vendorAddress->city = $request->city;
            $vendorAddress->province = $request->province;
            $vendorAddress->postal_code = $request->postal_code;
            $vendorAddress->save();

            return response()->json(['message' => 'Vendor details updated successfully'], 200);

        }else{
            $vendor = User::where('id',$id)->with('vendor')->first();
            $vendor->name = $request->store_name;
            $vendor->email = $request->email;
            $vendor->phone = $request->phone;
            $vendor->save();

            $vendorAddress = VendorAddress::where('vendor_id',$id)->first();
            $vendorAddress->store_name = $request->store_name;
            $vendorAddress->phone = $request->phone;
            $vendorAddress->street = $request->street;
            $vendorAddress->barangay = $request->barangay;
            $vendorAddress->city = $request->city;
            $vendorAddress->province = $request->province;
            $vendorAddress->postal_code = $request->postal_code;
            $vendorAddress->save();

            return response()->json(['message' => 'Vendor details updated successfully'], 200);
        }



    }
}
