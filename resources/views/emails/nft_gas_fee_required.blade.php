@extends('emails.partials.layout')

@section('content')
<h1>NFT Upload Requires Gas Fee Payment</h1>
<p>Dear {{ $data['name'] }},</p>
<p>We received your NFT upload request with the <strong>With Gas Fee</strong> option selected. Before we can process and
    publish the upload, the required gas fee must be paid.</p>

<div class="info-card">
    <p><span class="label">NFT Name:</span> <span class="value">{{ $data['nft_name'] }}</span></p>
    <p><span class="label">Listing Price:</span> <span class="value">{{ $data['listing_price'] }} {{
            $data['currency_code'] }}</span></p>
    <p><span class="label">Gas Fee Due:</span> <span class="value">{{ $data['gas_fee_amount'] }} {{
            $data['currency_code'] }}</span></p>
    <p><span class="label">Reference:</span> <span class="value">{{ $data['reference'] }}</span></p>
    <p><span class="label">Status:</span> <span class="value" style="color:#d97706;">Awaiting Payment</span></p>
    <p><span class="label">Created:</span> <span class="value">{{ $data['date'] }}</span></p>
</div>

<p>The gas fee is calculated at <strong>10%</strong> of the listing amount you entered. Once payment is completed, your
    upload can proceed through the normal review process.</p>

<div style="text-align:center; margin:28px 0;">
    <a href="{{ $data['deposit_url'] }}" class="btn-primary">Pay Gas Fee</a>
</div>

<p style="font-size:13px; color:#9ca3af;">If you did not intend to use the gas fee option, you can return to the upload
    page and submit the artwork using the <strong>Without Gas Fee</strong> option instead.</p>
@endsection