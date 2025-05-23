<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

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

        // Ne montrer que les événements à venir
        $query->where('start_date', '>=', now());

        // Trier par date de début croissante
        $query->orderBy('start_date', 'desc');
        $query->orderBy('created_at', 'desc');

        $events = $query->paginate(9)->withQueryString();

        return view('pages.events-list', compact('events'));
    }

    /**
     * Display the specified event.
     */
    public function show($slug)
    {
        // Recherche par slug dans les traductions
        $event = Event::whereHas('translations', function($query) use ($slug) {
            $query->where('slug', $slug);
        })->first();

        // Vérifier si l'événement existe et est publié
        if (!$event || $event->status !== 'published') {
            abort(404);
        }

        $event->loadCount('registrations');

        return view('pages.event-detail', compact('event'));
    }
}
