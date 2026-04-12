@extends('emails.partials.layout')

@section('content')
<h1>Welcome to ArtistToCollectors!</h1>
<p>Dear {{ $data['name'] }},</p>
<p>Thank you for creating your account. You are now part of a growing community of artists and collectors. Here are your
    login credentials:</p>

<div class="info-card">
    <p><span class="label">Email:</span> <span class="value">{{ $data['email'] }}</span></p>
    <p><span class="label">Password:</span> <span class="value">{{ $data['password'] }}</span></p>
</div>

<p><strong>Important:</strong> For your security, we strongly recommend changing your password after your first login.
</p>

<p>Here's what you can do next:</p>
<div class="step">
    <span class="step-num">1</span>
    <span style="font-size:15px; color:#4a5568;">Log in to your new account</span>
</div>
<div class="step">
    <span class="step-num">2</span>
    <span style="font-size:15px; color:#4a5568;">Complete your profile and KYC verification</span>
</div>
<div class="step">
    <span class="step-num">3</span>
    <span style="font-size:15px; color:#4a5568;">Start exploring, uploading, and trading NFTs</span>
</div>

<div style="text-align:center; margin:28px 0;">
    <a href="{{ url('/login') }}" class="btn-primary">Log In to Your Account</a>
</div>

<p style="font-size:13px; color:#9ca3af;">If you did not create this account, please ignore this email or contact our
    support team.</p>
@endsection