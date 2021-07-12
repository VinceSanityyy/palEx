<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\ConversationReply;
use App\Models\User;
use Illuminate\Http\Request;
use stdClass;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function createConversation(Request $request)
    {
        $user1 = \Auth::user();
        $user2 = User::findOrFail($request->user_id);

        $conversation = Conversation::where(function ($query) use ($user1, $user2) {
            $query->where('user_one_id', $user1->id)
                ->where('user_two_id', $user2->id);
        })->orWhere(function ($query) use ($user1, $user2) {
            $query->where('user_one_id', $user2->id)
                ->where('user_two_id', $user1->id);
        })->first();

        if (!empty($conversation)) {
            return response()->json($conversation->id, 200);
        } else {
            $newConversation = new Conversation;
            $newConversation->user_one_id = $user1->id;
            $newConversation->user_two_id = $user2->id;
            $newConversation->save();
            return response()->json($newConversation->id, 200);
        }
    }

    public function sendMessage(Request $request)
    {
        $reply = $request->msg;
        $user1 = \Auth::user();
        $user2 = User::findOrFail($request->user_id);

        $conversation = Conversation::where(function ($query) use ($user1, $user2) {
            $query->where('user_one_id', $user1->id)
                ->where('user_two_id', $user2->id);
        })->orWhere(function ($query) use ($user1, $user2) {
            $query->where('user_one_id', $user2->id)
                ->where('user_two_id', $user1->id);
        })->first();

        if (!empty($conversation)) {
            $conReply = new ConversationReply;
            $conReply->reply =  $reply;
            $conReply->user_id = $user1->id;
            $conReply->conversation_id = $conversation->id;
            $conReply->save();
            return response()->json("Done");
        } else {
            $newConversation = new Conversation;
            $newConversation->user_one_id = $user1->id;
            $newConversation->user_two_id = $user2->id;
            $newConversation->save();

            $conReply = new ConversationReply;
            $conReply->reply =  $reply;
            $conReply->user_id = $user1->id;
            $conReply->conversation_id = $newConversation->id;
            $conReply->save();
            return response()->json("Done");
        }
    }

    public function getUserChatList(Request $request)
    {
        $user1 = \Auth::user();
        // $user1 = User::findOrFail($request->user_id);

        // $conversation = Conversation::with('user_one:id,name,email,photo', 'user_two:id,name,email,photo')
        //     ->where(function ($query) use ($user1) {
        //         $query->where('user_one_id', $user1->id)
        //             ->orWhere('user_two_id', $user1->id);
        //     })->orderBy('created_at', 'desc')
        //     ->get();


        $conversation = Conversation::conversationLeftJoinReplies()
            ->with('user_one:id,name,email,photo', 'user_two:id,name,email,photo')
            ->where(function ($query) use ($user1) {
                $query->where('user_one_id', $user1->id)
                    ->orWhere('user_two_id', $user1->id);
            })
            ->get();

        foreach ($conversation as $key => $value) {
            $value->last_reply = $value->cr_last_msg;
            $value->is_active = true;
            if ($value->user_one_id == $user1->id) {
                $value->user_name = $value->user_two->name;
            } else {
                $value->user_name = $value->user_one->name;
            }
        }


        if (!empty($conversation)) {
            return response()->json($conversation, 200);
        }
    }


    public function getConversationReplies($conversation_id)
    {
        $user = \Auth::user();
        // $conversation = Conversation::findOrFail($conversation_id)->load('user_one:id,name,email,photo', 'user_two:id,name,email,photo');
        $conversation = Conversation::with('user_one:id,name,email,photo', 'user_two:id,name,email,photo')
            ->where('id', $conversation_id)
            ->where(function ($query) use ($user) {
                $query->where('user_one_id', $user->id)
                    ->orWhere('user_two_id', $user->id);
            })
            ->first();
        if (!empty($conversation)) {

            if ($conversation->user_one_id == $user->id) {
                $conversation->header_user_id = $conversation->user_two->id;
                $conversation->header_user_name = $conversation->user_two->name;
                $conversation->header_user_email = $conversation->user_two->email;
                $conversation->header_user_image_link = $conversation->user_two->image_link;
            } else {
                $conversation->header_user_id = $conversation->user_one->id;
                $conversation->header_user_name = $conversation->user_one->name;
                $conversation->header_user_email =  $conversation->user_one->email;
                $conversation->header_user_image_link =  $conversation->user_one->image_link;
            }

            $replies  = ConversationReply::where('conversation_id', $conversation->id)->orderBy('created_at', 'asc')->get();
            foreach ($replies as $key => $value) {
                if ($value->user_id == $user->id) {
                    $value->position = "right";
                } else {
                    $value->position = "left";
                }
            }
            $class = new stdClass;
            $class->conversation =   $conversation;
            $class->replies =   $replies;

            return response()->json($class, 200);
        } else {
            // $class = new stdClass;
            // $class->conversation =  null;
            // $class->replies =  null;
            // return response()->json($conversation, 200);
            abort(404);
        }
    }




    //Store
    public function getStoreChatList(Request $request)
    {
        $user1 = \Auth::user();
        // $user1 = User::findOrFail($request->user_id);

        $conversation = Conversation::conversationJoinReplies()
            ->with('user_one:id,name,email,photo', 'user_two:id,name,email,photo')
            ->where(function ($query) use ($user1) {
                $query->where('user_one_id', $user1->id)
                    ->orWhere('user_two_id', $user1->id);
            })
            ->get();

        $store_conversation_list = [];

        foreach ($conversation as $key => $value) {
            $value->last_reply = $value->cr_last_msg;
            $value->is_active = true;
            if ($value->user_one_id == $user1->id) {
                $value->user_name = $value->user_two->name;
            } else {
                $value->user_name = $value->user_one->name;
            }
            array_push($store_conversation_list, $value);
        }

        return response()->json($store_conversation_list, 200);
    }
}
