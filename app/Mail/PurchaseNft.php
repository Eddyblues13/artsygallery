<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PurchaseNft extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'NFT Purchase Confirmation — ' . ($this->data['nft_name'] ?? 'Artwork'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.purchase_nft',
            with: ['data' => $this->data],
        );
    }
}
