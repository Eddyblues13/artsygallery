@extends('emails.partials.layout')

@section('content')
<h1>Verify Your Account</h1>
<p>Thank you for registering with ArtistToCollectors. Use the activation code below to verify your account:</p>

<div class="code-box">
    <span class="code">{{ $validToken }}</span>
</div>

<p>If you did not create an account, you can safely ignore this email.</p>
@endsection
