<?php

namespace App\Http\Controllers;

use App\Enums\BookingStatus;
use App\Mail\VisitBookingAdmin;
use App\Mail\VisitBookingVisitor;
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
        return view('pages.campus.index', [
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
                'date' => [
                    'required',
                    'date',
                    'after:+3 days',
                    function ($attribute, $value, $fail) {
                        $date = \Carbon\Carbon::parse($value);
                        // Vérifier que c'est un mardi (2) ou jeudi (4)
                        if (!in_array($date->dayOfWeek, [2, 4])) {
                            $fail(__('Les visites ne sont possibles que les mardis et jeudis.'));
                        }
                    },
                ],
                'time' => 'required|string',
                'purpose' => 'required|string|in:partenariat,coworking,incubation,formation,evenement,presse,decouverte,other,etudiant',
                'spaces' => 'required|array|min:1',
                'spaces.*' => 'string|in:coworking,meeting,event,studio,auditorium',
                'message' => 'nullable|string|max:200',
                'confirmation' => 'required|accepted',
            ], [
                'firstname.required' => __('Le prénom est obligatoire.'),
                'lastname.required' => __('Le nom est obligatoire.'),
                'email.required' => __('L\'email est obligatoire.'),
                'email.email' => __('L\'email doit être valide.'),
                'phone.required' => __('Le téléphone est obligatoire.'),
                'date.required' => __('La date est obligatoire.'),
                'date.after' => __('La date doit être d\'au moins 3 jours à l\'avance.'),
                'time.required' => __('L\'heure est obligatoire.'),
                'purpose.required' => __('L\'objet de la visite est obligatoire.'),
                'spaces.required' => __('Veuillez sélectionner au moins un espace à visiter.'),
                'spaces.min' => __('Veuillez sélectionner au moins un espace à visiter.'),
                'confirmation.accepted' => __('Vous devez accepter les conditions de réservation.'),
            ]);

            $booking = Booking::create([
                'status' => BookingStatus::UNTREATED->value,
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

            // Envoi des emails de notification
            Mail::send(new VisitBookingAdmin($booking));
            Mail::send(new VisitBookingVisitor($booking));

            // Redirection vers la même page avec message de succès
            return redirect()->back()->with('success', __('Votre demande de visite a été enregistrée avec succès. Nous vous contacterons bientôt pour confirmer le rendez-vous.'));

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Retour au formulaire avec les erreurs de validation
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();

        } catch (\Exception $e) {
            Log::error('Erreur lors de la réservation de visite: '.$e->getMessage(), [
                'data' => $request->all(),
            ]);

            // Redirection avec message d'erreur
            return redirect()->back()
                ->with('error', __('Une erreur est survenue lors de la réservation de votre visite. Veuillez réessayer plus tard.'))
                ->withInput();
        }
    }
}
