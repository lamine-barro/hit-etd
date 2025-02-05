<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Audience;
use App\Models\Booking;
use App\Models\Event;
use App\Models\EventRegistration;
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

    public function bookings()
    {
        $bookings = Booking::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('dashboard.bookings.index', compact('bookings'));
    }
}
