<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Mail\Mailables\Attachment;

class PDFMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;  // publikinis, kad būtų prieinamas view

    public function __construct($contact)
    {
        $this->contact = $contact;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Jūsų PDF Dokumentas',
        );
    }

    public function content(): Content
    {
        return new Content(
            // perduodam kontaktą į view
            view: 'emails.pdfmail',
            with: ['contact' => $this->contact],
        );
    }

    public function attachments(): array
    {
        $data = [
            'title' => 'Kontaktas: ' . $this->contact->name,
            'date' => date('Y-m-d'),
            'content' => 'El. paštas: ' . $this->contact->email . ', Telefonas: ' . $this->contact->phone,
        ];

        $pdf = Pdf::loadView('pdf.document', $data);

        return [
            Attachment::fromData(fn() => $pdf->output(), 'kontaktas.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
