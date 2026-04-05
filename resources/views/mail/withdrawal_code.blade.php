@extends('emails.partials.layout')

@section('content')
<h1>Withdrawal Code</h1>
<p>Use the code below to confirm your withdrawal request. This code is valid for a limited time.</p>

<div class="code-box">
    <span class="code">{{ $withdrawal_code }}</span>
</div>

<p>If you did not request this withdrawal, please contact our support team immediately.</p>
<p style="font-size:13px; color:#9ca3af;">Do not share this code with anyone.</p>
@endsection
