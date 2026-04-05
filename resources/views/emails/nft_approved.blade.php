@extends('emails.partials.layout')

@section('content')
<h1>NFT Approved!</h1>
<p>Dear {{ $user['full_name'] }},</p>
<p>Your artwork has been approved and uploaded to the marketplace. Here are the details:</p>

<div class="info-card">
    <p><span class="label">NFT Name:</span> <span class="value">{{ $user['name'] }}</span></p>
    <p><span class="label">Amount:</span> <span class="value">${{ $user['amount'] }} USD</span></p>
    <p><span class="label">Reference:</span> <span class="value">{{ $user['ref'] }}</span></p>
    <p><span class="label">Status:</span> <span class="value">{{ $user['status'] }}</span></p>
</div>

<div style="text-align:center; margin:28px 0;">
    <a href="{{ url('/user/dashboard') }}" class="btn-primary">View on Marketplace</a>
</div>
@endsection
