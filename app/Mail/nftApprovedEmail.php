<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class nftApprovedEmail extends Mailable
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
            subject: 'NFT Approved — Now Live on Marketplace',
        );
    }

    public function content()
    {
        return new Content(
            view: 'emails.nft_approved',
            with: ['data' => $this->data],
        );
    }
}
