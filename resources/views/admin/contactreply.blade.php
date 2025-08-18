<!DOCTYPE html>
<html>
<head>
    <title>Reply to Your Inquiry</title>
</head>
<body>
    <p>Dear {{ $replyDetails['original_name'] }},</p>
    <p>Thank you for reaching out to us. We have received your message and are providing a reply below.</p>

    <div style="border: 1px solid #ccc; padding: 15px; margin-top: 20px;">
        <p><strong>Your Original Message:</strong></p>
        <p><em>{{ $replyDetails['original_message'] }}</em></p>
    </div>

    <div style="border-left: 3px solid #007bff; padding: 15px; margin-top: 20px;">
        <p><strong>Our Reply:</strong></p>
        <p>{{ $replyDetails['reply_message'] }}</p>
    </div>

    <p>Sincerely,</p>
    <p>The Admin Team</p>
</body>
</html>