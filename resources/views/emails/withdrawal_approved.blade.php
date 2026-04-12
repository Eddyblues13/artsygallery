@extends('emails.partials.layout')

@section('content')
<h1>Withdrawal Approved</h1>
<p>Dear {{ $data['name'] }},</p>
<p>Your withdrawal has been approved and processed successfully.</p>

<div class="info-card">
    <p><span class="label">Amount:</span> <span class="value">{{ $data['amount_formatted'] }}</span></p>
    @if($data['eth_amount'])
    <p><span class="label">ETH Equivalent:</span> <span class="value">≈ {{ $data['eth_amount'] }}</span></p>
    @endif
    <p><span class="label">Method:</span> <span class="value">{{ ucfirst($data['method']) }}</span></p>
    <p><span class="label">Reference:</span> <span class="value">{{ $data['reference'] }}</span></p>
    <p><span class="label">Remaining Balance:</span> <span class="value">{{ $data['balance_formatted'] }}</span></p>
    @if($data['balance_eth'])
    <p><span class="label">Balance in ETH:</span> <span class="value">≈ {{ $data['balance_eth'] }}</span></p>
    @endif
    <p><span class="label">Date:</span> <span class="value">{{ $data['date'] }}</span></p>
    <p><span class="label">Status:</span> <span class="value" style="color:#059669;">Approved</span></p>
</div>

<p>The funds have been sent to your designated account. Please allow some time for the transfer to reflect depending on
    your withdrawal method.</p>

<div style="text-align:center; margin:28px 0;">
    <a href="{{ url('/transactions') }}" class="btn-primary">View Transaction History</a>
</div>

<p style="font-size:13px; color:#9ca3af;">Thank you for using ArtistToCollectors.</p>
@endsection