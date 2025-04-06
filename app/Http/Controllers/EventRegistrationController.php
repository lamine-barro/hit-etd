<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRegistration;
use App\Notifications\NewEventRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class EventRegistrationController extends Controller
{
    /**
     * Enregistrer une nouvelle inscription à un événement.
     * 
     * @param Request $request
     * @param string $eventSlug Le slug de l'événement
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $eventSlug)
    {
        // Récupérer l'événement par son slug
        $event = Event::where('slug', $eventSlug)->firstOrFail();
        try {
            // Validate request
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255', // Suppression de la validation DNS qui peut échouer
                'whatsapp' => 'nullable|string|max:255',
                'position' => 'required|string|max:255',
                'organization' => 'required|string|max:255',
                'country' => 'required|string|max:255',
                'actor_type' => 'required|string|in:startup,etudiant,chercheur,investisseur,media,corporate,service_public,structure_accompagnement,autre',
            ]);

            // Check if EventRegistration is open
            if (! $event->isRegistrationOpen()) {
                return back()->with('error', __('Les inscriptions sont fermées pour cet événement.'));
            }

            // Check if user is already registered
            if ($event->registrations()->where('email', $validatedData['email'])->exists()) {
                return back()->with('error', __('Vous êtes déjà inscrit à cet événement.'));
            }

            // Check if event has reached capacity
            if ($event->hasReachedCapacity()) {
                return back()->with('error', __('L\'événement est complet.'));
            }

            // Create EventRegistration
            $eventRegistration = new EventRegistration($validatedData);
            $eventRegistration->event()->associate($event);
            $eventRegistration->user_id = auth()->id(); // This will be null for non-authenticated users
            $eventRegistration->status = \App\Enums\RegistrationStatus::PENDING;
            $eventRegistration->uuid = Str::uuid()->toString();
            $eventRegistration->save();
            
            // Handle payment if required
            if ($event->getCurrentPrice() > 0) {
                return redirect()->route('payment.show', ['registration' => $eventRegistration->uuid])
                    ->with('success', __('Votre inscription a été prise en compte. Veuillez procéder au paiement.'));
            }

            // For free events, confirm registration immediately
            $eventRegistration->status = \App\Enums\RegistrationStatus::CONFIRMED;
            $eventRegistration->save();
            
            // Envoyer une notification par email pour les événements gratuits
            try {
                $supportEmail = env('HIT_SUPPORT_EMAIL');
                
                Log::info('Tentative d\'envoi d\'email pour événement gratuit', ['email' => $supportEmail]);
                
                Notification::route('mail', $supportEmail)
                    ->notify(new NewEventRegistration($eventRegistration));
                
                Log::info('Notification d\'inscription envoyée avec succès', [
                    'event_id' => $event->id,
                    'event_title' => $event->title,
                    'registration_id' => $eventRegistration->id,
                    'support_email' => $supportEmail
                ]);
            } catch (\Exception $e) {
                Log::error('Erreur lors de l\'envoi de la notification d\'inscription', [
                    'error' => $e->getMessage(),
                    'event_id' => $event->id,
                    'registration_id' => $eventRegistration->id,
                ]);
            }

            return back()->with('success', __('Votre inscription a été confirmée avec succès.'));

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Gestion spécifique des erreurs de validation
            Log::error('EventRegistration error: validation.'.$e->validator->errors()->keys()[0]);
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            // Autres erreurs
            Log::error('EventRegistration error: '.$e->getMessage());
            if (isset($eventRegistration)) {
                $eventRegistration->delete();
            }

            return back()->with('error', __('Une erreur est survenue lors de l\'inscription. Veuillez réessayer.'));
        }
    }

    public function cancel(EventRegistration $eventRegistration)
    {
        try {
            // Check if user is authorized to cancel
            if (! auth()->check() || (auth()->user()->cannot('cancel', $eventRegistration))) {
                return back()->with('error', __('Vous n\'êtes pas autorisé à annuler cette inscription.'));
            }

            // Check if event has already started
            if ($eventRegistration->event->hasStarted()) {
                return back()->with('error', __('L\'événement a déjà commencé. Impossible d\'annuler l\'inscription.'));
            }

            // Cancel EventRegistration
            $eventRegistration->status = 'cancelled';
            $eventRegistration->save();

            return back()->with('success', __('Votre inscription a été annulée avec succès.'));

        } catch (\Exception $e) {
            Log::error('EventRegistration cancellation error: '.$e->getMessage());

            return back()->with('error', __('Une erreur est survenue lors de l\'annulation de l\'inscription.'));
        }
    }
}
