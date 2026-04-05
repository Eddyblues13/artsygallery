@extends('emails.partials.layout')

@section('content')
<h1>Funds Available</h1>
<p>Great news! Your USD balance is now available.</p>

<div class="code-box">
    <span class="code" style="font-size:28px; letter-spacing:2px;">${{ $data['balance'] }}</span>
</div>

<p>Log in to your account to manage your funds.</p>

<div style="text-align:center; margin:28px 0;">
    <a href="{{ url('/login') }}" class="btn-primary">Log In Now</a>
</div>
@endsection
