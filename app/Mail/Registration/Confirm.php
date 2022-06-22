<?php

namespace App\Mail\Registration;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Confirm extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * The user receiving the email
     *
     * @var User
     */
    public $recipient;

    /**
     * Create a new message instance.
     *
     * @param $user
     *
     */
    public function __construct($user)
    {
        $this->recipient = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(__('mail.registration.subject'))->markdown('emails.registration.confirm');
    }
}
