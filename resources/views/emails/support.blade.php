@extends('emails.partials.layout')

@section('content')
<h1>Support Request</h1>
<p>You have received a new support request from <strong>{{ $data['name'] }}</strong>.</p>
<p>Please review and respond via the admin dashboard.</p>
@endsection
