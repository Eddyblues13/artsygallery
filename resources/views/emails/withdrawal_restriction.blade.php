@extends('emails.partials.layout')

@section('content')
<h1>Withdrawal Restriction Notice</h1>
{!! $userMessage !!}
<p style="margin-top:24px;">If you believe this is an error, please contact our support team for assistance.</p>
@endsection
