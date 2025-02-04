<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VisitBookingVisitor extends Mailable
{
    use Queueable, SerializesModels;

    protected $booking;

    public function __construct($booking)
    {
        $this->booking = $booking instanceof Booking ? $booking : new Booking($booking);
    }

    public function build()
    {
        return $this->subject('Confirmation de votre demande de visite - Hub Ivoire Tech')
            ->markdown('emails.visit-booking-visitor')
            ->with([
                'name' => $this->booking->full_name,
                'date' => $this->booking->date->format('d/m/Y'),
                'time' => $this->booking->time->format('H:i'),
                'spaces' => $this->booking->spaces,
                'purpose' => $this->booking->purpose,
            ]);
    }
}
