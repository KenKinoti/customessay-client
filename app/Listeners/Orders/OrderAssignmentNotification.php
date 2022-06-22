<?php

namespace App\Listeners\Orders;

use App\Events\Orders\OrderCompleted;
use App\Models\Configurations\Website;
use App\Models\Orders\Order;
use App\Notifications\Remote\NotifyWriter;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderAssignmentNotification implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  OrderCompleted $event
     * @return void
     */
    public function handle(OrderCompleted $event)
    {
        if ($event->order->writer_id) {
            (new NotifyWriter($event->order->writer->website))->orderAssigned($event->order);
        } else {
            // $writerWebsites = Website::writers()->get();

            //foreach($writerWebsites as $website){
            //    (new NotifyWriter($website))->newOrderAvailable($event->order);
            //}
        }
    }
}
