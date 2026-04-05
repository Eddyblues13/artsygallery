@extends('emails.partials.layout')

@section('content')
<h1>NFT Unstaking Notification</h1>
<p>Dear {{ $data['name'] }},</p>
<p>Your NFT unstaking request has been received. Please note the following:</p>

<div class="info-card">
    <p><span class="label">Status:</span> <span class="value">Processing</span></p>
    <p><span class="label">Gas Fee:</span> <span class="value">10% of realized profit</span></p>
</div>

<p>Your profits will be available in your wallet once the blockchain transaction is complete. This process may take some time depending on network activity.</p>

<p>If you have any questions, please contact our support team.</p>
@endsection
