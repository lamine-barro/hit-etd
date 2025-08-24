@extends('pages.admin.layouts.app')

@section('title', $espace->name)
@section('page-title', 'Détails de l\'espace')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- En-tête -->
    <div class="mb-8">
        <div class="flex items-center space-x-3 text-sm text-gray-500 mb-4">
            <a href="{{ route('admin.espaces.index') }}" class="hover:text-primary transition-colors">Espaces</a>
            <i data-lucide="chevron-right" class="h-4 w-4"></i>
            <span class="text-gray-900">{{ $espace->name }}</span>
        </div>
        
        <div class="flex items-start justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900 font-poppins">{{ $espace->name }}</h1>
                <div class="mt-2 flex items-center gap-x-4 text-sm text-gray-500">
                    <div class="flex items-center gap-x-1">
                        <i data-lucide="hash" class="h-4 w-4"></i>
                        <span>{{ $espace->code }}</span>
                    </div>
                    @if($espace->floor)
                    <div class="flex items-center gap-x-1">
                        <i data-lucide="building" class="h-4 w-4"></i>
                        <span>{{ \App\Models\Espace::FR_FLOORS[$espace->floor] ?? $espace->floor }}</span>
                    </div>
                    @endif
                    <div class="flex items-center gap-x-1">
                        <i data-lucide="users" class="h-4 w-4"></i>
                        <span>Capacité : {{ $espace->capacity ?? 'Non définie' }}</span>
                    </div>
                    <div class="flex items-center gap-x-1">
                        <i data-lucide="euro" class="h-4 w-4"></i>
                        <span>{{ number_format($espace->price_per_hour, 0, ',', ' ') }} FCFA/h</span>
                    </div>
                </div>
            </div>
            
            <div class="flex items-center gap-x-3">
                <a href="{{ route('admin.espaces.edit', $espace) }}" 
                   class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 transition-colors font-poppins">
                    <i data-lucide="edit" class="h-4 w-4 mr-2"></i>
                    Modifier
                </a>
                <button type="button" 
                        onclick="openConfirmModal('{{ route('admin.espaces.destroy', $espace) }}', 'Êtes-vous sûr de vouloir supprimer cet espace ?', 'delete', 'DELETE')"
                        class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-red-50 hover:text-red-700 hover:ring-red-300 transition-colors font-poppins">
                    <i data-lucide="trash-2" class="h-4 w-4 mr-2"></i>
                    Supprimer
                </button>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- Contenu principal -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Image d'illustration -->
            @if($espace->illustration_url)
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl overflow-hidden">
                <img src="{{ $espace->illustration_url }}" 
                     alt="{{ $espace->name }}" 
                     class="w-full h-auto">
            </div>
            @endif

            <!-- Description de l'espace -->
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
                <div class="px-4 py-6 sm:p-8">
                    <div class="mb-6">
                        <h2 class="text-lg font-semibold text-gray-900 font-poppins mb-3">Description</h2>
                        @if($espace->description)
                            <div class="prose max-w-none text-gray-700">
                                {!! nl2br(e($espace->description)) !!}
                            </div>
                        @else
                            <p class="text-gray-500">Aucune description disponible.</p>
                        @endif
                    </div>
                    
                    @if($espace->features && count($espace->features) > 0)
                    <div class="border-t border-gray-200 pt-6">
                        <h2 class="text-lg font-semibold text-gray-900 font-poppins mb-3">Équipements disponibles</h2>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                            @foreach($espace->features as $feature)
                            <div class="flex items-center space-x-2">
                                <i data-lucide="check" class="h-4 w-4 text-green-500"></i>
                                <span class="text-sm text-gray-700">{{ $feature }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Réservations récentes -->
            @if($espace->bookings && $espace->bookings->count() > 0)
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
                <div class="px-4 py-6 sm:p-8">
                    <h2 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Réservations récentes ({{ $espace->bookings->count() }})</h2>
                    <div class="space-y-4">
                        @foreach($espace->bookings->take(5) as $booking)
                        <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <div class="h-8 w-8 rounded-full bg-primary text-white flex items-center justify-center text-sm font-semibold">
                                    {{ strtoupper(substr($booking->user->getFirstName(), 0, 1)) }}
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $booking->user->getFullName() }}</p>
                                    <p class="text-xs text-gray-500">
                                        {{ $booking->start_time->format('d/m/Y à H:i') }} - {{ $booking->end_time->format('H:i') }}
                                    </p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-900">{{ number_format($booking->total_price, 0, ',', ' ') }} FCFA</p>
                                <p class="text-xs text-gray-500">{{ $booking->status }}</p>
                            </div>
                        </div>
                        @endforeach
                        
                        @if($espace->bookings->count() > 5)
                        <div class="text-center">
                            <a href="{{ route('admin.bookings.index', ['espace' => $espace->id]) }}" 
                               class="text-sm text-primary hover:text-orange-700 font-medium">
                                Voir toutes les réservations ({{ $espace->bookings->count() }})
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            
            <!-- Informations -->
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
                <div class="px-4 py-6 sm:p-6">
                    <h3 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Informations</h3>
                    
                    <dl class="space-y-4">
                        <!-- Statut -->
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Statut</dt>
                            <dd class="mt-1">
                                @switch($espace->status)
                                    @case(\App\Models\Espace::STATUS_AVAILABLE)
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            Disponible
                                        </span>
                                        @break
                                    @case(\App\Models\Espace::STATUS_UNAVAILABLE)
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                            Indisponible
                                        </span>
                                        @break
                                    @case(\App\Models\Espace::STATUS_RESERVED)
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Réservé
                                        </span>
                                        @break
                                    @default
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                            {{ $espace->status }}
                                        </span>
                                @endswitch
                            </dd>
                        </div>

                        <!-- Type -->
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Type d'espace</dt>
                            <dd class="mt-1">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full" style="background-color: #FFF4ED; color: #CC4700;">
                                    {{ \App\Models\Espace::FR_TYPES[$espace->type] ?? $espace->type }}
                                </span>
                            </dd>
                        </div>

                        <!-- Prix -->
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Tarification</dt>
                            <dd class="mt-1">
                                <span class="text-lg font-semibold text-gray-900">{{ number_format($espace->price_per_hour, 0, ',', ' ') }} FCFA</span>
                                <span class="text-sm text-gray-500">/heure</span>
                                @if($espace->price_per_day)
                                <div class="text-sm text-gray-600 mt-1">
                                    Journée : {{ number_format($espace->price_per_day, 0, ',', ' ') }} FCFA
                                </div>
                                @endif
                            </dd>
                        </div>

                        <!-- Capacité -->
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Capacité</dt>
                            <dd class="mt-1">
                                @if($espace->capacity)
                                    <span class="text-sm text-gray-900">{{ $espace->capacity }} personnes</span>
                                @else
                                    <span class="text-sm text-gray-500">Non définie</span>
                                @endif
                            </dd>
                        </div>

                        <!-- Surface -->
                        @if($espace->surface)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Surface</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ $espace->surface }} m²
                            </dd>
                        </div>
                        @endif

                        <!-- Publié -->
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Publié</dt>
                            <dd class="mt-1">
                                @if($espace->is_active)
                                    <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        <i data-lucide="check" class="h-3 w-3 mr-1"></i>
                                        Oui
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                        <i data-lucide="x" class="h-3 w-3 mr-1"></i>
                                        Non
                                    </span>
                                @endif
                            </dd>
                        </div>

                        <!-- Date de création -->
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Créé le</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ $espace->created_at->format('d/m/Y à H:i') }}
                            </dd>
                        </div>

                        <!-- Dernière modification -->
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Modifié le</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ $espace->updated_at->format('d/m/Y à H:i') }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Inclure le modal de suppression -->
@include('pages.admin.components.delete-modal')

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialiser les icônes Lucide
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
});
</script>
@endsection