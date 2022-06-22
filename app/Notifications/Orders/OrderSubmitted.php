<?php

namespace App\Notifications\Orders;

use App\Models\Orders\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderSubmitted extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * The order the notification is about.
     *
     * @var Order
     */
    protected $order;

    /**
     * Create a new notification instance.
     *
     * @param Order $order
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
        return $notifiable->receive_emails ? ['mail', 'database'] : ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     *
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->markdown('emails.orders.order_submitted', [
            'order' => $this->order,
            'url' => route('orders.show', ['id' => $this->order->id]),
        ])->subject(__('notification.order.submitted', ['orderId' => $this->order->id]));
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
            'message' => __('notification.order.submitted', ['orderId' => $this->order->id]),
            'url' => route('orders.show', ['id' => $this->order->id]),
        ];
    }
}
