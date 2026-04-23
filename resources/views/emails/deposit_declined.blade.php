@extends('emails.partials.layout')

@section('content')
<h1>Deposit Declined</h1>
<p>Dear {{ $data['name'] }},</p>
<p>We reviewed your recent deposit request, but we could not approve it at this time.</p>

<div class="info-card">
    <p><span class="label">Amount:</span> <span class="value">{{ $data['amount_formatted'] }}</span></p>
    @if($data['eth_amount'])
    <p><span class="label">ETH Equivalent:</span> <span class="value">≈ {{ $data['eth_amount'] }}</span></p>
    @endif
    <p><span class="label">Current Balance:</span> <span class="value">{{ $data['balance_formatted'] }}</span></p>
    @if($data['balance_eth'])
    <p><span class="label">Balance in ETH:</span> <span class="value">≈ {{ $data['balance_eth'] }}</span></p>
    @endif
    <p><span class="label">Date:</span> <span class="value">{{ $data['date'] }}</span></p>
    <p><span class="label">Status:</span> <span class="value" style="color:#dc2626;">Declined</span></p>
</div>

<p>Please verify your deposit details and submit again if needed.</p>

<div style="text-align:center; margin:28px 0;">
    <a href="{{ url('/deposit') }}" class="btn-primary">Submit New Deposit</a>
</div>
@endsection