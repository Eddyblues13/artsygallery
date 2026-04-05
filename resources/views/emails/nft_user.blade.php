@extends('emails.partials.layout')

@section('content')
<h1>NFT Creation Confirmation</h1>
<p>Dear {{ $user['full_name'] }},</p>
<p>Your NFT has been submitted. Here are the details:</p>

<div class="info-card">
    <p><span class="label">NFT Name:</span> <span class="value">{{ $user['name'] }}</span></p>
    <p><span class="label">Amount:</span> <span class="value">${{ $user['amount'] }} USD</span></p>
    <p><span class="label">Reference:</span> <span class="value">{{ $user['ref'] }}</span></p>
    <p><span class="label">Status:</span> <span class="value">{{ $user['status'] }}</span></p>
</div>

<p>You will be notified when your NFT status is updated.</p>
@endsection
