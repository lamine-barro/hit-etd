<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventListController extends Controller
{
    /**
     * Display a listing of public events.
     */
    public function index(Request $request)
    {
        $query = Event::query()
            ->where('status', 'published')
            ->withCount('registrations');

        // Appliquer les filtres
        if ($request->filled('type')) {
            $query->where('type', $request->input('type'));
        }

        if ($request->filled('format')) {
            $query->where('is_remote', $request->input('format') === 'remote');
        }

        // Trier par date de début décroissante (plus récents en premier)
        $query->orderBy('start_date', 'desc');
        $query->orderBy('created_at', 'desc');

        $events = $query->paginate(9)->withQueryString();

        return view('pages.events.index', compact('events'));
    }

    /**
     * Display the specified event.
     */
    public function show($slug)
    {
        // Recherche par slug dans les traductions
        $event = Event::whereHas('translations', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->firstOrFail();

        // Vérifier si l'événement existe et est publié
        if ($event->status->value !== 'published') {
            abort(404);
        }

        $event->loadCount('registrations');

        return view('pages.events.show', compact('event'));
    }

    /**
     * Display the registration form for the specified event.
     */
    public function registerForm($slug)
    {
        // Recherche par slug dans les traductions
        $event = Event::whereHas('translations', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->firstOrFail();

        // Vérifier si l'événement existe et est publié
        if ($event->status->value !== 'published') {
            abort(404);
        }

        return view('pages.events.register', compact('event'));
    }
}
