<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $message;

    public function __construct(array $message)
    {
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->view('mail.contact_message', [
            'user_name' => $this->message['user_name'],
            'user_email' => $this->message['user_email'],
            'user_id' => $this->message['user_id'],
            'subject' => $this->message['subject'],
            'text' => $this->message['text'],
        ]);
    }
}
