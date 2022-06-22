<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactFormEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Message from the contact form
     *
     * @var
     */
    protected $enquiry;

    /**
     * Create a new message instance.
     *
     * @param $enquiry
     */
    public function __construct($enquiry)
    {
        $this->enquiry = $enquiry;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Enquiry Form Message: '.$this->enquiry->subject)
                    ->markdown('emails.contact')->with([
                'message' => $this->enquiry->message,
                'senderName' => $this->enquiry->senderName,
                'senderEmail' => $this->enquiry->senderEmail,
            ]);
    }
}
