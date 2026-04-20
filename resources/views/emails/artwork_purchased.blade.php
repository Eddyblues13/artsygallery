@extends('emails.partials.layout')

@section('content')
<h1>Your Artwork Has Been Purchased!</h1>
<p>Dear {{ $data['name'] }},</p>
<p>We're excited to let you know that your artwork has been purchased on the ArtistToCollectors marketplace.</p>

<div class="info-card">
    <p><span class="label">Artwork Name:</span> <span class="value">{{ $data['nft_name'] }}</span></p>
    <p><span class="label">Purchase Price:</span> <span class="value">{{ $data['price_formatted'] }}</span></p>
    @if(!empty($data['eth_amount']))
    <p><span class="label">ETH Equivalent:</span> <span class="value">≈ {{ $data['eth_amount'] }}</span></p>
    @endif
    <p><span class="label">Buyer:</span> <span class="value">{{ $data['buyer'] }}</span></p>
    <p><span class="label">Date:</span> <span class="value">{{ $data['date'] }}</span></p>
    <p><span class="label">Status:</span> <span class="value" style="color:#059669;">Purchased</span></p>
</div>

<p>Congratulations on your sale! The artwork ownership has been transferred to the buyer.</p>

<div style="text-align:center; margin:28px 0;">
    <a href="{{ url('/my_nft') }}" class="btn-primary">View My Artworks</a>
</div>

<p style="font-size:13px; color:#9ca3af;">This is an automated notification. Please retain this email for your records.
</p>
@endsection