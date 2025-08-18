<!DOCTYPE html>
<html>
<head>
    <title>Payment Successful</title>
</head>
<body>
    <h1>Payment Successful for Booking {{ $booking->id }}</h1>
    <p>Hello {{ $booking->user->name }},</p>
    <p>Your payment for booking ID {{ $booking->id }} has been successfully processed.</p>

    <h3>Booking Details:</h3>
    <ul>
        <li><strong>Booking ID:</strong> {{ $booking->id }}</li>
        <li><strong>Vehicle:</strong> {{ $booking->vehicle->vehicle_title ?? 'N/A' }}</li>
        <li><strong>Total Amount:</strong> ₹{{ number_format($booking->total_amount, 2) }}</li>
        <li><strong>Payment Status:</strong> Paid</li>
    </ul>

    <p>Thank you for choosing our service!</p>
    <p>Best regards,<br>Limo Car Rental</p>
</body>
</html>