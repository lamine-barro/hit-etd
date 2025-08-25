<x-layouts.resident>
    <x-slot:title>Mes espaces - Espace résident</x-slot:title>
    <x-slot:pageTitle>Mes réservations d'espaces</x-slot:pageTitle>
    <x-slot:pageDescription>Gérez toutes vos réservations d'espaces de travail</x-slot:pageDescription>

    <div class="space-y-4">
        <!-- Quick Actions -->
        <div class="flex justify-between items-center">
            <a href="{{ route('resident.espaces.create') }}" 
               class="bg-orange-500 text-white px-3 py-2 rounded-lg hover:bg-orange-600 transition-colors font-medium flex items-center space-x-2">
                <i data-lucide="plus" class="w-4 h-4"></i>
                <span>Nouvelle réservation</span>
            </a>
            
            <h1 class="text-xl font-semibold text-gray-900">Mes réservations</h1>
        </div>

        @if($orders->count() > 0)
            <!-- Orders Grid -->
            <div class="space-y-3">
                @foreach($orders as $order)
                    @php
                        $firstItem = $order->orderItems->first();
                        $espace = $firstItem ? $firstItem->espace : null;
                    @endphp
                    
                    <div class="bg-white rounded-lg border border-gray-200 p-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="h-8 w-8 bg-orange-500 rounded-lg flex items-center justify-center">
                                    <i data-lucide="calendar" class="w-4 h-4 text-white"></i>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-gray-900">
                                        {{ $espace ? $espace->name : 'Réservation d\'espace' }}
                                    </h3>
                                    <div class="flex items-center space-x-2 text-sm text-gray-500">
                                        @if($firstItem && $firstItem->started_at)
                                            <span>{{ $firstItem->started_at->format('d/m/Y à H:i') }}</span>
                                            @if($firstItem->ended_at)
                                                <span>-</span>
                                                <span>{{ $firstItem->ended_at->format('H:i') }}</span>
                                            @endif
                                        @else
                                            <span>{{ $order->created_at->format('d/m/Y') }}</span>
                                        @endif
                                        
                                        @if($firstItem && $firstItem->quantity)
                                            <span>•</span>
                                            <span>{{ $firstItem->quantity }}h</span>
                                        @endif
                                        
                                        @if($firstItem && $firstItem->number_of_people)
                                            <span>•</span>
                                            <span>{{ $firstItem->number_of_people }} pers.</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="text-right">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
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
                                @if($order->total_amount > 0)
                                    <p class="text-sm font-medium text-gray-900 mt-1">{{ number_format($order->total_amount, 0, ',', ' ') }} FCFA</p>
                                @endif
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex justify-end items-center space-x-2 mt-2 pt-2 border-t border-gray-100">
                            <a href="{{ route('resident.espaces.show', $order) }}" 
                               class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-orange-600 bg-orange-50 border border-orange-200 rounded-md hover:bg-orange-100 hover:border-orange-300 transition-colors">
                                <i data-lucide="eye" class="w-3 h-3 mr-1"></i>
                                Détails
                            </a>
                            
                            @if($order->status === 'pending')
                                <form method="POST" action="{{ route('resident.espaces.destroy', $order) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('Supprimer cette réservation ?')"
                                            class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-red-600 bg-red-50 border border-red-200 rounded-md hover:bg-red-100 hover:border-red-300 transition-colors">
                                        <i data-lucide="trash-2" class="w-3 h-3 mr-1"></i>
                                        Supprimer
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $orders->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-lg border border-gray-200 p-8 text-center">
                <i data-lucide="building-2" class="w-12 h-12 text-gray-300 mx-auto mb-3"></i>
                <h3 class="text-base font-medium text-gray-900 mb-2">Aucune réservation</h3>
                <p class="text-gray-500 mb-4">Vous n'avez encore fait aucune réservation d'espace.</p>
                <a href="{{ route('resident.espaces.create') }}" 
                   class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition-colors font-medium inline-flex items-center space-x-2">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    <span>Faire ma première réservation</span>
                </a>
            </div>
        @endif
    </div>
</x-layouts.resident>