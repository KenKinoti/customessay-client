<?php

namespace App\Models\Messages;

use App\Common\MessageStates;
use Illuminate\Database\Eloquent\Model;

class MessageState extends Model
{
    /**
     * Attributes that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'message_id',
        'state',
    ];

    /**
     * Mark message as read.
     *
     * @return bool
     */
    public function read()
    {
        $this->state = MessageStates::READ;
        return $this->save();
    }
}
