<p>Dear {{ $booking->user->name }},</p>

<p>We have successfully processed the refund for your booking with ID **{{ $booking->id }}**.</p>
<p>The amount of **₹{{ number_format($booking->total_amount, 2) }}** has been refunded and should reflect in your account within the next 24-48 hours.</p>

<p>Thank you for your patience.</p>
<p>Best regards,<br>LIMO</p>