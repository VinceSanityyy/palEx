<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
