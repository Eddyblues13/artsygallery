@extends('emails.partials.layout')

@section('content')
<h1>NFT Upload Confirmation</h1>
<p>Dear {{ $data['name'] }},</p>
<p>Your artwork has been submitted successfully and is now pending review. Here are the details:</p>

<div class="info-card">
    <p><span class="label">NFT Name:</span> <span class="value">{{ $data['nft_name'] }}</span></p>
    <p><span class="label">Listed Price:</span> <span class="value">{{ $data['price_formatted'] }}</span></p>
    @if($data['eth_amount'])
    <p><span class="label">ETH Equivalent:</span> <span class="value">≈ {{ $data['eth_amount'] }}</span></p>
    @endif
    <p><span class="label">Reference:</span> <span class="value">{{ $data['reference'] }}</span></p>
    <p><span class="label">Date:</span> <span class="value">{{ $data['date'] }}</span></p>
    <p><span class="label">Status:</span> <span class="value" style="color:#d97706;">Pending Review</span></p>
</div>

<p>Our team will review your submission and you will be notified once your NFT has been approved and listed on the
    marketplace.</p>

<div style="text-align:center; margin:28px 0;">
    <a href="{{ url('/my_nft') }}" class="btn-primary">View My NFTs</a>
</div>

<p style="font-size:13px; color:#9ca3af;">Please ensure your artwork complies with our community guidelines to avoid
    delays in approval.</p>
@endsection