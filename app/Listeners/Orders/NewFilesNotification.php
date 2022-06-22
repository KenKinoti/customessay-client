<?php

namespace App\Listeners\Orders;

use App\Events\Orders\NewFilesAdded;
use App\Notifications\Remote\NotifyEmployee;
use App\Notifications\Remote\NotifyWriter;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewFilesNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewFilesAdded $event
     * @return void
     */
    public function handle(NewFilesAdded $event)
    {
        if ($event->order->employee_id) {
            (new NotifyEmployee($event->order->employee->website))->newFilesAdded($event->order);
        }

        if ($event->order->writer_id) {
            (new NotifyWriter($event->order->writer->website))->newFilesAdded($event->order);
        }
    }
}
