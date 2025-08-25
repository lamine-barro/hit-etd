<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Enums\EventStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Liste des événements (disponibles et inscrits)
     */
    public function index()
    {
        $user = Auth::user();

        // Événements auxquels l'utilisateur est inscrit
        $myEvents = EventRegistration::with('event')
            ->where('user_id', $user->id)
            ->whereHas('event', function($q) {
                $q->where('status', EventStatus::PUBLISHED);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        // Événements disponibles pour inscription
        $availableEvents = Event::where('status', EventStatus::PUBLISHED)
            ->where('start_date', '>', now())
            ->whereDoesntHave('registrations', function($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->orderBy('start_date')
            ->get();

        // Événements passés auxquels l'utilisateur était inscrit
        $pastEvents = EventRegistration::with('event')
            ->where('user_id', $user->id)
            ->whereHas('event', function($q) {
                $q->where('status', EventStatus::PUBLISHED)
                  ->where('start_date', '<', now());
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.resident.events.index', compact('myEvents', 'availableEvents', 'pastEvents'));
    }

    /**
     * Affichage des détails d'un événement
     */
    public function show(Event $event)
    {
        if ($event->status !== EventStatus::PUBLISHED) {
            abort(404);
        }

        $user = Auth::user();
        $isRegistered = $event->registrations()->where('user_id', $user->id)->exists();
        $registration = null;

        if ($isRegistered) {
            $registration = $event->registrations()->where('user_id', $user->id)->first();
        }

        return view('pages.resident.events.show', compact('event', 'isRegistered', 'registration'));
    }

    /**
     * Inscription à un événement
     */
    public function register(Request $request, Event $event)
    {
        if ($event->status !== EventStatus::PUBLISHED) {
            abort(404);
        }

        $user = Auth::user();

        // Vérifier si déjà inscrit
        if ($event->registrations()->where('user_id', $user->id)->exists()) {
            return redirect()->back()->with('toast', [
                'type' => 'error',
                'message' => 'Vous êtes déjà inscrit à cet événement.'
            ]);
        }

        // Vérifier si l'événement n'est pas passé
        if ($event->start_date < now()) {
            return redirect()->back()->with('toast', [
                'type' => 'error',
                'message' => 'Impossible de s\'inscrire à un événement passé.'
            ]);
        }

        // Vérifier la capacité si définie
        if ($event->max_participants && $event->registrations()->count() >= $event->max_participants) {
            return redirect()->back()->with('toast', [
                'type' => 'error',
                'message' => 'Cet événement a atteint sa capacité maximale.'
            ]);
        }

        // Créer l'inscription
        EventRegistration::create([
            'event_id' => $event->id,
            'user_id' => $user->id,
            'status' => 'confirmed',
            'registered_at' => now(),
        ]);

        return redirect()->route('resident.events.show', $event)->with('toast', [
            'type' => 'success',
            'message' => 'Inscription confirmée ! Vous recevrez plus d\'informations par email.'
        ]);
    }

    /**
     * Annulation d'une inscription
     */
    public function cancelRegistration(EventRegistration $registration)
    {
        // Vérifier que l'inscription appartient au résident connecté
        if ($registration->user_id !== Auth::id()) {
            abort(403);
        }

        $event = $registration->event;

        // Vérifier si l'événement n'est pas passé
        if ($event->start_date < now()) {
            return redirect()->back()->with('toast', [
                'type' => 'error',
                'message' => 'Impossible d\'annuler l\'inscription à un événement passé.'
            ]);
        }

        // Vérifier la politique d'annulation (ex: pas d'annulation 24h avant l'événement)
        if ($event->start_date->subHours(24) < now()) {
            return redirect()->back()->with('toast', [
                'type' => 'error',
                'message' => 'Impossible d\'annuler moins de 24h avant l\'événement.'
            ]);
        }

        $registration->delete();

        return redirect()->route('resident.events.index')->with('toast', [
            'type' => 'success',
            'message' => 'Votre inscription a été annulée.'
        ]);
    }
}