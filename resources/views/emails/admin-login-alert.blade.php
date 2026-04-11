@extends('emails.partials.layout')

@section('content')
<h2 style="margin:0 0 8px; font-size:22px; color:#1a1a2e;">Admin Login Detected</h2>
<p style="color:#555; line-height:1.6; margin:0 0 20px;">
    A new admin login was recorded on <strong>{{ config('app.name') }}</strong>. Here are the details:
</p>

<div class="info-card">
    <table width="100%" cellpadding="0" cellspacing="0" style="font-size:14px; color:#333;">
        <tr>
            <td style="padding:8px 0; font-weight:600; width:140px; color:#667085;">Admin Name</td>
            <td style="padding:8px 0;">{{ $data['name'] }}</td>
        </tr>
        <tr>
            <td style="padding:8px 0; border-top:1px solid #f0f0f0; font-weight:600; color:#667085;">Email</td>
            <td style="padding:8px 0; border-top:1px solid #f0f0f0;">{{ $data['email'] }}</td>
        </tr>
        <tr>
            <td style="padding:8px 0; border-top:1px solid #f0f0f0; font-weight:600; color:#667085;">IP Address</td>
            <td style="padding:8px 0; border-top:1px solid #f0f0f0;">{{ $data['ip'] }}</td>
        </tr>
        <tr>
            <td style="padding:8px 0; border-top:1px solid #f0f0f0; font-weight:600; color:#667085;">Browser</td>
            <td style="padding:8px 0; border-top:1px solid #f0f0f0;">{{ $data['user_agent'] }}</td>
        </tr>
        <tr>
            <td style="padding:8px 0; border-top:1px solid #f0f0f0; font-weight:600; color:#667085;">Date & Time</td>
            <td style="padding:8px 0; border-top:1px solid #f0f0f0;">{{ $data['login_time'] }}</td>
        </tr>
    </table>
</div>

<p style="color:#555; line-height:1.6; margin:20px 0 0; font-size:13px;">
    If this login was not authorized, please secure the admin account immediately by changing the password and reviewing recent activity.
</p>
@endsection
