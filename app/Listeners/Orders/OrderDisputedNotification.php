<?php

namespace App\Listeners\Orders;

use App\Events\Orders\OrderDisputed;
use App\Notifications\Remote\NotifyEmployee;
use App\Notifications\Remote\NotifyWriter;

class OrderDisputedNotification
{

    /**
     * Handle the event.
     *
     * @param  OrderDisputed $event
     * @return void
     */
    public function handle(OrderDisputed $event)
    {
        (new NotifyWriter($event->order->writer->website))->orderDisputed($event->order);
        (new NotifyEmployee($event->order->employee->website))->orderDisputed($event->order);
    }
}
