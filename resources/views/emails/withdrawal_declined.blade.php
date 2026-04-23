@extends('emails.partials.layout')

@section('content')
<h1>Withdrawal Declined</h1>
<p>Dear {{ $data['name'] }},</p>
<p>Your withdrawal request was reviewed but could not be approved at this time.</p>

<div class="info-card">
    <p><span class="label">Amount:</span> <span class="value">{{ $data['amount_formatted'] }}</span></p>
    @if($data['eth_amount'])
    <p><span class="label">ETH Equivalent:</span> <span class="value">≈ {{ $data['eth_amount'] }}</span></p>
    @endif
    <p><span class="label">Method:</span> <span class="value">{{ ucfirst($data['method']) }}</span></p>
    <p><span class="label">Reference:</span> <span class="value">{{ $data['reference'] }}</span></p>
    <p><span class="label">Current Balance:</span> <span class="value">{{ $data['balance_formatted'] }}</span></p>
    @if($data['balance_eth'])
    <p><span class="label">Balance in ETH:</span> <span class="value">≈ {{ $data['balance_eth'] }}</span></p>
    @endif
    <p><span class="label">Date:</span> <span class="value">{{ $data['date'] }}</span></p>
    <p><span class="label">Status:</span> <span class="value" style="color:#dc2626;">Declined</span></p>
</div>

<p>Please confirm your withdrawal details and try again.</p>

<div style="text-align:center; margin:28px 0;">
    <a href="{{ url('/withdrawal') }}" class="btn-primary">Submit New Withdrawal</a>
</div>
@endsection