<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserChatRoom extends Pivot
{
    use HasFactory;

    protected $table = 'user_chat_room';

    protected $fillable = [
        'user_id',
        'chat_room_id',
        'joined_at',
        'invited_by',
    ];

    public function inviter()
    {
        return $this->belongsTo(User::class, 'invited_by');
    }
}