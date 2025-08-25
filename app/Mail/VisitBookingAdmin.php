<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class VisitBookingAdmin extends Mailable
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
            subject: __('Nouvelle demande de visite - Hub Ivoire Tech'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.visit-booking-admin',
            with: [
                'name' => $this->booking->full_name,
                'email' => $this->booking->email,
                'phone' => $this->booking->phone,
                'date' => Carbon::parse($this->booking->date)->format('d/m/Y'),
                'time' => $this->booking->time,
                'spaces' => $this->booking->spaces,
                'purpose' => $this->booking->purpose,
                'visitor_message' => $this->booking->message,
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
