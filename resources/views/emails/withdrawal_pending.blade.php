@extends('emails.partials.layout')

@section('content')
<h1>Withdrawal Pending</h1>
{!! $userMessage !!}
<p style="margin-top:24px;">You will receive a confirmation once your withdrawal has been processed.</p>
@endsection
