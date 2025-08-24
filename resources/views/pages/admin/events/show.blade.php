@extends('pages.admin.layouts.app')

@section('title', $event->getTranslatedAttribute('title'))
@section('page-title', 'Détails de l\'événement')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- En-tête -->
    <div class="mb-8">
        <div class="flex items-center space-x-3 text-sm text-gray-500 mb-4">
            <a href="{{ route('admin.events.index') }}" class="hover:text-primary transition-colors">Événements</a>
            <i data-lucide="chevron-right" class="h-4 w-4"></i>
            <span class="text-gray-900">{{ Str::limit($event->getTranslatedAttribute('title'), 50) }}</span>
        </div>
        
        <div class="flex items-start justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900 font-poppins">{{ $event->getTranslatedAttribute('title') }}</h1>
                <div class="mt-2 flex items-center gap-x-4 text-sm text-gray-500">
                    <div class="flex items-center gap-x-1">
                        <i data-lucide="calendar" class="h-4 w-4"></i>
                        <span>Du {{ $event->start_date->format('d/m/Y à H:i') }} au {{ $event->end_date->format('d/m/Y à H:i') }}</span>
                    </div>
                    <div class="flex items-center gap-x-1">
                        <i data-lucide="map-pin" class="h-4 w-4"></i>
                        <span>{{ $event->getTranslatedAttribute('location') }}{{ $event->is_remote ? ' (En ligne)' : '' }}</span>
                    </div>
                    <div class="flex items-center gap-x-1">
                        <i data-lucide="users" class="h-4 w-4"></i>
                        <span>{{ $event->registrations->count() }} participant{{ $event->registrations->count() > 1 ? 's' : '' }}</span>
                    </div>
                </div>
            </div>
            
            <div class="flex items-center gap-x-3">
                <a href="{{ route('admin.events.edit', $event) }}" 
                   class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 transition-colors font-poppins">
                    <i data-lucide="edit" class="h-4 w-4 mr-2"></i>
                    Modifier
                </a>
                <button type="button" 
                        onclick="openConfirmModal('{{ route('admin.events.destroy', $event) }}', 'Êtes-vous sûr de vouloir supprimer cet événement ?', 'delete', 'DELETE')"
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
            @if($event->illustration)
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl overflow-hidden">
                <img src="{{ asset('storage/' . $event->illustration) }}" 
                     alt="{{ $event->getTranslatedAttribute('title') }}" 
                     class="w-full h-auto">
            </div>
            @endif

            <!-- Description de l'événement -->
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
                <div class="px-4 py-6 sm:p-8">
                    <div class="mb-6">
                        <h2 class="text-lg font-semibold text-gray-900 font-poppins mb-3">Description</h2>
                        <div class="prose max-w-none text-gray-700">
                            {!! nl2br(e($event->getTranslatedAttribute('description'))) !!}
                        </div>
                    </div>
                    
                    @if($event->getTranslatedAttribute('agenda'))
                    <div class="border-t border-gray-200 pt-6">
                        <h2 class="text-lg font-semibold text-gray-900 font-poppins mb-3">Programme</h2>
                        <div class="prose max-w-none text-gray-700">
                            {!! nl2br(e($event->getTranslatedAttribute('agenda'))) !!}
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Liste des participants -->
            @if($event->registrations->count() > 0)
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
                <div class="px-4 py-6 sm:p-8">
                    <h2 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Participants inscrits ({{ $event->registrations->count() }})</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($event->registrations->take(12) as $registration)
                        <div class="flex items-center space-x-3">
                            <div class="h-8 w-8 rounded-full bg-primary text-white flex items-center justify-center text-sm font-semibold">
                                {{ strtoupper(substr($registration->user->getFirstName(), 0, 1)) }}
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $registration->user->getFullName() }}</p>
                                <p class="text-xs text-gray-500">{{ $registration->created_at->format('d/m/Y') }}</p>
                            </div>
                        </div>
                        @endforeach
                        
                        @if($event->registrations->count() > 12)
                        <div class="text-sm text-gray-500">
                            et {{ $event->registrations->count() - 12 }} autre{{ $event->registrations->count() - 12 > 1 ? 's' : '' }}...
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
                                @switch($event->status?->value)
                                    @case('draft')
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                            Brouillon
                                        </span>
                                        @break
                                    @case('published')
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            Publié
                                        </span>
                                        @break
                                    @case('cancelled')
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                            Annulé
                                        </span>
                                        @break
                                    @default
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                            {{ $event->status?->value ?? 'Non défini' }}
                                        </span>
                                @endswitch
                            </dd>
                        </div>

                        <!-- Type -->
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Type d'événement</dt>
                            <dd class="mt-1">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                    {{ ucfirst($event->type) }}
                                </span>
                            </dd>
                        </div>

                        <!-- Prix -->
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Tarification</dt>
                            <dd class="mt-1">
                                @if($event->is_paid)
                                    <div>
                                        <span class="text-lg font-semibold text-gray-900">{{ number_format($event->getCurrentPrice(), 0, ',', ' ') }} {{ $event->currency ?? 'FCFA' }}</span>
                                        @if($event->early_bird_price && $event->early_bird_end_date)
                                        <div class="text-xs text-gray-500 mt-1">
                                            Early bird: {{ number_format($event->early_bird_price, 0, ',', ' ') }} {{ $event->currency ?? 'FCFA' }}
                                            (jusqu'au {{ $event->early_bird_end_date->format('d/m/Y') }})
                                        </div>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-green-600 font-medium">Gratuit</span>
                                @endif
                            </dd>
                        </div>

                        <!-- Capacité -->
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Participants</dt>
                            <dd class="mt-1">
                                @if($event->max_participants)
                                    <span class="text-sm text-gray-900">
                                        {{ $event->registrations->count() }} / {{ $event->max_participants }}
                                        @if($event->isFull())
                                            <span class="text-red-600 font-medium">Complet</span>
                                        @endif
                                    </span>
                                @else
                                    <span class="text-sm text-gray-900">{{ $event->registrations->count() }} / Illimité</span>
                                @endif
                            </dd>
                        </div>

                        <!-- Date de création -->
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Créé le</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ $event->created_at->format('d/m/Y à H:i') }}
                            </dd>
                        </div>

                        <!-- Dernière modification -->
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Modifié le</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ $event->updated_at->format('d/m/Y à H:i') }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Tags -->
            @if($event->tags && count($event->tags) > 0)
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
                <div class="px-4 py-6 sm:p-6">
                    <h3 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Tags</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($event->tags as $tag)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                {{ $tag }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Actions rapides -->
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
                <div class="px-4 py-6 sm:p-6">
                    <h3 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Actions rapides</h3>
                    <div class="space-y-3">
                        @if($event->status?->value === 'draft')
                        <form action="{{ route('admin.events.publish', $event) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full inline-flex justify-center items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors font-poppins">
                                <i data-lucide="send" class="h-4 w-4 mr-2"></i>
                                Publier l'événement
                            </button>
                        </form>
                        @elseif($event->status?->value === 'published')
                        <form action="{{ route('admin.events.cancel', $event) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full inline-flex justify-center items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors font-poppins">
                                <i data-lucide="x-circle" class="h-4 w-4 mr-2"></i>
                                Annuler l'événement
                            </button>
                        </form>
                        @endif
                        
                        <a href="{{ route('admin.events.duplicate', $event) }}" 
                           class="w-full inline-flex justify-center items-center px-3 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors font-poppins">
                            <i data-lucide="copy" class="h-4 w-4 mr-2"></i>
                            Dupliquer l'événement
                        </a>
                    </div>
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