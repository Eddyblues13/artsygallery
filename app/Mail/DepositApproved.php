<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DepositApproved extends Mailable
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
            subject: 'Deposit Approved — Funds Available',
        );
    }

    public function content()
    {
        return new Content(
            view: 'emails.deposit_approved',
            with: ['data' => $this->data],
        );
    }
}
        return [];
    }
}
