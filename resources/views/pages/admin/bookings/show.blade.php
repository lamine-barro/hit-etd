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

        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            
            <!-- Statut et actions -->
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
                <div class="px-4 py-6 sm:p-6">
                    <h3 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Statut</h3>
                    
                    <!-- Dropdown pour changer le statut -->
                    <form id="status-form" action="{{ route('admin.bookings.update-status', $booking) }}" method="POST" class="mb-4">
                        @csrf
                        @method('PATCH')
                        <select id="status-select" name="status" onchange="this.form.submit()" 
                                class="block w-full px-4 py-2 text-sm font-medium rounded-full border-0 cursor-pointer transition-colors
                                @if($booking->status?->value == 'untreated' || $booking->status == 'untreated') 
                                    bg-yellow-100 text-yellow-800 hover:bg-yellow-200
                                @elseif($booking->status?->value == 'treated' || $booking->status == 'treated') 
                                    bg-green-100 text-green-800 hover:bg-green-200
                                @else 
                                    bg-gray-100 text-gray-800 hover:bg-gray-200
                                @endif">
                            <option value="untreated" {{ ($booking->status?->value ?? $booking->status) == 'untreated' ? 'selected' : '' }}>Non traité</option>
                            <option value="treated" {{ ($booking->status?->value ?? $booking->status) == 'treated' ? 'selected' : '' }}>Traité</option>
                            <option value="archived" {{ ($booking->status?->value ?? $booking->status) == 'archived' ? 'selected' : '' }}>Archivé</option>
                        </select>
                    </form>

                    @php
                        $currentStatus = $booking->status?->value ?? $booking->status;
                    @endphp
                    @if($currentStatus === 'untreated')
                    <div class="space-y-3 pt-4 border-t border-gray-200">
                        <p class="text-sm text-gray-500">Actions rapides:</p>
                        <button type="button" 
                                onclick="document.getElementById('status-select').value='treated'; document.getElementById('status-form').submit();"
                                class="w-full inline-flex justify-center items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors font-poppins">
                            <i data-lucide="check" class="h-4 w-4 mr-2"></i>
                            Marquer comme traité
                        </button>
                        
                        <button type="button" 
                                onclick="document.getElementById('status-select').value='archived'; document.getElementById('status-form').submit();"
                                class="w-full inline-flex justify-center items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors font-poppins">
                            <i data-lucide="archive" class="h-4 w-4 mr-2"></i>
                            Archiver
                        </button>
                    </div>
                    @endif
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