<?php

namespace App\Http\Controllers\FrontSide;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\CustomerAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;

class CustomerSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function changeCustomerPicture(Request $request)
    {
        $isValid = $request->validate([
            'photo' => ['required', 'image'],
        ]);

        $CUSTOMER_ID = Auth::user()->id;
        if ($isValid) {
            $name = $request->file('photo')->getClientOriginalName();
            // $path = $request->file('photo')->store('public/images/products');
            $path = $request->file('photo')->store('public/images/users/user_id_' . $CUSTOMER_ID);
            return User::find($CUSTOMER_ID)
                ->update([
                    'photo' => $path
                ]);
        }
    }

    public function change_fullname_and_phone(Request $request)
    {

        $isValid = $request->validate([
            'fullname' => ['required'],
        ]);
        if ($isValid) {
            $CUSTOMER_ID = Auth::user()->id;
            $user = User::find($CUSTOMER_ID);
            $user->name = $request->fullname;
            $user->phone = $request->phone;
            $user->save();
            return response()->json($user, 200);
        }
    }


    public function set_selected_address($address_id)
    {

        // $isValid = $request->validate([
        //     'address_id' => ['required'],
        // ]);
        // if ($isValid) {
        $CUSTOMER_ID = Auth::user()->id;
        $CustomerAddress =  CustomerAddress::where('customer_id', $CUSTOMER_ID)->where('id', $address_id)->first();

        if (isset($CustomerAddress)) {

            CustomerAddress::where('customer_id', $CUSTOMER_ID)->update(['selected' => 0]);
            // $customer_addresses = CustomerAddress::where('customer_id', $CUSTOMER_ID)->get();
            // foreach ($customer_addresses as $key => $value) {
            //     $value->selected = 0;
            //     $value->save();
            // }
            CustomerAddress::where('customer_id', $CUSTOMER_ID)->where('id', $address_id)->update(['selected' => 1]);
            return response()->json([
                'status' => 'ok',
                'message' => 'success'
            ], 200);
        } else {
            return response()->json([
                'status' => 'fail',
                'message' => 'Address Not found'
            ], 404);
        }
        // }
    }

    public function add_customer_address(Request $request)
    {
        $isValid = $request->validate([
            'full_name' => ['required'],
            'phone' => ['required'],
            'street' => ['required'],
            'barangay' => ['required'],
            'city' => ['required'],
            'postal_code' => ['required'],
        ]);
        if ($isValid) {
            $CUSTOMER_ID = Auth::user()->id;

            $if_user_have_exist_address = CustomerAddress::where('customer_id', $CUSTOMER_ID)->where('selected', 1)->exists();

            $selected = 1;
            if ($if_user_have_exist_address) {
                $selected = 0;
            }

            $CustomerAddress =  CustomerAddress::create([
                'customer_id' => $CUSTOMER_ID,
                'full_name' => $request->full_name,
                'phone' => $request->phone,
                'street' =>  $request->street,
                'barangay' =>  $request->barangay,
                'city' =>  $request->city,
                'province' => $request->province,
                'postal_code' =>  $request->postal_code,
                'selected' =>  $selected,
            ]);
            return response()->json($CustomerAddress, 200);
        }
    }


    public function update_customer_address(Request $request)
    {
        $isValid = $request->validate([
            'id' => ['required'],
            'full_name' => ['required'],
            'phone' => ['required'],
            'street' => ['required'],
            'barangay' => ['required'],
            'city' => ['required'],
            'postal_code' => ['required'],
        ]);
        if ($isValid) {
            // $CUSTOMER_ID = Auth::user()->id;
            return CustomerAddress::find($request->id)
                ->update([
                    'full_name' => $request->full_name,
                    'phone' => $request->phone,
                    'street' =>  $request->street,
                    'barangay' =>  $request->barangay,
                    'city' =>  $request->city,
                    'province' => $request->province,
                    'postal_code' =>  $request->postal_code,
                ]);
            return response()->json(200);
        }
    }

    public function delete_customer_address(Request $request)
    {
        $CUSTOMER_ID = Auth::user()->id;
        $CustomerAddress = CustomerAddress::where('id', $request->address_id)
            ->where('customer_id', $CUSTOMER_ID)
            ->delete();

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function get_customer_addresses()
    {
        $CUSTOMER_ID = Auth::user()->id;
        $CustomerAddress =  CustomerAddress::where('customer_id', $CUSTOMER_ID)->orderBy('id', 'desc')->get();
        return response()->json($CustomerAddress, 200);
    }

    public function change_password(Request $request)
    {
        $user = Auth::user();
        if (isset($user)) {
            $isValid = $request->validate([
                'current_password' => ['required'],
                'new_password' => ['required', 'string', 'min:8'],
                'confirm_new_password' => ['required', 'string', 'min:8', 'same:new_password'],
            ]);
            $new_password = $request->new_password;
            if ($isValid) {

                if (!Hash::check($request->current_password, $user->password)) {
                    return response()->json([
                        'status' => 'fail',
                        'message' => 'Invalid current password'
                    ], 400);
                }

                $user->password = Hash::make($new_password);
                $user->save();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Password updated'
                ]);
            }
        } else {
            return response()->json([
                'status' => 'fail',
                'message' => 'User not found'
            ], 404);
        }
    }
}
