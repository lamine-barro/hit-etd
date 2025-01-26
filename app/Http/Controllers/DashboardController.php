<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\Booking;
use App\Models\Audience;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_events' => Event::count(),
            'upcoming_events' => Event::where('start_date', '>', now())->count(),
            'total_registrations' => EventRegistration::count(),
            'total_articles' => Article::count(),
            'published_articles' => Article::where('status', 'published')->count(),
            'total_bookings' => Booking::count(),
            'total_audiences' => Audience::count(),
            'total_subscribers' => Audience::count(),
            'email_subscribers' => Audience::where('newsletter_email', true)->count(),
            'whatsapp_subscribers' => Audience::where('newsletter_whatsapp', true)->count(),
        ];

        return view('dashboard.index', compact('stats'));
    }

    public function events()
    {
        $events = Event::with('registrations')
            ->orderBy('start_date', 'desc')
            ->paginate(10);
        
        return view('dashboard.events.index', compact('events'));
    }

    public function articles()
    {
        $articles = Article::orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('dashboard.articles.index', compact('articles'));
    }

    public function bookings()
    {
        $bookings = Booking::orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('dashboard.bookings.index', compact('bookings'));
    }

    public function audiences()
    {
        $audiences = Audience::orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('dashboard.audiences.index', compact('audiences'));
    }

    public function config()
    {
        return view('dashboard.config.index');
    }

    public function updateConfig(Request $request)
    {
        // Validation et mise à jour des configurations
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'contact_email' => 'required|email',
            // Ajoutez d'autres champs selon vos besoins
        ]);

        // Mise à jour des configurations
        foreach ($validated as $key => $value) {
            config(['site.' . $key => $value]);
        }

        return back()->with('success', 'Configuration mise à jour avec succès.');
    }

    // Méthodes pour les événements
    public function createEvent()
    {
        return view('dashboard.events.create');
    }

    public function storeEvent(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:masterclass,webinaire,atelier,conference,hackathon,pitch,afterwork,autre',
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'location' => 'required|string|max:255',
            'is_remote' => 'required|boolean',
            'description' => 'required|string',
            'illustration' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'external_link' => 'nullable|url',
            'max_participants' => 'required|integer|min:0',
            'registration_end_date' => 'nullable|date|before:start_date',
            'status' => 'required|in:draft,published,cancelled',
            'is_paid' => 'boolean',
            'price' => 'required_if:is_paid,1|nullable|numeric|min:0',
            'currency' => 'required_if:is_paid,1|nullable|string|size:3',
            'early_bird_price' => 'nullable|numeric|min:0|lt:price',
            'early_bird_end_date' => 'nullable|date|before:start_date',
        ]);

        // Gérer l'upload de l'image
        if ($request->hasFile('illustration')) {
            $path = $request->file('illustration')->store('events', 'public');
            $validated['illustration'] = $path;
        }

        // Créer l'événement
        $event = Event::create($validated);

        return redirect()
            ->route('dashboard.events')
            ->with('success', 'Événement créé avec succès.');
    }

    public function editEvent(Event $event)
    {
        return view('dashboard.events.edit', compact('event'));
    }

    public function updateEvent(Request $request, Event $event)
    {
        // Logique de mise à jour d'événement
    }

    public function destroyEvent(Event $event)
    {
        $event->delete();
        return back()->with('success', 'Événement supprimé avec succès.');
    }

    // Méthodes pour les articles
    public function createArticle()
    {
        return view('dashboard.articles.create');
    }

    public function storeArticle(Request $request)
    {
        // Logique de création d'article
    }

    public function editArticle(Article $article)
    {
        return view('dashboard.articles.edit', compact('article'));
    }

    public function updateArticle(Request $request, Article $article)
    {
        // Logique de mise à jour d'article
    }

    public function destroyArticle(Article $article)
    {
        $article->delete();
        return back()->with('success', 'Article supprimé avec succès.');
    }

    // Méthodes pour les réservations et audiences
    public function destroyBooking(Booking $booking)
    {
        $booking->delete();
        return back()->with('success', 'Réservation supprimée avec succès.');
    }

    public function destroyAudience(Audience $audience)
    {
        $audience->delete();
        return back()->with('success', 'Audience supprimée avec succès.');
    }
}
