@extends('emails.partials.layout')

@section('content')
<h1>NFT Approved — Now Live!</h1>
<p>Dear {{ $data['name'] }},</p>
<p>Congratulations! Your artwork has been approved and is now live on the ArtistToCollectors marketplace.</p>

<div class="info-card">
    <p><span class="label">NFT Name:</span> <span class="value">{{ $data['nft_name'] }}</span></p>
    <p><span class="label">Listed Price:</span> <span class="value">{{ $data['price_formatted'] }}</span></p>
    @if($data['eth_amount'])
    <p><span class="label">ETH Equivalent:</span> <span class="value">≈ {{ $data['eth_amount'] }}</span></p>
    @endif
    <p><span class="label">Reference:</span> <span class="value">{{ $data['reference'] }}</span></p>
    <p><span class="label">Date:</span> <span class="value">{{ $data['date'] }}</span></p>
    <p><span class="label">Status:</span> <span class="value" style="color:#059669;">Approved &amp; Listed</span></p>
</div>

<p>Your artwork is now visible to collectors worldwide. Share it with your audience to maximize exposure and sales.</p>

<div style="text-align:center; margin:28px 0;">
    <a href="{{ url('/approved_nft') }}" class="btn-primary">View on Marketplace</a>
</div>
@endsection