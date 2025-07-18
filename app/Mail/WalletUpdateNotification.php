<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WalletUpdateNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $ethBalance;
    public $usdValue;

    public function __construct($user)
    {
        $this->user = $user;
        $this->ethBalance = 20.3; // Example value - replace with actual balance
        $this->usdValue = $this->ethBalance * 2000; // Example conversion rate
    }

    public function build()
    {
        return $this->subject('Recipient Address Update Request – Currently in Progress')
            ->view('emails.wallet-update')
            ->with([
                'user' => $this->user,
                'ethBalance' => $this->ethBalance,
                'usdValue' => $this->usdValue
            ]);
    }
}
