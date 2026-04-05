@extends('emails.partials.layout')

@section('content')
<h1>NFT Purchase Confirmation</h1>
<p>Dear {{ $data['name'] }},</p>
<p>{{ $data['subject'] }}</p>

<div class="info-card">
    <p><span class="label">NFT Name:</span> <span class="value">{{ $data['ntf_name'] }}</span></p>
    <p><span class="label">Price:</span> <span class="value">{{ $data['nft_price'] }}</span></p>
</div>

<p>Full payment has been received. Please verify that the credit appears in your wallet. Note that any caution fees are refundable.</p>

<div style="text-align:center; margin:28px 0;">
    <a href="{{ url('/user/dashboard') }}" class="btn-primary">View Your Wallet</a>
</div>
@endsection
