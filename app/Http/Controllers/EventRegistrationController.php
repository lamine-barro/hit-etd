<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EventRegistrationController extends Controller
{
    public function store(Request $request, Event $event)
    {
        try {
            // Validate request
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'whatsapp' => 'nullable|string|max:255',
            ]);

            // Check if EventRegistration is open
            if (! $event->isEventRegistrationOpen()) {
                return back()->with('error', __('Les inscriptions sont fermées pour cet événement.'));
            }

            // Check if user is already registered
            if ($event->EventRegistrations()->where('email', $validatedData['email'])->exists()) {
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
            $eventRegistration->status = 'pending';
            $eventRegistration->save();

            // Handle payment if required
            if ($event->getCurrentPrice() > 0) {
                return redirect()->route('payment.show', ['registration' => $eventRegistration->id])
                    ->with('success', __('Votre inscription a été prise en compte. Veuillez procéder au paiement.'));
            }

            // For free events, confirm registration immediately
            $eventRegistration->status = 'confirmed';
            $eventRegistration->save();

            return back()->with('success', __('Votre inscription a été confirmée avec succès.'));

        } catch (\Exception $e) {
            Log::error('EventRegistration error: '.$e->getMessage());

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
