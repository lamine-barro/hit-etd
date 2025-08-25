@extends('pages.admin.layouts.app')

@section('title', 'Détails réservation #' . $espaceOrder->reference)
@section('page-title', 'Détails réservation #' . $espaceOrder->reference)

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- En-tête -->
    <div class="mb-8">
        <div class="flex items-center space-x-3 text-sm text-gray-500 mb-4">
            <a href="{{ route('admin.espace-orders.index') }}" class="hover:text-gray-700">Réservations</a>
            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
            <span class="font-medium">Réservation #{{ $espaceOrder->reference }}</span>
        </div>
        
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <h1 class="text-3xl font-bold text-gray-900">Réservation #{{ $espaceOrder->reference }}</h1>
            <div class="mt-4 sm:mt-0 flex items-center space-x-3">
                <form method="POST" action="{{ route('admin.espace-orders.update-status', $espaceOrder) }}" class="inline">
                    @csrf
                    @method('PATCH')
                    <select name="status" onchange="this.form.submit()" class="rounded-full px-4 py-2 text-sm font-medium border cursor-pointer
                        @if($espaceOrder->status == 'pending') bg-yellow-100 text-yellow-800 border-yellow-200
                        @elseif($espaceOrder->status == 'confirmed') bg-green-100 text-green-800 border-green-200
                        @elseif($espaceOrder->status == 'cancelled') bg-gray-100 text-gray-800 border-gray-200
                        @else bg-red-100 text-red-800 border-red-200 @endif">
                        <option value="pending" {{ $espaceOrder->status == 'pending' ? 'selected' : '' }}>En attente</option>
                        <option value="confirmed" {{ $espaceOrder->status == 'confirmed' ? 'selected' : '' }}>Confirmée</option>
                        <option value="cancelled" {{ $espaceOrder->status == 'cancelled' ? 'selected' : '' }}>Annulée</option>
                        <option value="rejected" {{ $espaceOrder->status == 'rejected' ? 'selected' : '' }}>Rejetée</option>
                    </select>
                </form>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Informations principales -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Détails de la réservation -->
            <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Détails de la réservation</h3>
                </div>
                <div class="px-6 py-4 space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Référence</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $espaceOrder->reference }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Date de commande</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $espaceOrder->order_date?->format('d/m/Y H:i') }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Date de début</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $espaceOrder->started_at?->format('d/m/Y H:i') }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Date de fin</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $espaceOrder->ended_at?->format('d/m/Y H:i') }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Montant total</label>
                            <p class="mt-1 text-lg font-semibold text-gray-900">{{ number_format($espaceOrder->total_amount, 0, ',', ' ') }} FCFA</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Mode de paiement</label>
                            <p class="mt-1 text-sm text-gray-900">{{ \App\Models\EspaceOrder::PAYMENT_METHODS[$espaceOrder->payment_method] ?? $espaceOrder->payment_method }}</p>
                        </div>
                    </div>
                    
                    @if($espaceOrder->notes)
                        <div>
                            <label class="text-sm font-medium text-gray-500">Notes</label>
                            <p class="mt-1 text-sm text-gray-900 bg-gray-50 rounded-md p-3">{{ $espaceOrder->notes }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Espaces réservés -->
            @if($espaceOrder->espaces && $espaceOrder->espaces->count() > 0)
                <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Espaces réservés</h3>
                    </div>
                    <div class="px-6 py-4">
                        <div class="space-y-3">
                            @foreach($espaceOrder->espaces as $orderItem)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div class="flex-1">
                                        <h4 class="font-medium text-gray-900">{{ $orderItem->espace?->name ?? 'Espace supprimé' }}</h4>
                                        <p class="text-sm text-gray-500">
                                            Quantité: {{ $orderItem->quantity }} × {{ number_format($orderItem->unit_price, 0, ',', ' ') }} FCFA
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <span class="font-medium text-gray-900">{{ number_format($orderItem->total_price, 0, ',', ' ') }} FCFA</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Informations du résident -->
            <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Résident</h3>
                </div>
                <div class="px-6 py-4">
                    <div class="space-y-3">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Nom complet</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $espaceOrder->user->firstname }} {{ $espaceOrder->user->lastname }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Email</label>
                            <p class="mt-1 text-sm text-gray-900">
                                <a href="mailto:{{ $espaceOrder->user->email }}" class="text-indigo-600 hover:text-indigo-900">
                                    {{ $espaceOrder->user->email }}
                                </a>
                            </p>
                        </div>
                        @if($espaceOrder->user->phone)
                            <div>
                                <label class="text-sm font-medium text-gray-500">Téléphone</label>
                                <p class="mt-1 text-sm text-gray-900">
                                    <a href="tel:{{ $espaceOrder->user->phone }}" class="text-indigo-600 hover:text-indigo-900">
                                        {{ $espaceOrder->user->phone }}
                                    </a>
                                </p>
                            </div>
                        @endif
                        <div>
                            <label class="text-sm font-medium text-gray-500">Membre depuis</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $espaceOrder->user->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Actions</h3>
                </div>
                <div class="px-6 py-4 space-y-3">
                    <form method="POST" action="{{ route('admin.espace-orders.destroy', $espaceOrder) }}" 
                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?')" class="w-full">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-red-300 rounded-md shadow-sm text-sm font-medium text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Supprimer la réservation
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection