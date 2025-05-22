<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;

    public function __construct($contact)
    {
        $this->contact = $contact;
    }
    
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Contact Created Mail',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact_created',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
