<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $replyDetails;

    public function __construct($replyDetails)
    {
        $this->replyDetails = $replyDetails;
    }

    public function build()
    {
        return $this->subject('Re: ' . $this->replyDetails['original_subject'])
                    ->view('admin.contactreply');
    }

}
