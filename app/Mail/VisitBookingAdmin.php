<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VisitBookingAdmin extends Mailable
{
    use Queueable, SerializesModels;

    protected $booking;

    public function __construct($booking)
    {
        $this->booking = $booking instanceof Booking ? $booking : new Booking($booking);
    }

    public function build()
    {
        return $this->subject(__('Nouvelle demande de visite - Hub Ivoire Tech'))
            ->markdown('emails.visit-booking-admin')
            ->with([
                'name' => $this->booking->full_name,
                'email' => $this->booking->email,
                'phone' => $this->booking->phone,
                'date' => $this->booking->date->format('d/m/Y'),
                'time' => $this->booking->time->format('H:i'),
                'spaces' => $this->booking->spaces,
                'purpose' => $this->booking->purpose,
                'message' => $this->booking->message,
            ]);
    }
}
