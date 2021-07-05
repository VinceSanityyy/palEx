<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\ConversationReply;
use App\Models\User;
use Illuminate\Http\Request;


class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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

        $conversation = Conversation::with('user_one:id,name,email', 'user_two:id,name,email')
            ->where(function ($query) use ($user1) {
                $query->where('user_one_id', $user1->id)
                    ->orWhere('user_two_id', $user1->id);
            })->get();

        foreach ($conversation as $key => $value) {
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
}
