<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConversationReply extends Model
{
    use HasFactory;
    protected $casts = [
        'created_at' => 'datetime:[g:i A] M.d,Y',
    ];
}
