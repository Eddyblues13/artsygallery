@extends('emails.partials.layout')

@section('content')
<h1>KYC Verification Approved</h1>
<p>Dear {{ $user['full_name'] }},</p>
<p>Congratulations! Your identity verification has been approved. You now have full access to all platform features.</p>

<h2 style="margin-top:24px;">Next Steps</h2>
<table role="presentation" cellpadding="0" cellspacing="0" border="0" style="width:100%;">
    <tr>
        <td style="padding:8px 0;">
            <table role="presentation" cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td style="width:28px; height:28px; background:#3b7ddd; color:#fff; border-radius:50%; text-align:center; line-height:28px; font-size:13px; font-weight:700;">1</td>
                    <td style="padding-left:12px; font-size:15px; color:#4a5568;">Upload your artwork to the marketplace</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="padding:8px 0;">
            <table role="presentation" cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td style="width:28px; height:28px; background:#3b7ddd; color:#fff; border-radius:50%; text-align:center; line-height:28px; font-size:13px; font-weight:700;">2</td>
                    <td style="padding-left:12px; font-size:15px; color:#4a5568;">Complete your artist profile</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="padding:8px 0;">
            <table role="presentation" cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td style="width:28px; height:28px; background:#3b7ddd; color:#fff; border-radius:50%; text-align:center; line-height:28px; font-size:13px; font-weight:700;">3</td>
                    <td style="padding-left:12px; font-size:15px; color:#4a5568;">Connect your wallet</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="padding:8px 0;">
            <table role="presentation" cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td style="width:28px; height:28px; background:#3b7ddd; color:#fff; border-radius:50%; text-align:center; line-height:28px; font-size:13px; font-weight:700;">4</td>
                    <td style="padding-left:12px; font-size:15px; color:#4a5568;">Set up your payment methods</td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<div style="text-align:center; margin:28px 0;">
    <a href="{{ url('/user/dashboard') }}" class="btn-primary">Go to Dashboard</a>
</div>
@endsection
