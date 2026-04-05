@extends('emails.partials.layout')

@section('content')
<h1>New Contact Message</h1>
<p>A user has submitted a contact form. Details below:</p>

<div class="info-card">
    <p><span class="label">Name:</span> <span class="value">{{ $data['name'] }}</span></p>
    <p><span class="label">Email:</span> <span class="value">{{ $data['email'] }}</span></p>
</div>

<p><strong>Message:</strong></p>
<p>{{ $data['message'] }}</p>
@endsection
