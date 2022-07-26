<?php

namespace App\Http\Controllers\FrontSide;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
