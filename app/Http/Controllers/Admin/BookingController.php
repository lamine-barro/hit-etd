<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Enums\BookingStatus;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with('user');

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $bookings = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return view('pages.admin.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        $booking->load('user');
        return view('pages.admin.bookings.show', compact('booking'));
    }

    public function create()
    {
        return view('pages.admin.bookings.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:255',
            'facility' => 'nullable|string|max:255',
            'date' => 'required|date',
            'time' => 'nullable|string|max:255',
            'spaces' => 'nullable|array',
            'purpose' => 'nullable|string',
            'message' => 'nullable|string',
            'status' => 'required|string',
        ]);

        Booking::create($validated);

        return redirect()->route('admin.bookings.index')->with('success', 'Demande de visite créée avec succès.');
    }

    public function edit(Booking $booking)
    {
        return view('pages.admin.bookings.edit', compact('booking'));
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:255',
            'facility' => 'nullable|string|max:255',
            'date' => 'required|date',
            'time' => 'nullable|string|max:255',
            'spaces' => 'nullable|array',
            'purpose' => 'nullable|string',
            'message' => 'nullable|string',
            'status' => 'required|string',
        ]);

        $booking->update($validated);

        return redirect()->route('admin.bookings.index')->with('success', 'Demande de visite mise à jour avec succès.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('admin.bookings.index')->with('success', 'Demande de visite supprimée avec succès.');
    }

    public function approve(Booking $booking)
    {
        $booking->update(['status' => BookingStatus::CONFIRMED]);

        return redirect()->back()->with('success', 'Demande de visite approuvée avec succès.');
    }

    public function reject(Booking $booking)
    {
        $booking->update(['status' => BookingStatus::CANCELLED]);

        return redirect()->back()->with('success', 'Demande de visite refusée avec succès.');
    }
}