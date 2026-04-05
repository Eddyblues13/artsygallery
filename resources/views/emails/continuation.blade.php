@extends('emails.partials.layout')

@section('content')
<h1>Smart Contract Continuation</h1>
<p>Dear {{ $data['name'] }},</p>
<p>Your artwork remains active on the blockchain marketplace. Your smart contract is fully operational and your collection continues to be available to collectors.</p>

<div class="info-card">
    <p><span class="label">Status:</span> <span class="value">Active</span></p>
    <p><span class="label">Platform:</span> <span class="value">ArtistToCollectors Blockchain</span></p>
</div>

<p>If you need to update your contract settings, please log in to your dashboard.</p>

<div style="text-align:center; margin:28px 0;">
    <a href="{{ url('/user/dashboard') }}" class="btn-primary">Manage Your Collection</a>
</div>
@endsection
