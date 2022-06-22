<?php

namespace App\Listeners\Orders;

use App\Accountant\Wallet;
use App\Events\Orders\OrderAccepted;
use App\Models\Orders\EligiblePayment;
use Illuminate\Contracts\Queue\ShouldQueue;

class AcceptedOrderFinances implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  OrderAccepted|OrderAccepted $event
     * @return void
     */
    public function handle($event)
    {
        $order = $event->order;

        $this->createEligiblePayment($order->writer_id, $order->id, $order->writer_amount);
        $this->createEligiblePayment($order->employee_id, $order->id, $order->employee_amount);

        $description = '<strong>Order #'.$order->id.'</strong>&nbsp;&nbsp;Accepted';

        Wallet::credit($order->writer_amount, $description, $order->writer_id);
        Wallet::credit($order->employee_amount, $description, $order->employee_id);
    }

    protected function createEligiblePayment($userId, $orderId, $amount)
    {
        return EligiblePayment::create([
            'user_id' => $userId,
            'order_id' => $orderId,
            'amount' => $amount,
        ]);
    }
}
