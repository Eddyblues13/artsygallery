@extends('emails.partials.layout')

@section('content')
<h1>Deposit Pending</h1>
{!! $userMessage !!}
<p style="margin-top:24px;">You will receive a confirmation once your deposit has been verified and credited to your account.</p>
@endsection
