@extends('emails.partials.layout')

@section('content')
<h1>Deposit Received — Pending Confirmation</h1>
<p>Dear {{ $data['name'] }},</p>
<p>We have received your deposit and it is currently being reviewed by our team. Here are the details:</p>

<div class="info-card">
    <p><span class="label">Amount:</span> <span class="value">{{ $data['amount_formatted'] }}</span></p>
    @if($data['eth_amount'])
    <p><span class="label">ETH Equivalent:</span> <span class="value">≈ {{ $data['eth_amount'] }}</span></p>
    @endif
    <p><span class="label">Date:</span> <span class="value">{{ $data['date'] }}</span></p>
    <p><span class="label">Status:</span> <span class="value" style="color:#d97706;">Pending</span></p>
</div>

<p>Deposits are typically confirmed within 24 hours. You will receive another email once your deposit has been approved
    and credited to your account.</p>

<div style="text-align:center; margin:28px 0;">
    <a href="{{ url('/transactions') }}" class="btn-primary">View Transactions</a>
</div>

<p style="font-size:13px; color:#9ca3af;">If you did not initiate this deposit, please contact our support team
    immediately.</p>
@endsection