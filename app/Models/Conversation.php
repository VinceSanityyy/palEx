<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Conversation extends Model
{
    use HasFactory;

    /**
     * Get the user that owns the Conversation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user_one()
    {
        // return $this->belongsTo(User::class, 'foreign_key', 'other_key');
        return $this->belongsTo('App\Models\User', 'user_one_id');
    }

    public function user_two()
    {
        return $this->belongsTo('App\Models\User', 'user_two_id');
    }
    public function con_replies()
    {
        return $this->hasMany('App\Models\ConversationReply', 'conversation_id');
    }
    public function scopeConversationJoinReplies($query)
    {
        $query
            ->select(
                'conversations.*',
                'conversation_replies.id as cr_id',
                'conversation_replies.reply as cr_last_msg',
                'conversation_replies.created_at as cr_created_at'
            )
            ->join('conversation_replies', function ($join) {
                $join->on('conversations.id', '=', 'conversation_replies.conversation_id')
                    ->on('conversation_replies.id', '=', DB::raw("(SELECT max(id) from conversation_replies WHERE conversation_replies.conversation_id = conversations.id)"));
            })
            ->orderBy('cr_created_at', 'desc');
        return $query;
    }
    public function scopeConversationLeftJoinReplies($query)
    {
        $query
            ->select(
                'conversations.*',
                'conversation_replies.id as cr_id',
                'conversation_replies.reply as cr_last_msg',
                'conversation_replies.created_at as cr_created_at'
            )
            ->leftJoin('conversation_replies', function ($join) {
                $join->on('conversations.id', '=', 'conversation_replies.conversation_id')
                    ->on('conversation_replies.id', '=', DB::raw("(SELECT max(id) from conversation_replies WHERE conversation_replies.conversation_id = conversations.id)"));
            })
            ->orderBy('cr_created_at', 'desc');

        return $query;
    }
}
