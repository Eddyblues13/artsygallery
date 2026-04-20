<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ArtworkSoldEmail extends Mailable
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
            subject: 'Your Artwork Has Been Sold — ' . ($this->data['nft_name'] ?? 'Artwork'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.artwork_sold',
            with: ['data' => $this->data],
        );
    }
}
