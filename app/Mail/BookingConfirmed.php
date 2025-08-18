<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Booking; 

class BookingConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public $booking; 

    public function __construct(Booking $booking) 
    {
        $this->booking = $booking; 
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Booking #' . $this->booking->id . ' Has Been Confirmed!', 
        );
    }

    
    public function content(): Content
    {
        return new Content(
            markdown: 'users.confirmed',
            with: [
                'booking' => $this->booking,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}