<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class nftUserEmail extends Mailable
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
            subject: 'NFT Upload Confirmation — Pending Review',
        );
    }

    public function content()
    {
        return new Content(
            view: 'emails.nft_user',
            with: ['data' => $this->data],
        );
    }
}
