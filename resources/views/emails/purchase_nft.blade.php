@extends('emails.partials.layout')

@section('content')
<h1>NFT Purchase Confirmation</h1>
<p>Dear {{ $data['name'] }},</p>
<p>Your NFT purchase has been completed successfully. Here is your transaction summary:</p>

<div class="info-card">
    <p><span class="label">NFT Name:</span> <span class="value">{{ $data['nft_name'] }}</span></p>
    <p><span class="label">Price:</span> <span class="value">{{ $data['price_formatted'] }}</span></p>
    @if($data['eth_amount'])
    <p><span class="label">ETH Equivalent:</span> <span class="value">≈ {{ $data['eth_amount'] }}</span></p>
    @endif
    <p><span class="label">Seller:</span> <span class="value">{{ $data['seller'] }}</span></p>
    <p><span class="label">Remaining Balance:</span> <span class="value">{{ $data['balance_formatted'] }}</span></p>
    @if($data['balance_eth'])
    <p><span class="label">Balance in ETH:</span> <span class="value">≈ {{ $data['balance_eth'] }}</span></p>
    @endif
    <p><span class="label">Date:</span> <span class="value">{{ $data['date'] }}</span></p>
    <p><span class="label">Status:</span> <span class="value" style="color:#059669;">Completed</span></p>
</div>

<p>The artwork is now part of your collection. You can view and manage your NFTs from your dashboard.</p>

<div style="text-align:center; margin:28px 0;">
    <a href="{{ url('/my_nft') }}" class="btn-primary">View My Collection</a>
</div>

<p style="font-size:13px; color:#9ca3af;">This is an automated transaction confirmation. Please retain this email for
    your records.</p>
@endsection