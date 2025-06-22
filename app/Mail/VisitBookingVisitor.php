<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VisitBookingVisitor extends Mailable
{
    use Queueable, SerializesModels;

    protected $booking;

    public function __construct($booking)
    {
        $this->booking = $booking instanceof Booking ? $booking : new Booking($booking);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmation de votre demande de visite - Hub Ivoire Tech',
            to: $this->booking->email,
            from: env('HIT_SUPPORT_EMAIL'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.visit-booking-visitor',
            with: [
                'name' => $this->booking->full_name,
                'date' => $this->booking->date->format('d/m/Y'),
                'time' => $this->booking->time,
                'spaces' => $this->booking->spaces,
                'purpose' => $this->booking->purpose,
            ]
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
