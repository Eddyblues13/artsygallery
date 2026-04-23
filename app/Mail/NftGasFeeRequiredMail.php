<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NftGasFeeRequiredMail extends Mailable
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
            subject: 'NFT Upload Gas Fee Payment Required',
        );
    }

    public function content()
    {
        return new Content(
            view: 'emails.nft_gas_fee_required',
            with: ['data' => $this->data],
        );
    }
}
