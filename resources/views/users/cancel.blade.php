<p>Dear {{ $booking->user->name ?? 'User' }},</p>

<p>We regret to inform you that your booking with ID **{{ $booking->id }}** has been cancelled.</p>

<p>If you have any questions, please contact our support team.</p>

<p>Thank you,<br>Limo CarRental Services</p>