@extends('emails.partials.layout')

@section('content')
<h1>Welcome to ArtistToCollectors!</h1>
<p>Your account has been created successfully. Here are your login credentials:</p>

<div class="info-card">
    <p><span class="label">Email:</span> <span class="value">{{ $data['email'] }}</span></p>
    <p><span class="label">Password:</span> <span class="value">{{ $data['password'] }}</span></p>
</div>

<p>For security, we recommend changing your password after your first login.</p>

<div style="text-align:center; margin:28px 0;">
    <a href="{{ url('/login') }}" class="btn-primary">Log In to Your Account</a>
</div>
@endsection
