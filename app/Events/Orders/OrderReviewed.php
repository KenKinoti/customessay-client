<?php

namespace App\Events\Orders;

use App\Models\Orders\Order;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderReviewed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The order that has been reviewed.
     *
     * @var \App\Models\Orders\Order
     */
    public $order;

    /**
     * Check at which point the order was reviewed.
     *
     * @var bool
     */
    public $afterAcceptance;

    /**
     * Create a new event instance.
     *
     * @param \App\Models\Orders\Order $order
     * @param bool $afterAcceptance
     */
    public function __construct(Order $order, bool $afterAcceptance)
    {
        $this->order = $order;
        $this->afterAcceptance = $afterAcceptance;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('order-reviewed');
    }
}
