<?php

namespace App\Mail\Orders;

use App\Models\Orders\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderPlaced extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @var \App\Models\Orders\Order
     */
    public $order;

    /**
     * Create a new message instance.
     *
     * @param \App\Models\Orders\Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.orders.order_placed')
            ->subject(__('mail.placed.subject', ['orderId' => $this->order->id]));
    }
}
