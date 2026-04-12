@extends('emails.partials.layout')

@section('content')
<h1>Deposit Approved</h1>
<p>Dear {{ $data['name'] }},</p>
<p>Great news! Your deposit has been approved and credited to your account.</p>

<div class="info-card">
    <p><span class="label">Amount:</span> <span class="value">{{ $data['amount_formatted'] }}</span></p>
    @if($data['eth_amount'])
    <p><span class="label">ETH Equivalent:</span> <span class="value">≈ {{ $data['eth_amount'] }}</span></p>
    @endif
    <p><span class="label">New Balance:</span> <span class="value">{{ $data['balance_formatted'] }}</span></p>
    @if($data['balance_eth'])
    <p><span class="label">Balance in ETH:</span> <span class="value">≈ {{ $data['balance_eth'] }}</span></p>
    @endif
    <p><span class="label">Date:</span> <span class="value">{{ $data['date'] }}</span></p>
    <p><span class="label">Status:</span> <span class="value" style="color:#059669;">Approved</span></p>
</div>

<p>Your funds are now available for trading and purchasing NFTs on the marketplace.</p>

<div style="text-align:center; margin:28px 0;">
    <a href="{{ url('/dashboard') }}" class="btn-primary">View Your Balance</a>
</div>
@endsection