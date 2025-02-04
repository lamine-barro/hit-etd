<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::query()->latest()->get();

        return view('pages.resident-booking', compact('bookings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'facility' => 'required|string|in:salle_reunion,salle_conference,espace_coworking',
            'date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'purpose' => 'required|string|max:500',
        ]);

        // Vérifier si l'installation est disponible
        $conflictingBooking = Booking::where('facility', $validated['facility'])
            ->where('date', $validated['date'])
            ->where(function ($query) use ($validated) {
                $query->whereBetween('start_time', [$validated['start_time'], $validated['end_time']])
                    ->orWhereBetween('end_time', [$validated['start_time'], $validated['end_time']]);
            })
            ->exists();

        if ($conflictingBooking) {
            return back()
                ->withInput()
                ->withErrors(['conflict' => __('Cette installation est déjà réservée pour ce créneau horaire.')]);
        }

        $booking = Booking::create([
            'facility' => $validated['facility'],
            'date' => $validated['date'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'purpose' => $validated['purpose'],
            'status' => 'confirmed',
        ]);

        return redirect()->route('resident.bookings.index')
            ->with('success', __('Votre réservation a été confirmée.'));
    }

    public function destroy(Booking $booking)
    {
        // Vérifier si l'utilisateur est autorisé à annuler cette réservation
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $booking->delete();

        return redirect()->route('resident.bookings.index')
            ->with('success', __('La réservation a été annulée.'));
    }
}
