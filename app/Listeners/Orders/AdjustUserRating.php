<?php

namespace App\Listeners\Orders;

use App\Rating\Rater;
use App\Events\Orders\OrderAutoAccepted;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdjustUserRating implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  OrderAutoAccepted $event
     * @return void
     */
    public function handle($event)
    {
        Rater::update($event->order);
    }
}
