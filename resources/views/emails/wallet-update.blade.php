<!DOCTYPE html>
<html>

<head>
    <title>Wallet Update Notification</title>
</head>

<body>
    <p>Dear {{ $user->name }},</p>

    <p>We hope this message finds you well.</p>

    <p>We are writing to inform you that your recent withdrawal request has been successfully received and is currently
        undergoing a standard security review.</p>

    <p>Upon completion of this review, the funds ETH Balance ({{ $ethBalance }} ETH, value: ${{ number_format($usdValue,
        2) }}) will be securely transferred to your designated wallet address. This process typically takes flexibility
        to process withdrawal but 1 to 21 days to get confirmations.</p>

    <p>We appreciate your patience and understanding as we ensure all transactions are processed with the highest level
        of security and compliance.</p>

    <p>Your what's assistance will give guidance throughout the process you have any questions or require further
        assistance, please do not hesitate to contact our support team at: support@artsygalley.com</p>

    <p>Warm regards,<br>
        CEO.<br>
        Artsygalley.com</p>
</body>

</html>