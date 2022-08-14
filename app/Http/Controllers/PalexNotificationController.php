<?php

namespace App\Http\Controllers;

use App\Models\PalexNotification;
use stdClass;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PalexNotificationController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get_user_notifications()
    {
        $notifs =  PalexNotification::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        foreach ($notifs as $key => $value) {
            # code...

            if ($value->other_data) {
                $value->other_data = json_decode($value->other_data);
            } else {
                $value->other_data = null;
            }
        }

        $class = new stdClass;
        $class->total_notifications = PalexNotification::where('user_id', Auth::user()->id)->count();
        $class->total_unseen_notifications = PalexNotification::where('user_id', Auth::user()->id)->where('seen', 0)->count();
        $class->notifications = $notifs;



        return response()->json($class);
    }
}
