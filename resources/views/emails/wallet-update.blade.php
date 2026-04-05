@extends('emails.partials.layout')

@section('content')
<h1>Withdrawal Security Review</h1>
<p>Dear {{ $user->name }},</p>
<p>Your withdrawal is currently under security review. Here are the details of your wallet balance:</p>

<div class="info-card">
    <p><span class="label">ETH Balance:</span> <span class="value">{{ $ethBalance }} ETH</span></p>
    <p><span class="label">USD Value:</span> <span class="value">${{ number_format($usdValue, 2) }}</span></p>
</div>

<p>Processing time is typically 1&ndash;21 business days. If you have any questions, please reach out to <a href="mailto:support@artisttocollectors.com" style="color:#3b7ddd; text-decoration:none;">support@artisttocollectors.com</a>.</p>
@endsection
