@extends('emails.partials.layout')

@section('content')
<h1>Deposit Approved</h1>
{!! $userMessage !!}
<p style="margin-top:24px;">Your funds are now available in your account.</p>

<div style="text-align:center; margin:28px 0;">
    <a href="{{ url('/user/dashboard') }}" class="btn-primary">View Your Balance</a>
</div>
@endsection
