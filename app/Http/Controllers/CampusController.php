<?php

namespace App\Http\Controllers;

use App\Mail\VisitBookingAdmin;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CampusController extends Controller
{
    /**
     * Affiche la page de visite du campus
     */
    public function index()
    {
        return view('pages.visitez-le-campus', [
            'pageTitle' => __('Visitez notre Campus - Hub Ivoire Tech'),
            'metaDescription' => __("Planifiez votre visite du Hub Ivoire Tech, qui a pour vocation d'être le plus grand campus de startups en Afrique. Découvrez nos installations et réservez une visite guidée."),
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
                'message' => $validated['message'] ?? '',
            ]);

            Log::info('Nouvelle réservation de visite créée', [
                'booking_id' => $booking->id,
                'data' => $validated,
            ]);

            Mail::queue('default')->send(new VisitBookingAdmin($booking));

            return response()->json([
                'status' => 'success',
                'message' => __('Votre demande de visite a été enregistrée avec succès. Nous vous contacterons bientôt pour confirmer le rendez-vous.'),
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur lors de la réservation de visite: '.$e->getMessage(), [
                'data' => $request->all(),
            ]);

            return response()->json([
                'status' => 'error',
                'message' => __('Une erreur est survenue lors de la réservation de votre visite. Veuillez réessayer plus tard.'),
            ], 500);
        }
    }
}
