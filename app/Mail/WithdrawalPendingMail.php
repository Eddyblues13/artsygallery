<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WithdrawalPendingMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Withdrawal Request Submitted — Pending Review',
        );
    }

    public function content()
    {
        return new Content(
            view: 'emails.withdrawal_pending',
            with: ['data' => $this->data],
        );
    }
}
