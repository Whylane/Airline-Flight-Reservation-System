<?php

namespace App\Mail;

use App\Models\Booking;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReceiptMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $data;
     public $booking;
    public function __construct(Booking $booking,  array $data)
    {
        $this->booking = $booking;
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Booking Receipt',
        );
    }

    public function build()
    {
        // Generate PDF
        $pdf = $this->generatePDF();
        $pdfContent = $pdf->output();

        return $this
            ->to($this->booking->user->email)
            ->view('emails.receipt')
            ->attachData($pdfContent, 'Booking Receipt_' . $this->booking->id . '.pdf', [
                'mime' => 'application/pdf',
            ]);
    }

    private function generatePDF()
    {
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $dompdf = new Dompdf($options);
        $html = view('emails.receipt', ['ticket' => $this->booking, 'data' => $this->data])->render();

        $dompdf->loadHtml($html);
        $dompdf->setPaper('Legal', 'portrait');
        $dompdf->render();

        return $dompdf;
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.receipt',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}