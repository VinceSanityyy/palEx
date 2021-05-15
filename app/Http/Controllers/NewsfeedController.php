<?php

namespace App\Http\Controllers;

use App\Models\Newsfeed;
use Illuminate\Http\Request;
use App\Models\User;
class NewsfeedController extends Controller
{
    public function getUsers(){
        $users = User::all();
        return response()->json($users,200);
    }
}
