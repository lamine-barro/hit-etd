<x-layouts.resident>
    <x-slot:title>Détails réservation - Espace résident</x-slot:title>
    <x-slot:pageTitle>Détails de la réservation</x-slot:pageTitle>
    <x-slot:pageDescription>Informations complètes sur votre réservation d'espace</x-slot:pageDescription>

    <div class="space-y-4">
        <!-- Back Button -->
        <div>
            <a href="{{ route('resident.espaces.index') }}" 
               class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
                Retour aux réservations
            </a>
        </div>

        <!-- Reservation Details -->
        <div class="bg-white rounded-lg border border-gray-200 p-4">
            <!-- Header -->
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="h-10 w-10 bg-orange-500 rounded-lg flex items-center justify-center">
                        <i data-lucide="calendar" class="w-5 h-5 text-white"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">
                            @if($order->orderItems->first() && $order->orderItems->first()->espace)
                                {{ $order->orderItems->first()->espace->name }}
                            @else
                                Réservation d'espace
                            @endif
                        </h2>
                        <p class="text-sm text-gray-500">Réservation #{{ $order->id }} • {{ $order->reference }}</p>
                    </div>
                </div>
                
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                    {{ $order->status === 'confirmed' ? 'bg-green-100 text-green-800' : '' }}
                    {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                    {{ $order->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}
                    {{ $order->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}">
                    {{ match($order->status) {
                        'confirmed' => 'Confirmée',
                        'pending' => 'En attente',
                        'cancelled' => 'Annulée',
                        'rejected' => 'Refusée',
                        default => ucfirst($order->status)
                    } }}
                </span>
            </div>

            <!-- Basic Info -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div>
                    <h3 class="text-sm font-medium text-gray-700 mb-1">Date de commande</h3>
                    <p class="text-gray-900">{{ $order->order_date->format('d/m/Y à H:i') }}</p>
                </div>
                
                <div>
                    <h3 class="text-sm font-medium text-gray-700 mb-1">Montant total</h3>
                    <p class="text-lg font-semibold text-gray-900">{{ number_format($order->total_amount, 0, ',', ' ') }} FCFA</p>
                </div>
                
                <div>
                    <h3 class="text-sm font-medium text-gray-700 mb-1">Nombre d'items</h3>
                    <p class="text-gray-900">{{ $order->orderItems->count() }} réservation{{ $order->orderItems->count() > 1 ? 's' : '' }}</p>
                </div>
            </div>

            <!-- Order Items -->
            @if($order->orderItems->count() > 0)
                <div class="border-t border-gray-200 pt-4">
                    <h3 class="text-sm font-medium text-gray-700 mb-3">Détails des créneaux réservés</h3>
                    <div class="space-y-3">
                        @foreach($order->orderItems as $item)
                            <div class="bg-gray-50 rounded-lg p-3">
                                <div class="flex items-center justify-between mb-2">
                                    <h4 class="font-medium text-gray-900">{{ $item->espace->name ?? 'Espace' }}</h4>
                                    <span class="text-lg font-semibold text-gray-900">{{ number_format($item->total_amount, 0, ',', ' ') }} FCFA</span>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                                    <div>
                                        <span class="text-gray-600">Période :</span>
                                        @if($item->started_at && $item->ended_at)
                                            <span class="text-gray-900">{{ $item->started_at->format('d/m/Y de H:i') }} à {{ $item->ended_at->format('H:i') }}</span>
                                        @else
                                            <span class="text-gray-500">Non spécifiée</span>
                                        @endif
                                    </div>
                                    
                                    <div>
                                        <span class="text-gray-600">Durée :</span>
                                        <span class="text-gray-900">{{ $item->quantity }} heure{{ $item->quantity > 1 ? 's' : '' }}</span>
                                    </div>
                                    
                                    @if($item->number_of_people)
                                        <div>
                                            <span class="text-gray-600">Participants :</span>
                                            <span class="text-gray-900">{{ $item->number_of_people }} personne{{ $item->number_of_people > 1 ? 's' : '' }}</span>
                                        </div>
                                    @endif
                                    
                                    <div>
                                        <span class="text-gray-600">Prix unitaire :</span>
                                        <span class="text-gray-900">{{ number_format($item->price, 0, ',', ' ') }} FCFA/h</span>
                                    </div>
                                </div>
                                
                                @if($item->notes)
                                    <div class="mt-2">
                                        <span class="text-sm text-gray-600">Description :</span>
                                        <p class="text-sm text-gray-900 mt-1">{{ $item->notes }}</p>
                                    </div>
                                @endif
                                
                                <div class="flex items-center justify-between mt-2 pt-2 border-t border-gray-200">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                        {{ $item->status === 'confirmed' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $item->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $item->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}
                                        {{ $item->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}">
                                        {{ match($item->status) {
                                            'confirmed' => 'Confirmé',
                                            'pending' => 'En attente',
                                            'cancelled' => 'Annulé',
                                            'rejected' => 'Refusé',
                                            default => ucfirst($item->status)
                                        } }}
                                    </span>
                                    
                                    @if($item->espace && $item->espace->type)
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-blue-100 text-blue-800">
                                            {{ ucfirst(str_replace('_', ' ', $item->espace->type)) }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Notes -->
            @if($order->notes)
                <div class="border-t border-gray-200 pt-4 mt-4">
                    <h3 class="text-sm font-medium text-gray-700 mb-2">Notes supplémentaires</h3>
                    <p class="text-gray-900 text-sm">{{ $order->notes }}</p>
                </div>
            @endif
        </div>

        <!-- Actions -->
        <div class="flex justify-end space-x-2">
            @if($order->status === 'pending')
                <form method="POST" action="{{ route('resident.espaces.destroy', $order) }}" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?')"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-red-600 bg-red-50 border border-red-200 rounded-lg hover:bg-red-100 hover:border-red-300 transition-colors">
                        <i data-lucide="trash-2" class="w-4 h-4 mr-2"></i>
                        Supprimer la réservation
                    </button>
                </form>
            @endif
        </div>
    </div>
</x-layouts.resident>