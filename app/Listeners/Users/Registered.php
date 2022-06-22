<?php

namespace App\Listeners\Users;

use App\Mail\Registration\Confirm;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Auth\Events\Registered as RegisteredEvent;

class Registered implements ShouldQueue
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
     * @param  RegisteredEvent $event
     * @return void
     */
    public function handle(RegisteredEvent $event)
    {
        Mail::to($event->user)->send(new Confirm($event->user));
    }
}
