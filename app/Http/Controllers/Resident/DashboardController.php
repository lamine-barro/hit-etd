<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;
use App\Models\EspaceOrder;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Affichage du dashboard résident
     */
    public function index()
    {
        $user = Auth::user();
        
        // Statistiques rapides
        $stats = [
            'orders_count' => EspaceOrder::where('user_id', $user->id)->count(),
            'active_orders' => EspaceOrder::where('user_id', $user->id)->where('status', 'confirmed')->count(),
            'events_registered' => EventRegistration::where('user_id', $user->id)->count(),
            'upcoming_events' => EventRegistration::where('user_id', $user->id)
                ->whereHas('event', function($q) {
                    $q->where('start_date', '>', now());
                })
                ->count(),
        ];
        
        // Dernières réservations d'espaces
        $recentOrders = EspaceOrder::with(['orderItems.espace'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
            
        // Événements à venir
        $upcomingEvents = EventRegistration::with('event')
            ->where('user_id', $user->id)
            ->whereHas('event', function($q) {
                $q->where('start_date', '>', now());
            })
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
            
        // Événements disponibles pour inscription
        $availableEvents = Event::where('status', 'published')
            ->where('start_date', '>', now())
            ->whereDoesntHave('registrations', function($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->orderBy('start_date')
            ->limit(3)
            ->get();

        return view('pages.resident.dashboard', compact(
            'stats', 
            'recentOrders', 
            'upcomingEvents', 
            'availableEvents'
        ));
    }

    /**
     * Affichage du profil résident
     */
    public function profile()
    {
        $user = Auth::user();
        return view('pages.resident.profile', compact('user'));
    }

    /**
     * Mise à jour du profil résident
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'needs' => 'nullable|string|max:1000',
        ], [
            'name.required' => 'Le nom est obligatoire.',
            'name.max' => 'Le nom ne peut pas dépasser 255 caractères.',
            'phone.max' => 'Le téléphone ne peut pas dépasser 20 caractères.',
            'needs.max' => 'Les besoins ne peuvent pas dépasser 1000 caractères.',
        ]);

        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'needs' => $request->needs,
        ]);

        return redirect()->route('resident.profile')->with('toast', [
            'type' => 'success',
            'message' => 'Profil mis à jour avec succès.'
        ]);
    }
}