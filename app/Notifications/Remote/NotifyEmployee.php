<?php

namespace App\Notifications\Remote;

use App\Models\Orders\Order;
use App\Http\Requests\RemoteRequest;

class NotifyEmployee extends RemoteRequest
{
    /**
     * Notify the employee they have been assigned a new order.
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
     * Notify the employee the client has assigned him the order.
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
}
