<?php

namespace App\Listeners\Orders;

use App\Events\Orders\OrderAccepted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AcceptedOrderNotification
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
     * @param  OrderAccepted  $event
     * @return void
     */
    public function handle(OrderAccepted $event)
    {
        //
    }
}
