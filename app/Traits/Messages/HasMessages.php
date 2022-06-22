<?php

namespace App\Traits\Messages;

use App\Common\MessageStates;
use App\Models\Messages\Message;
use App\Models\Messages\MessageState;

trait HasMessages
{
    /**
     * Get all the messages sent by the user.
     *
     * @return mixed
     */
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    /**
     * Get all the messages received by the user.
     *
     * @return mixed
     */
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'recipient_id')
            ->whereHas('messageStates', function ($query) {
                $query->where('state', MessageStates::UNREAD)
                    ->orWhere('state', MessageStates::READ)
                    ->orWhere('state', MessageStates::OWN);
            });
    }

    /**
     * Get the user message states.
     *
     * @return mixed
     */
    public function messageStates()
    {
        return $this->hasMany(MessageState::class);
    }

    /**
     * Get the user unread messages.
     *
     * @return mixed
     */
    public function unreadMessages()
    {
        return $this->messageStates()->where('state', MessageStates::UNREAD);
    }
}
