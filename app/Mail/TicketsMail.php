<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     */
    public function __construct($view, $subject, array $data = [])
    {
        $this->data = $data;
        $this->view = $view;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     */
    public function build(): TicketsMail
    {
        $mail = $this->subject($this->subject)
            ->markdown($this->view)
            ->with($this->data);

        return $mail;
    }
}
