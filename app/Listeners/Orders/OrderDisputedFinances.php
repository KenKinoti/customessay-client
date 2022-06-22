<?php

namespace App\Listeners\Orders;

use App\Accountant\Wallet;
use App\Events\Orders\OrderDisputed;
use App\Models\Orders\EligiblePayment;

class OrderDisputedFinances
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
     * @param  OrderDisputed $event
     * @return void
     */
    public function handle(OrderDisputed $event)
    {
        if ($event->afterAcceptance) {
            $order = $event->order;
            $eligiblePayments = $order->eligiblePayments;

            foreach ($eligiblePayments as $payment) {
                Wallet::debit($payment->amount, 'Order #'.$order->id.' disputed', $payment->user_id);
                $payment->status = EligiblePayment::INVALIDATED;
                $payment->save();
            }
        }
    }
}
