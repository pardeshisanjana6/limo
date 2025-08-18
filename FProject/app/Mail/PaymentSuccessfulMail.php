<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Booking;

class PaymentSuccessfulMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $isRefund;

    public function __construct(Booking $booking ,$isRefund = false)
    {
        $this->booking = $booking;
        $this->isRefund = $isRefund;
    }

    public function envelope(): Envelope
    {
        $subject = $this->isRefund ? 'Refund Processed for Booking ' : 'Your Payment for Booking ';
        return new Envelope(
            subject: $subject . $this->booking->id,
        );
    }

    public function content(): Content
    {
        $view = $this->isRefund ? 'admin.refund' : 'users.paymentsuccess';
        return new Content(
            view: $view,
        );
    }
}