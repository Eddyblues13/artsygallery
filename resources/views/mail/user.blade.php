@extends('emails.partials.layout')

@section('content')
<h1>{{ $data['subject'] }}</h1>
<p>{{ $data['message'] }}</p>
<p style="margin-top:24px;">If you have any questions, please contact us at <a href="mailto:support@artisttocollectors.com" style="color:#3b7ddd; text-decoration:none;">support@artisttocollectors.com</a>.</p>
@endsection
