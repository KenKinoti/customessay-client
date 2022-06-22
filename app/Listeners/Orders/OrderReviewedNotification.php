<?php

namespace App\Listeners\Orders;

use App\Events\Orders\OrderReviewed;
use App\Notifications\Remote\NotifyEmployee;
use App\Notifications\Remote\NotifyWriter;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderReviewedNotification
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
     * @param  OrderReviewed $event
     * @return void
     */
    public function handle(OrderReviewed $event)
    {
        (new NotifyWriter($event->order->writer->website))->orderRevised($event->order);
        (new NotifyEmployee($event->order->employee->website))->orderRevised($event->order);
    }
}
