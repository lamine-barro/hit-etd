<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CampusController extends Controller
{
    /**
     * Affiche la page de visite du campus
     */
    public function index()
    {
        return view('pages.visitez-le-campus', [
            'pageTitle' => 'Visitez le Campus - Hub Ivoire Tech',
            'metaDescription' => 'Planifiez votre visite du Hub Ivoire Tech, le plus grand campus de startups en Afrique. Découvrez nos installations et réservez une visite guidée.',
        ]);
    }

    public function bookVisit(Request $request)
    {
        try {
            $validated = $request->validate([
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:255',
                'date' => 'required|date|after:today',
                'time' => 'required|string',
                'purpose' => 'required|string|in:coworking,incubation,formation,evenement',
                'spaces' => 'required|array',
                'spaces.*' => 'string|in:coworking,meeting,event,studio,auditorium',
                'message' => 'required|string|max:1000',
            ]);

            $booking = Booking::create([
                'firstname' => $validated['firstname'],
                'lastname' => $validated['lastname'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'date' => $validated['date'],
                'time' => $validated['time'],
                'purpose' => $validated['purpose'],
                'spaces' => $validated['spaces'],
                'message' => $validated['message'],
            ]);

            Log::info('Nouvelle réservation de visite créée', [
                'booking_id' => $booking->id,
                'data' => $validated,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Votre demande de visite a été enregistrée avec succès. Nous vous contacterons bientôt pour confirmer le rendez-vous.',
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur lors de la réservation de visite: '.$e->getMessage(), [
                'data' => $request->all(),
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Une erreur est survenue lors de votre demande. Veuillez réessayer plus tard.',
            ], 422);
        }
    }
}
