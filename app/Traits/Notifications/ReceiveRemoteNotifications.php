<?php

namespace App\Traits\Notifications;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Orders\Order;
use App\Models\Messages\Message;
use Illuminate\Http\JsonResponse;
use App\Notifications\Orders\OrderSubmitted;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Messages\NewMessageReceived;
use App\Traits\Notifications\Users\HandlesAccountNotifications;

trait ReceiveRemoteNotifications
{
    use HandlesAccountNotifications;

    /**
     * Receive notification that an order has been submitted.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function orderSubmitted(Request $request)
    {
        $this->validate($request, ['order_id' => 'required']);

        $order = Order::findOrFail($request->order_id);

        Notification::send($order->client, new OrderSubmitted($order));

        return new JsonResponse(['success' => 'true', 'message' => 'Notification sent.']);
    }

    /**
     * Notify a user of a new message via email.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function newMessage(Request $request)
    {
        $message = Message::findOrFail($request->message_id);
        $user = $message->recipient;

        if($message->recipient_id != $request->recipient_id){
            $user = User::findOrFail($request->recipient_id);
        }

        Notification::send($user, new NewMessageReceived($message));

        return new JsonResponse(['success' => true, 'message' => 'Notification sent successfully.']);
    }
}
