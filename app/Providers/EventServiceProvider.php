<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Illuminate\Auth\Events\Registered' => [
            'App\Listeners\Users\Registered',
        ],

        'App\Events\Orders\NewFilesAdded' => [
            'App\Listeners\Orders\NewFilesNotification',
        ],

        'App\Events\Orders\OrderPlaced'=>[
            'App\Listeners\Orders\OrderPlacedNotification',
            'App\Listeners\Orders\EmployeeOrderAssignment',
        ],

        'App\Events\Orders\OrderCompleted' => [
            'App\Listeners\Orders\OrderAssignmentNotification',
        ],

        'App\Events\Orders\OrderAccepted' => [
            'App\Listeners\Orders\AcceptedOrderFinances',
            'App\Listeners\Orders\AdjustUserRating',
        ],

        'App\Events\Orders\OrderAutoAccepted' => [
            'App\Listeners\Orders\AcceptedOrderFinances',
            'App\Listeners\Orders\AutoAcceptedOrderNotification',
            'App\Listeners\Orders\AdjustUserRating',
        ],

        'App\Events\Orders\OrderDisputed' => [
            'App\Listeners\Orders\OrderDisputedNotification',
            'App\Listeners\Orders\OrderDisputedFinances',
        ],

        'App\Events\Orders\OrderReviewed' => [
            'App\Listeners\Orders\OrderReviewedNotification',
            'App\Listeners\Orders\OrderReviewedFinances',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
