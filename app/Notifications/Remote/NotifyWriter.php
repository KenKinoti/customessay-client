<?php

namespace App\Notifications\Remote;

use App\Models\User;
use App\Models\Orders\Order;
use App\Http\Requests\RemoteRequest;

class NotifyWriter extends RemoteRequest
{

    /**
     * Notify the writer the client has assigned him the order.
     *
     * @param Order $order
     * @return mixed
     */
    public function orderAssigned(Order $order)
    {
        $url = 'order-assigned';
        $data = [
            'order_id' => $order->id,
        ];

        return $this->send($url, $data);
    }

    /**
     * Notify the writer the client has assigned him the order.
     *
     * @param Order $order
     * @return mixed
     */
    public function orderRevised(Order $order)
    {
        $url = 'order-revised';
        $data = [
            'order_id' => $order->id,
        ];

        return $this->send($url, $data);
    }

    /**
     * Notify the writer the client has assigned him the order.
     *
     * @param Order $order
     * @return mixed
     */
    public function orderDisputed(Order $order)
    {
        $url = 'order-disputed';
        $data = [
            'order_id' => $order->id,
        ];

        return $this->send($url, $data);
    }

    /**
     * Notify the writer the client has assigned him the order.
     *
     * @param Order $order
     * @return mixed
     */
    public function newFilesAdded(Order $order)
    {
        $url = 'new-files-added';
        $data = [
            'order_id' => $order->id,
        ];

        return $this->send($url, $data);
    }

    /**
     * Notify the writer a new order has been placed.
     *
     * @param Order $order
     * @return mixed
     */
    public function newOrderAvailable(Order $order)
    {
        $url = 'new-order-available';
        $data = [
            'order_id' => $order->id,
        ];

        return $this->send($url, $data);
    }
}
