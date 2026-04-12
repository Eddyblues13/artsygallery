@extends('emails.partials.layout')

@section('content')
<h1>Profit Credited to Your Account</h1>
<p>Dear {{ $data['name'] }},</p>
<p>Great news! A trading profit has been credited to your account.</p>

<div class="info-card">
    <p><span class="label">Profit Amount:</span> <span class="value">{{ $data['amount_formatted'] }}</span></p>
    @if($data['eth_amount'])
    <p><span class="label">ETH Equivalent:</span> <span class="value">≈ {{ $data['eth_amount'] }}</span></p>
    @endif
    <p><span class="label">New Balance:</span> <span class="value">{{ $data['balance_formatted'] }}</span></p>
    @if($data['balance_eth'])
    <p><span class="label">Balance in ETH:</span> <span class="value">≈ {{ $data['balance_eth'] }}</span></p>
    @endif
    <p><span class="label">Date:</span> <span class="value">{{ $data['date'] }}</span></p>
</div>

<p>Your updated balance is now available. You can withdraw your funds or reinvest in the marketplace.</p>

<div style="text-align:center; margin:28px 0;">
    <a href="{{ url('/dashboard') }}" class="btn-primary">View Your Dashboard</a>
</div>
@endsection