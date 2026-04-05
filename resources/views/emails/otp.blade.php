@extends('emails.partials.layout')

@section('content')
<h1>One-Time Verification Code</h1>
<p>Hello {{ $otp['name'] }},</p>
<p>Use the code below to verify your email address:</p>

<div class="code-box">
    <span class="code">{{ $otp['otp'] }}</span>
</div>

<p>This code will expire shortly. If you did not request this code, please ignore this email.</p>
<p style="font-size:13px; color:#9ca3af;">Do not share this code with anyone.</p>
@endsection
