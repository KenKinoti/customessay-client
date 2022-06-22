<?php

namespace App\Messenger;

use App\Models\User;
use App\Common\MessageFlag;
use Illuminate\Http\Request;
use App\Common\MessageStates;
use App\Models\Messages\Message;
use Illuminate\Support\Facades\Auth;
use App\Models\Messages\MessageState;
use App\Http\Requests\RemoteRequest;

class Messenger
{
    /**
     * Get the user Message.
     *
     * @return mixed
     */
    public static function userMessages()
    {
        return Message::whereHas('states', function ($query) {
            $query->whereUserId(Auth::user()->id)->where(function ($query) {
                $query->where('state', MessageStates::UNREAD)
                    ->orWhere('state', MessageStates::READ)
                    ->orWhere('state', MessageStates::OWN);
            });
        })->orderBy('created_at', 'DESC');
    }

    /**
     * Create a new message.
     *
     * @param int $recipientId
     * @param string $subject
     * @param string $message
     * @param null|int $orderId
     * @param int $senderId
     * @return \App\Models\Messages\Message
     */
    public static function send($recipientId, $subject, $message, $orderId = null, $senderId = null)
    {
        $newMessage = Message::create([
            'sender_id' => is_null($senderId) ? Auth::user()->id : $senderId,
            'recipient_id' => $recipientId,
            'subject' => $subject,
            'content' => $message,
            'order_id' => $orderId,
        ]);

        self::assignMessageStates($newMessage);

        return $newMessage;
    }

    /**
     * Add a reply to a message.
     *
     * @param Request $request
     * @return \App\Models\Messages\Message
     */
    public static function reply(Request $request)
    {
        $message = Message::findOrFail($request->message_id);

        $message = Message::create([
            'sender_id' => $message->recipient_id,
            'recipient_id' => $message->sender_id,
            'subject' => $message->subject,
            'flag' => MessageFlag::REPLY,
            'content' => $request->message,
            'order_id' => $message->order_id,
        ]);

        self::assignMessageStates($message);

        return $message;
    }

    /**
     * Mark a message as read.
     *
     * @param int $messageId
     * @return boolean
     */
    public static function read($messageId)
    {
        $message = Message::findOrFail($messageId);
        $messageState = MessageState::whereUserId(Auth::user()->id)->whereMessageId($message->id)->first();

        if ($messageState->state == MessageStates::FORWARD) {
            return false;
        }

        return $messageState->read();
    }

    /**
     * Assign message states to the new message.
     *
     * @param \App\Models\Messages\Message $message
     * @return array|\Traversable
     */
    protected static function assignMessageStates(Message $message)
    {
        if (($message->sender->userType->name == 'Writer' && $message->recipient->userType->name == 'Client') ||
            ($message->sender->userType->name == 'Client' && $message->recipient->userType->name == 'Writer')
        ) {
            self::sendRemoteNotification($message->order->employee, $message);

            return $message->states()->saveMany([
                new MessageState(['user_id' => $message->order->employee->id, 'state' => MessageStates::FORWARD]),
                new MessageState(['user_id' => $message->sender_id, 'state' => MessageStates::OWN]),
                new MessageState(['user_id' => $message->recipient_id, 'state' => MessageStates::FORWARD]),
            ]);
        }

        self::sendRemoteNotification($message->recipient, $message);

        return $message->states()->saveMany([
            new MessageState(['user_id' => $message->sender_id, 'state' => MessageStates::OWN]),
            new MessageState(['user_id' => $message->recipient_id, 'state' => MessageStates::UNREAD]),
        ]);
    }

    /**
     * Notify the remote website of the message.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Messages\Message $message
     */
    protected static function sendRemoteNotification(User $user, Message $message)
    {
        $remoteRequest = new RemoteRequest($user->website);

        $remoteRequest->send('new-message', [
            'message_id' => $message->id,
            'recipient_id' => $user->id,
        ]);
    }
}
