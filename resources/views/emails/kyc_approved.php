<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
    xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <title>KYC Approved - ArtistToCollectors</title>
    <style>
        body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
        table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
        img { -ms-interpolation-mode: bicubic; border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
        body { margin: 0 !important; padding: 0 !important; width: 100% !important; background-color: #f4f6f9; }
        * { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; }
        h1 { font-size: 24px; font-weight: 700; color: #1a1a2e; margin: 0 0 8px 0; }
        p { font-size: 15px; line-height: 24px; color: #4a5568; margin: 0 0 16px 0; }
        .btn-primary { display: inline-block; background: linear-gradient(135deg, #3b7ddd 0%, #5a9cf5 100%); color: #ffffff !important; font-size: 15px; font-weight: 600; text-decoration: none; padding: 12px 32px; border-radius: 8px; }
        .info-card { background: #f8fafc; border-left: 4px solid #3b7ddd; border-radius: 0 8px 8px 0; padding: 16px 20px; margin: 20px 0; }
        .info-card p { margin: 4px 0; font-size: 14px; }
        .info-card .label { color: #6b7280; font-weight: 400; }
        .info-card .value { color: #1a1a2e; font-weight: 600; }
        @media only screen and (max-width: 600px) {
            .email-container { width: 100% !important; padding: 12px !important; }
            .email-body { padding: 24px 20px !important; }
            h1 { font-size: 20px !important; }
        }
    </style>
</head>

<body style="margin:0; padding:0; background-color:#f4f6f9;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f4f6f9;">
        <tr>
            <td align="center" style="padding: 32px 16px;">
                <table role="presentation" class="email-container" width="580" cellpadding="0" cellspacing="0" border="0" style="max-width:580px; width:100%;">
                    <tr>
                        <td align="center" style="padding: 0 0 24px 0;">
                            <img src="<?php echo url('/images/logo.png'); ?>" alt="ArtistToCollectors" width="240" style="display:block; width:240px; max-width:100%; height:auto;" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#ffffff; border-radius:16px; box-shadow: 0 2px 8px rgba(0,0,0,0.06), 0 8px 24px rgba(0,0,0,0.04); overflow:hidden;">
                                <tr>
                                    <td style="height:4px; background: linear-gradient(90deg, #3b7ddd, #5a9cf5);"></td>
                                </tr>
                                <tr>
                                    <td class="email-body" style="padding: 40px 36px;">
                                        <h1>KYC Verification Approved</h1>
                                        <p>Dear <?php echo htmlspecialchars($user['full_name']); ?>,</p>
                                        <p>Congratulations! Your identity verification has been approved. You now have full access to all platform features.</p>

                                        <h2 style="font-size:20px; font-weight:600; color:#1a1a2e; margin:24px 0 8px 0;">Next Steps</h2>
                                        <table role="presentation" cellpadding="0" cellspacing="0" border="0" style="width:100%;">
                                            <tr><td style="padding:8px 0;"><table role="presentation" cellpadding="0" cellspacing="0" border="0"><tr><td style="width:28px; height:28px; background:#3b7ddd; color:#fff; border-radius:50%; text-align:center; line-height:28px; font-size:13px; font-weight:700;">1</td><td style="padding-left:12px; font-size:15px; color:#4a5568;">Upload your artwork to the marketplace</td></tr></table></td></tr>
                                            <tr><td style="padding:8px 0;"><table role="presentation" cellpadding="0" cellspacing="0" border="0"><tr><td style="width:28px; height:28px; background:#3b7ddd; color:#fff; border-radius:50%; text-align:center; line-height:28px; font-size:13px; font-weight:700;">2</td><td style="padding-left:12px; font-size:15px; color:#4a5568;">Complete your artist profile</td></tr></table></td></tr>
                                            <tr><td style="padding:8px 0;"><table role="presentation" cellpadding="0" cellspacing="0" border="0"><tr><td style="width:28px; height:28px; background:#3b7ddd; color:#fff; border-radius:50%; text-align:center; line-height:28px; font-size:13px; font-weight:700;">3</td><td style="padding-left:12px; font-size:15px; color:#4a5568;">Connect your wallet</td></tr></table></td></tr>
                                            <tr><td style="padding:8px 0;"><table role="presentation" cellpadding="0" cellspacing="0" border="0"><tr><td style="width:28px; height:28px; background:#3b7ddd; color:#fff; border-radius:50%; text-align:center; line-height:28px; font-size:13px; font-weight:700;">4</td><td style="padding-left:12px; font-size:15px; color:#4a5568;">Set up your payment methods</td></tr></table></td></tr>
                                        </table>

                                        <div style="text-align:center; margin:28px 0;">
                                            <a href="<?php echo url('/user/dashboard'); ?>" class="btn-primary" style="display:inline-block; background:linear-gradient(135deg, #3b7ddd 0%, #5a9cf5 100%); color:#ffffff; font-size:15px; font-weight:600; text-decoration:none; padding:12px 32px; border-radius:8px;">Go to Dashboard</a>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 28px 16px; text-align: center;">
                            <p style="font-size: 13px; color: #9ca3af; margin: 0 0 6px 0;">&copy; <?php echo date('Y'); ?> ArtistToCollectors. All rights reserved.</p>
                            <p style="font-size: 12px; color: #9ca3af; margin: 0;">
                                This email was sent to you because you have an account with us.<br>
                                <a href="<?php echo url('/'); ?>" style="color: #3b7ddd; text-decoration: none;">Visit our website</a>
                                &nbsp;&middot;&nbsp;
                                <a href="mailto:support@artisttocollectors.com" style="color: #3b7ddd; text-decoration: none;">Contact Support</a>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>