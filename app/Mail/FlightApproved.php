<?php

namespace App\Mail;

use App\Models\Booking;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FlightApproved extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $ticket;
    public $additionalData;
    public function __construct(Booking $ticket,  array $additionalData)
    {
        $this->ticket = $ticket;
        $this->additionalData = $additionalData;
    }

    public function build()
    {
        // Generate PDF
        $pdf = $this->generatePDF();
        $pdfContent = $pdf->output();

        return $this
            ->to($this->ticket->user->email)
            ->subject('Flight Approved')
            ->view('emails.reservation.approved')
            ->attachData($pdfContent, 'approval_' . $this->ticket->id . '.pdf', [
                'mime' => 'application/pdf',
            ]);
    }

    /**
     * Generate PDF for the ticket.
     */
    private function generatePDF()
    {
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $dompdf = new Dompdf($options);
        $html = view('pdf.approval', ['ticket' => $this->ticket, 'additionalData' => $this->additionalData])->render();

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf;
    }
}