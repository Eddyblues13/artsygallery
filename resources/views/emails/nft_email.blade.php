@extends('emails.partials.layout')

@section('content')
<h1>NFT Notification</h1>
<p>{{ $user['message'] }}</p>

<div class="info-card">
    <p><span class="label">NFT Name:</span> <span class="value">{{ $user['name'] }}</span></p>
    <p><span class="label">Amount:</span> <span class="value">{{ $user['amount'] }} ETH</span></p>
    <p><span class="label">Reference:</span> <span class="value">{{ $user['ref'] }}</span></p>
    <p><span class="label">Status:</span> <span class="value">{{ $user['status'] }}</span></p>
</div>
@endsection
