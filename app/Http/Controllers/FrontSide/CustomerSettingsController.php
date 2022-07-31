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

    public function get_customer_addresses()
    {
        $CUSTOMER_ID = Auth::user()->id;
        $CustomerAddress =  CustomerAddress::where('customer_id', $CUSTOMER_ID)->get();
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
