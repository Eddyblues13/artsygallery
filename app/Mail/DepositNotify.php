<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DepositNotify extends Mailable
{
    use Queueable, SerializesModels;
    protected $adminMessage;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($adminMessage)
    {
        $this->adminMessage = $adminMessage;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Deposit Notify',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    { 
        return new Content(
        view: 'emails.deposit_notify',
        with: [
            'adminMessage' => $this->adminMessage,
        ],
    );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
