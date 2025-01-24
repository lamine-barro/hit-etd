<?php

namespace App\Http\Controllers;

use App\Mail\VisitBookingAdmin;
use App\Mail\VisitBookingVisitor;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CampusController extends Controller
{
    public function bookVisit(Request $request)
    {
        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'date' => 'required|date|after:today',
            'time' => 'required|in:09:00,10:00,11:00,14:00,15:00,16:00',
            'purpose' => 'required|string',
            'spaces' => 'required|array|min:1',
            'message' => 'nullable|string|max:1000',
        ], [
            'firstname.required' => 'Le prénom est requis',
            'lastname.required' => 'Le nom est requis',
            'email.required' => 'L\'email est requis',
            'email.email' => 'L\'email n\'est pas valide',
            'phone.required' => 'Le numéro de téléphone est requis',
            'date.required' => 'La date est requise',
            'date.after' => 'La date doit être ultérieure à aujourd\'hui',
            'time.required' => 'L\'heure est requise',
            'time.in' => 'L\'heure sélectionnée n\'est pas valide',
            'purpose.required' => 'L\'objet de la visite est requis',
            'spaces.required' => 'Veuillez sélectionner au moins un espace à visiter',
            'spaces.min' => 'Veuillez sélectionner au moins un espace à visiter',
        ]);

        try {
            DB::beginTransaction();

            // Créer la réservation
            $booking = Booking::create($validated);

            // Envoyer les emails
            Mail::to('hello@hubivoiretech.ci')->queue(new VisitBookingAdmin($booking));
            Mail::to($booking->email)->queue(new VisitBookingVisitor($booking));

            DB::commit();

            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Votre demande de visite a été envoyée avec succès. Vous recevrez bientôt un email de confirmation.',
                    'redirect' => route('home')
                ]);
            }

            return redirect()->route('home')
                           ->with('success', 'Votre demande de visite a été envoyée avec succès. Vous recevrez bientôt un email de confirmation.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de la réservation de visite: ' . $e->getMessage());

            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Une erreur est survenue lors de l\'envoi de votre demande. Veuillez réessayer plus tard.'
                ], 500);
            }

            return back()->withInput()
                        ->with('error', 'Une erreur est survenue lors de l\'envoi de votre demande. Veuillez réessayer plus tard.');
        }
    }
} 