<?php

namespace App\Listeners\Orders;

use App\Events\Orders\OrderAutoAccepted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Orders\OrderAutoAccepted as AutoAcceptedNotification;

class AutoAcceptedOrderNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderAutoAccepted  $event
     * @return void
     */
    public function handle(OrderAutoAccepted $event)
    {
        Notification::send($event->order->client, new AutoAcceptedNotification($event->order));
    }
}
