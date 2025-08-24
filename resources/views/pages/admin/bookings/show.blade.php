@extends('pages.admin.layouts.app')

@section('title', 'Demande de visite - ' . $booking->full_name)
@section('page-title', 'Détails de la demande de visite')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- En-tête -->
    <div class="mb-8">
        <div class="flex items-center space-x-3 text-sm text-gray-500 mb-4">
            <a href="{{ route('admin.bookings.index') }}" class="hover:text-primary transition-colors">Demandes de visite</a>
            <i data-lucide="chevron-right" class="h-4 w-4"></i>
            <span class="text-gray-900">{{ $booking->full_name }}</span>
        </div>
        
        <div class="flex items-start justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900 font-poppins">Demande de {{ $booking->full_name }}</h1>
                <div class="mt-2 flex items-center gap-x-4 text-sm text-gray-500">
                    <div class="flex items-center gap-x-1">
                        <i data-lucide="calendar" class="h-4 w-4"></i>
                        <span>{{ $booking->date->format('d/m/Y') }} à {{ $booking->time }}</span>
                    </div>
                    <div class="flex items-center gap-x-1">
                        <i data-lucide="mail" class="h-4 w-4"></i>
                        <span>{{ $booking->email }}</span>
                    </div>
                    <div class="flex items-center gap-x-1">
                        <i data-lucide="phone" class="h-4 w-4"></i>
                        <span>{{ $booking->phone }}</span>
                    </div>
                </div>
            </div>
            
            <div class="flex items-center gap-x-3">
                <a href="{{ route('admin.bookings.edit', $booking) }}" 
                   class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 transition-colors font-poppins">
                    <i data-lucide="edit" class="h-4 w-4 mr-2"></i>
                    Modifier
                </a>
                <button type="button" 
                        onclick="openConfirmModal('{{ route('admin.bookings.destroy', $booking) }}', 'Êtes-vous sûr de vouloir supprimer cette demande de visite ?', 'delete', 'DELETE')"
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
            
            <!-- Informations du visiteur -->
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
                <div class="px-4 py-6 sm:p-8">
                    <h2 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Informations du visiteur</h2>
                    
                    <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Nom complet</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $booking->full_name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Email</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                <a href="mailto:{{ $booking->email }}" class="text-primary hover:text-orange-700">{{ $booking->email }}</a>
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Téléphone</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                <a href="tel:{{ $booking->phone }}" class="text-primary hover:text-orange-700">{{ $booking->phone }}</a>
                            </dd>
                        </div>
                        @if($booking->organization)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Organisation</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $booking->organization }}</dd>
                        </div>
                        @endif
                        @if($booking->visitors_count)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Nombre de visiteurs</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $booking->visitors_count }} personne{{ $booking->visitors_count > 1 ? 's' : '' }}</dd>
                        </div>
                        @endif
                        @if($booking->visit_type)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Type de visite</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                @switch($booking->visit_type)
                                    @case('discovery')
                                        Visite découverte
                                        @break
                                    @case('business')
                                        Visite d'affaires
                                        @break
                                    @case('partnership')
                                        Partenariat
                                        @break
                                    @case('investment')
                                        Investissement
                                        @break
                                    @default
                                        {{ ucfirst($booking->visit_type) }}
                                @endswitch
                            </dd>
                        </div>
                        @endif
                    </dl>
                </div>
            </div>

            <!-- Détails de la visite -->
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
                <div class="px-4 py-6 sm:p-8">
                    <h2 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Détails de la visite</h2>
                    
                    <dl class="space-y-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Date et heure</dt>
                            <dd class="mt-1 flex items-center text-sm text-gray-900">
                                <i data-lucide="calendar" class="h-4 w-4 mr-2 text-gray-400"></i>
                                {{ $booking->date->format('d/m/Y') }} à {{ $booking->time }}
                            </dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500">Objectif de la visite</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $booking->purpose ?? 'Non spécifié' }}</dd>
                        </div>

                        @php
                            $spaces = $booking->spaces;
                            if (is_string($spaces)) {
                                $spaces = json_decode($spaces, true) ?: [];
                            }
                            if (!is_array($spaces)) {
                                $spaces = [];
                            }
                        @endphp
                        
                        @if(!empty($spaces))
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Espaces d'intérêt</dt>
                            <dd class="mt-2">
                                <div class="flex flex-wrap gap-2">
                                    @foreach($spaces as $space)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            <i data-lucide="building" class="h-3 w-3 mr-1"></i>
                                            {{ $space }}
                                        </span>
                                    @endforeach
                                </div>
                            </dd>
                        </div>
                        @endif

                        @if($booking->message)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Message</dt>
                            <dd class="mt-1 text-sm text-gray-900 bg-gray-50 p-3 rounded-md">
                                {{ $booking->message }}
                            </dd>
                        </div>
                        @endif
                    </dl>
                </div>
            </div>

            <!-- Historique des actions -->
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
                <div class="px-4 py-6 sm:p-8">
                    <h2 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Historique</h2>
                    
                    <div class="flow-root">
                        <ul class="-mb-8">
                            <li>
                                <div class="relative pb-8">
                                    <div class="relative flex space-x-3">
                                        <div>
                                            <span class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white">
                                                <i data-lucide="plus" class="h-4 w-4 text-white"></i>
                                            </span>
                                        </div>
                                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                            <div>
                                                <p class="text-sm text-gray-500">Demande créée</p>
                                            </div>
                                            <div class="whitespace-nowrap text-right text-sm text-gray-500">
                                                {{ $booking->created_at->format('d/m/Y à H:i') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            
                            @if($booking->updated_at != $booking->created_at)
                            <li>
                                <div class="relative">
                                    <div class="relative flex space-x-3">
                                        <div>
                                            <span class="h-8 w-8 rounded-full bg-orange-500 flex items-center justify-center ring-8 ring-white">
                                                <i data-lucide="edit" class="h-4 w-4 text-white"></i>
                                            </span>
                                        </div>
                                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                            <div>
                                                <p class="text-sm text-gray-500">Demande modifiée</p>
                                            </div>
                                            <div class="whitespace-nowrap text-right text-sm text-gray-500">
                                                {{ $booking->updated_at->format('d/m/Y à H:i') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            
            <!-- Statut et actions -->
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
                <div class="px-4 py-6 sm:p-6">
                    <h3 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Statut</h3>
                    
                    <div class="mb-4">
                        @switch($booking->status?->value)
                            @case('pending')
                                <span class="inline-flex px-3 py-2 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    <i data-lucide="clock" class="h-4 w-4 mr-2"></i>
                                    En attente
                                </span>
                                @break
                            @case('confirmed')
                                <span class="inline-flex px-3 py-2 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                    <i data-lucide="check-circle" class="h-4 w-4 mr-2"></i>
                                    Confirmé
                                </span>
                                @break
                            @case('cancelled')
                                <span class="inline-flex px-3 py-2 text-sm font-semibold rounded-full bg-red-100 text-red-800">
                                    <i data-lucide="x-circle" class="h-4 w-4 mr-2"></i>
                                    Annulé
                                </span>
                                @break
                            @default
                                <span class="inline-flex px-3 py-2 text-sm font-semibold rounded-full bg-gray-100 text-gray-800">
                                    {{ $booking->status?->value ?? 'Non défini' }}
                                </span>
                        @endswitch
                    </div>

                    @if($booking->status?->value === 'pending')
                    <div class="space-y-3">
                        <form action="{{ route('admin.bookings.approve', $booking) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full inline-flex justify-center items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors font-poppins">
                                <i data-lucide="check" class="h-4 w-4 mr-2"></i>
                                Confirmer la demande
                            </button>
                        </form>
                        
                        <form action="{{ route('admin.bookings.reject', $booking) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full inline-flex justify-center items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors font-poppins">
                                <i data-lucide="x" class="h-4 w-4 mr-2"></i>
                                Rejeter la demande
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Informations système -->
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
                <div class="px-4 py-6 sm:p-6">
                    <h3 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Informations</h3>
                    
                    <dl class="space-y-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">ID de la demande</dt>
                            <dd class="mt-1 text-sm text-gray-900">#{{ $booking->id }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500">Date de création</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ $booking->created_at->format('d/m/Y à H:i') }}
                            </dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500">Dernière modification</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ $booking->updated_at->format('d/m/Y à H:i') }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Actions rapides -->
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
                <div class="px-4 py-6 sm:p-6">
                    <h3 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Actions rapides</h3>
                    <div class="space-y-3">
                        <a href="mailto:{{ $booking->email }}?subject=Votre demande de visite du {{ $booking->date->format('d/m/Y') }}" 
                           class="w-full inline-flex justify-center items-center px-3 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors font-poppins">
                            <i data-lucide="mail" class="h-4 w-4 mr-2"></i>
                            Envoyer un email
                        </a>

                        <a href="tel:{{ $booking->phone }}" 
                           class="w-full inline-flex justify-center items-center px-3 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors font-poppins">
                            <i data-lucide="phone" class="h-4 w-4 mr-2"></i>
                            Appeler
                        </a>
                        
                        <a href="{{ route('admin.bookings.duplicate', $booking) }}" 
                           class="w-full inline-flex justify-center items-center px-3 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors font-poppins">
                            <i data-lucide="copy" class="h-4 w-4 mr-2"></i>
                            Dupliquer
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