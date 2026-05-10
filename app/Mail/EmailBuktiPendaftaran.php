<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailBuktiPendaftaran extends Mailable
{
    use Queueable, SerializesModels;

    public $pdfContent;
    public $fileName;
    /**
     * Create a new message instance.
     */
    public function __construct($pdfContent, $fileName)
    {
        $this->pdfContent = $pdfContent;
        $this->fileName = $fileName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Email Bukti Pendaftaran',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.kirim-email',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            // Gunakan fromData untuk mengirim file dari memori (bukan dari storage)
            Attachment::fromData(fn() => $this->pdfContent, $this->fileName)
                ->withMime('application/pdf'),
        ];
    }
}
