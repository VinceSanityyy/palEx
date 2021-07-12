<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Models\User;
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
}
