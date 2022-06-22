<?php

namespace App\Notifications\Messages;

use App\Models\Messages\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewMessageReceived extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var \App\Models\Messages\Message
     */
    protected $message;

    /**
     * Create a new notification instance.
     *
     * @param \App\Models\Messages\Message $message
     */
    public function __construct(Message $message)
    {
        //
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $subject = $this->message->subject;

        if ($this->message->order_id) {
            $subject = __('notification.message.order',[
                'orderId' => $this->message->order_id,
                'subject' => $subject,
            ]);
        } else {
            $subject = __('notification.message.new', ['subject' => $subject]);
        }

        return (new MailMessage)->markdown('emails.messages.new_message_recieved', [
            'message' => $this->message,
            'recipient' => $notifiable,
        ])->subject($subject);
    }
}
