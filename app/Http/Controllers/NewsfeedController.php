<?php

namespace App\Http\Controllers;

use App\Models\Newsfeed;
use Illuminate\Http\Request;
use App\Models\User;
use App\PalexServices\PalexNotificationService;

class NewsfeedController extends Controller
{
    public function getUsers(){
        $users = User::whereIn('role',['1','2'])->get();
        return response()->json($users,200);
    }

    public function approveUser(Request $request){
        $user = User::find($request->id);
        $user->status = 1;
        $user->save();

        return response()->json('updated!');
    }

    public function createFeeds(Request $request){
        $news = new Newsfeed;
        $news->title = $request->title;
        $news->body = $request->body;
        $news->user_id = \Auth::user()->id;
        $news->image = '';
        $news->save();
        $notify = new PalexNotificationService;
        $users = User::where('role',2)->get();
        foreach ($users as $user){
            $notify->send_feeds_notification($request->title, $user->id);
        }
        return response()->json('Success',200);
    }

    public function getNewsfeedCount(){
        $news =  Newsfeed::count();
        return response()->json($news);
    }
}
