<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;
use App\Models\Espace;
use App\Models\EspaceOrder;
use App\Models\EspaceOrderItem;
use App\Models\Administrator;
use App\Notifications\SpaceReservationCreated;
use App\Notifications\AdminSpaceReservationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class EspaceOrderController extends Controller
{
    /**
     * Liste des réservations d'espaces du résident
     */
    public function index()
    {
        $orders = EspaceOrder::with(['orderItems.espace'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.resident.espaces.index', compact('orders'));
    }

    /**
     * Formulaire de création d'une nouvelle réservation
     */
    public function create()
    {
        $espaces = Espace::where('is_active', true)
            ->where('status', 'available')
            ->orderBy('name')
            ->get();

        return view('pages.resident.espaces.create', compact('espaces'));
    }

    /**
     * Enregistrement d'une nouvelle réservation
     */
    public function store(Request $request)
    {
        $request->validate([
            'espace_id' => 'required|exists:espaces,id',
            'reservation_date' => 'required|date|after:today',
            'start_time' => 'required|date_format:H:i',
            'duration' => 'required|integer|min:1|max:12',
            'participants_count' => 'required|integer|min:1|max:50',
            'description' => 'nullable|string|max:500',
            'notes' => 'nullable|string|max:1000',
        ], [
            'espace_id.required' => 'Veuillez sélectionner un espace.',
            'espace_id.exists' => 'L\'espace sélectionné n\'existe pas.',
            'reservation_date.required' => 'La date de réservation est obligatoire.',
            'reservation_date.after' => 'La réservation doit être pour une date future.',
            'start_time.required' => 'L\'heure de début est obligatoire.',
            'start_time.date_format' => 'L\'heure doit être au format HH:MM.',
            'duration.required' => 'La durée est obligatoire.',
            'duration.min' => 'La durée minimum est de 1 heure.',
            'duration.max' => 'La durée maximum est de 12 heures.',
            'participants_count.required' => 'Le nombre de participants est obligatoire.',
            'participants_count.min' => 'Il doit y avoir au moins 1 participant.',
            'participants_count.max' => 'Le nombre maximum de participants est de 50.',
            'description.max' => 'La description ne peut pas dépasser 500 caractères.',
            'notes.max' => 'Les notes ne peuvent pas dépasser 1000 caractères.',
        ]);

        $espace = Espace::findOrFail($request->espace_id);

        $order = DB::transaction(function () use ($request, $espace) {
            // Générer une référence unique
            $reference = 'ESP-' . strtoupper(uniqid());
            
            // Créer la commande
            $order = EspaceOrder::create([
                'user_id' => Auth::id(),
                'reference' => $reference,
                'order_date' => now(),
                'status' => 'pending',
                'total_amount' => 0, // Sera calculé avec les items
                'notes' => $request->notes,
            ]);

            // Utiliser la durée fournie
            $duration = (int) $request->duration;
            $totalPrice = ($espace->price_per_hour ?? 0) * $duration;

            // Calculer les dates de début et fin
            $reservationDateTime = $request->reservation_date . ' ' . $request->start_time;
            $startedAt = \Carbon\Carbon::parse($reservationDateTime);
            $endedAt = $startedAt->copy()->addHours($duration);

            // Créer l'item de commande avec l'espace sélectionné
            EspaceOrderItem::create([
                'espace_order_id' => $order->id,
                'espace_id' => $espace->id,
                'quantity' => $duration,
                'price' => $espace->price_per_hour ?? 0,
                'total_amount' => $totalPrice,
                'number_of_people' => $request->participants_count,
                'status' => 'pending',
                'notes' => $request->description ?? "Réservation de {$duration}h",
                'started_at' => $startedAt,
                'ended_at' => $endedAt,
            ]);

            // Mettre à jour le montant total
            $order->update([
                'total_amount' => ($espace->price_per_hour ?? 0) * $duration
            ]);

            return $order;
        });

        // Charger les relations pour les notifications
        $order->load(['orderItems.espace', 'user']);

        // Envoyer notification au résident
        $order->user->notify(new SpaceReservationCreated($order));

        // Envoyer notification aux administrateurs
        $administrators = Administrator::all();
        if ($administrators->count() > 0) {
            Notification::send($administrators, new AdminSpaceReservationNotification($order));
        }

        return redirect()->route('resident.espaces.index')->with('toast', [
            'type' => 'success',
            'message' => 'Votre réservation a été soumise avec succès ! Elle sera examinée par notre équipe.'
        ]);
    }

    /**
     * Affichage des détails d'une réservation
     */
    public function show(EspaceOrder $order)
    {
        // Vérifier que la réservation appartient au résident connecté
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load(['orderItems.espace', 'user']);

        return view('pages.resident.espaces.show', compact('order'));
    }

    /**
     * Suppression d'une réservation (si statut pending)
     */
    public function destroy(EspaceOrder $order)
    {
        // Vérifier que la réservation appartient au résident connecté
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // On peut seulement supprimer les réservations en attente
        if ($order->status !== 'pending') {
            return redirect()->back()->with('toast', [
                'type' => 'error',
                'message' => 'Impossible de supprimer cette réservation. Contactez l\'administration.'
            ]);
        }

        $order->delete();

        return redirect()->route('resident.espaces.index')->with('toast', [
            'type' => 'success',
            'message' => 'Réservation supprimée avec succès.'
        ]);
    }
}