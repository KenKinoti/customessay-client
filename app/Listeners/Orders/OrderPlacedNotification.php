<?php

namespace App\Listeners\Orders;

use App\Mail\Orders\OrderPlaced AS OrderPlacedEmail;
use Illuminate\Support\Facades\Mail;
use App\Events\Orders\OrderPlaced;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderPlacedNotification implements ShouldQueue
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
     * @param  OrderCompleted  $event
     * @return void
     */
    public function handle(OrderPlaced $event)
    {
        Mail::to($event->order->client)->send(new OrderPlacedEmail($event->order));
    }
}
