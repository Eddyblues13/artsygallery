@extends('emails.partials.layout')

@section('content')
<h1>Email Verification</h1>
<p>Welcome to ArtistToCollectors! Please use the code below to complete your registration:</p>

<div class="code-box">
    <span class="code">{{ $validToken }}</span>
</div>

<p><strong>Security tips:</strong></p>
<ul style="color:#4a5568; font-size:15px; line-height:24px; padding-left:20px;">
    <li>Never share your verification code with anyone</li>
    <li>Our staff will never ask for your code</li>
    <li>Make sure you are on the official ArtistToCollectors website</li>
</ul>
@endsection
