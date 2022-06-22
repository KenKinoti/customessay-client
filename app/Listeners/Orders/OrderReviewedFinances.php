<?php

namespace App\Listeners\Orders;

use App\Accountant\Wallet;
use App\Events\Orders\OrderReviewed;
use App\Models\Orders\EligiblePayment;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderReviewedFinances
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
     * @param  OrderReviewed  $event
     * @return void
     */
    public function handle(OrderReviewed $event)
    {
        if ($event->afterAcceptance) {
            $order = $event->order;
            $eligiblePayments = $order->eligiblePayments;

            foreach ($eligiblePayments as $payment) {
                Wallet::debit($payment->amount, 'Order #'.$order->id.' reviewed', $payment->user_id);
                $payment->status = EligiblePayment::INVALIDATED;
                $payment->save();
            }
        }
    }
}
