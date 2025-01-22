<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMessage extends Model
{
    protected $table = 'users_messages'; 

    protected $fillable = [
        'from_user_id', 'to_user_id', 'message_id'
    ];

    /**
     * Get the sending user associated with the user message.
     */
    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    /**
     * Get the receiving user associated with the user message.
     */
    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }

    /**
     * Get the message associated with the user message.
     */
    public function message()
    {
        return $this->belongsTo(Message::class, 'message_id');
    }
}
