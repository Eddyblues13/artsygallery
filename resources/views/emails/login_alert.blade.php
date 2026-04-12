@extends('emails.partials.layout')

@section('content')
<h1>New Login Detected</h1>
<p>Dear {{ $data['name'] }},</p>
<p>We detected a new sign-in to your ArtistToCollectors account. Here are the details:</p>

<div class="info-card">
    <p><span class="label">Date &amp; Time:</span> <span class="value">{{ $data['login_time'] }}</span></p>
    <p><span class="label">IP Address:</span> <span class="value">{{ $data['ip'] }}</span></p>
    <p><span class="label">Browser / Device:</span> <span class="value">{{ $data['user_agent'] }}</span></p>
</div>

<p>If this was you, no action is needed. If you did not sign in, please change your password immediately and contact our
    support team.</p>

<div style="text-align:center; margin:28px 0;">
    <a href="{{ url('/settings') }}" class="btn-primary">Review Account Settings</a>
</div>

<p style="font-size:13px; color:#9ca3af; margin-top:24px;">For your security, we send a notification for every login to
    your account.</p>
@endsection