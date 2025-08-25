<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EspaceOrder;
use App\Notifications\SpaceReservationStatusChanged;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EspaceOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = EspaceOrder::with(['user', 'orderItems.espace']);

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return view('pages.admin.espace-orders.index', compact('orders'));
    }

    public function show(EspaceOrder $espaceOrder)
    {
        $espaceOrder->load(['user', 'orderItems.espace']);
        return view('pages.admin.espace-orders.show', compact('espaceOrder'));
    }

    public function updateStatus(Request $request, EspaceOrder $espaceOrder)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,rejected'
        ]);

        $oldStatus = $espaceOrder->status;
        $newStatus = $request->status;

        // Ne pas envoyer de notification si le statut n'a pas changé
        if ($oldStatus === $newStatus) {
            return redirect()->back()->with('info', 'Aucun changement détecté.');
        }

        $espaceOrder->update([
            'status' => $newStatus
        ]);

        // Charger les relations nécessaires pour la notification
        $espaceOrder->load(['orderItems.espace', 'user']);

        // Envoyer notification au résident
        $espaceOrder->user->notify(new SpaceReservationStatusChanged($espaceOrder, $oldStatus, $newStatus));

        $statusLabel = [
            'pending' => 'En attente',
            'confirmed' => 'Confirmée',
            'cancelled' => 'Annulée',
            'rejected' => 'Rejetée'
        ][$newStatus];

        return redirect()->back()->with('success', "Statut mis à jour : {$statusLabel}. Une notification a été envoyée au résident.");
    }

    public function destroy(EspaceOrder $espaceOrder)
    {
        $espaceOrder->delete();
        return redirect()->route('admin.espace-orders.index')->with('success', 'Réservation supprimée avec succès.');
    }
}