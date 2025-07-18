<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\WalletUpdateNotification;
use Illuminate\Validation\Rules\Password;

class WalletController extends Controller
{
    public function edit()
    {
        return view('dashboard.update-wallet', [
            'user' => auth()->user()
        ]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'wallet_type' => 'required|string|in:binance,trust_wallet,metamask,coinbase,other',
            'wallet_address' => 'required|string',

        ]);

        // Update user's wallet information
        $user->update([
            'wallet_type' => $validated['wallet_type'],
            'wallet_address' => $validated['wallet_address']
        ]);

        // Send email notification
        Mail::to($user->email)->send(new WalletUpdateNotification($user));

        return redirect()->route('wallet.edit')
            ->with('success', 'Wallet information updated successfully!');
    }
}
