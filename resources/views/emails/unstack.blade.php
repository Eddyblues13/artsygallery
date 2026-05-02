@extends('emails.partials.layout')

@section('content')
<h1 style="font-size:22px; color:#1a1a2e;">&#127881; Drops Successful Unstake</h1>
<p>Dear {{ $data['name'] }},</p>
<p>Great news — you have successfully unstaked your Notable Drop and your accumulated royalty earnings have been
    credited to your account.</p>

<div class="info-card">
    <p><span class="label">Drop:</span> <span class="value">{{ $data['nftName'] }}</span></p>
    <p><span class="label">Royalty Earned:</span> <span class="value">{{ $data['accumulatedEth'] }} ETH</span></p>
    <p><span class="label">Base Value:</span> <span class="value">{{ $data['baseEth'] }} ETH</span></p>
    <p><span class="label">Accumulation:</span> <span class="value">{{ $data['progress'] }}% of period completed</span>
    </p>
    <p><span class="label">Status:</span> <span class="value">Credited to your account</span></p>
</div>

<p>Your royalty earnings are now reflected in your account balance. Thank you for participating in our Notable Drops
    program.</p>

<p>If you have any questions, please contact our support team.</p>
@endsection