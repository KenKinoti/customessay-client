<?php

namespace App\Notifications\Orders;

use App\Models\Orders\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderAutoAccepted extends Notification
{
    use Queueable;

    /**
     * @var \App\Models\Orders\Order
     */
    private $order;

    /**
     * Create a new notification instance.
     *
     * @param \App\Models\Orders\Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->markdown('emails.orders.order_auto_accepted', [
            'order' => $this->order
        ])->subject(__('notification.order.auto_accepted', ['orderId' => $this->order->id]));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => __('notification.order.auto_accepted', ['orderId' => $this->order->id]),
            'url' => route('orders.show', ['id' => $this->order->id])
        ];
    }
}
