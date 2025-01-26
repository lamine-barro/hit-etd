<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('dashboard.bookings.index', compact('bookings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'purpose' => 'required|string|max:255',
            'spaces' => 'required|array',
            'message' => 'nullable|string'
        ]);

        $booking = Booking::create($validated);

        return back()->with('notification', [
            'type' => 'success',
            'message' => 'Votre demande de réservation a été enregistrée.'
        ]);
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $booking->update($validated);

        return back()->with('notification', [
            'type' => 'success',
            'message' => 'Statut de la réservation mis à jour.'
        ]);
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        return back()->with('notification', [
            'type' => 'success',
            'message' => 'Réservation supprimée avec succès.'
        ]);
    }
}