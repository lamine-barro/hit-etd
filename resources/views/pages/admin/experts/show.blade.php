@extends('pages.admin.layouts.app')

@section('title', 'Détails expert')
@section('page-title', 'Détails expert')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- En-tête -->
    <div class="mb-8">
        <div class="flex items-center space-x-3 text-sm text-gray-500 mb-4">
            <a href="{{ route('admin.experts.index') }}" class="hover:text-primary transition-colors">Experts</a>
            <i data-lucide="chevron-right" class="h-4 w-4"></i>
            <span class="text-gray-900">{{ $expert->full_name }}</span>
        </div>
        
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900 font-poppins">{{ $expert->full_name }}</h1>
                <p class="mt-2 text-sm text-gray-600">
                    Expert depuis le {{ $expert->created_at->format('d/m/Y') }}
                </p>
            </div>
            
            <!-- Actions -->
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.experts.edit', $expert) }}" 
                   class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors font-poppins">
                    <i data-lucide="edit" class="h-4 w-4 mr-2"></i>
                    Modifier
                </a>
                
                <button onclick="openConfirmModal('{{ route('admin.experts.destroy', $expert) }}', 'Êtes-vous sûr de vouloir supprimer cet expert ?', 'delete')"
                        class="inline-flex items-center px-3 py-2 border border-red-300 rounded-lg text-sm font-medium text-red-700 bg-white hover:bg-red-50 transition-colors font-poppins">
                    <i data-lucide="trash-2" class="h-4 w-4 mr-2"></i>
                    Supprimer
                </button>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Informations principales -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Informations personnelles -->
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 rounded-xl p-6">
                <h2 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Informations personnelles</h2>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Email</label>
                        <p class="text-sm text-gray-900">{{ $expert->email }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Téléphone</label>
                        <p class="text-sm text-gray-900">{{ $expert->phone ?: 'Non renseigné' }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Position</label>
                        <p class="text-sm text-gray-900">{{ $expert->position ?: 'Non renseignée' }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Organisation</label>
                        <p class="text-sm text-gray-900">{{ $expert->organization ?: 'Non renseignée' }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Années d'expérience</label>
                        <p class="text-sm text-gray-900">{{ $expert->years_experience ? $expert->years_experience . ' ans' : 'Non renseigné' }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">LinkedIn</label>
                        @if($expert->linkedin)
                            <a href="{{ $expert->linkedin }}" target="_blank" class="text-sm text-primary hover:text-orange-700">
                                Voir le profil
                            </a>
                        @else
                            <p class="text-sm text-gray-900">Non renseigné</p>
                        @endif
                    </div>

                    @if($expert->website)
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Site web</label>
                        <a href="{{ $expert->website }}" target="_blank" class="text-sm text-primary hover:text-orange-700">
                            Visiter le site
                        </a>
                    </div>
                    @endif
                </div>
                
                @if($expert->bio)
                <div class="mt-6">
                    <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Biographie</label>
                    <p class="text-sm text-gray-900">{{ $expert->bio }}</p>
                </div>
                @endif
                
                @if($expert->intervention_areas)
                <div class="mt-6">
                    <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Domaines d'intervention</label>
                    <p class="text-sm text-gray-900">{{ $expert->intervention_areas }}</p>
                </div>
                @endif
            </div>

            <!-- Spécialités -->
            @if($expert->specialties && count($expert->specialties) > 0)
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 rounded-xl p-6">
                <h2 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Spécialités</h2>
                
                <div class="flex flex-wrap gap-2">
                    @foreach($expert->specialties as $specialty)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-primary/10 text-primary">
                            {{ \App\Models\Expert::SPECIALTIES[$specialty] ?? $specialty }}
                        </span>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Disponibilité et tarifs -->
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 rounded-xl p-6">
                <h2 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Disponibilité et tarifs</h2>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Tarif horaire</label>
                        <p class="text-sm text-gray-900">
                            @if($expert->hourly_rate && $expert->hourly_rate > 0)
                                {{ number_format($expert->hourly_rate, 0, ',', ' ') }} FCFA
                            @else
                                Non renseigné
                            @endif
                        </p>
                    </div>
                    
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Disponibilité</label>
                        <p class="text-sm text-gray-900">
                            @switch($expert->availability)
                                @case('immediate') Immédiate @break
                                @case('1_week') Dans 1 semaine @break
                                @case('2_weeks') Dans 2 semaines @break
                                @case('1_month') Dans 1 mois @break
                                @case('limited') Limitée @break
                                @default Non renseignée
                            @endswitch
                        </p>
                    </div>
                </div>
                
                @if($expert->availability_notes)
                <div class="mt-4">
                    <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Notes sur la disponibilité</label>
                    <p class="text-sm text-gray-900">{{ $expert->availability_notes }}</p>
                </div>
                @endif
            </div>

            <!-- Documents -->
            @if($expert->cv_file)
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 rounded-xl p-6">
                <h2 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Documents</h2>
                
                <div class="flex items-center gap-3">
                    <i data-lucide="file-text" class="h-5 w-5 text-gray-400"></i>
                    <div>
                        <p class="text-sm font-medium text-gray-900">CV</p>
                        <a href="{{ asset('storage/' . $expert->cv_file) }}" target="_blank" class="text-sm text-primary hover:text-orange-700">
                            Télécharger le CV
                        </a>
                    </div>
                </div>
            </div>
            @endif
        </div>
        
        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Photo et statut -->
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 rounded-xl p-6">
                <div class="text-center">
                    @if($expert->profile_picture)
                        <img src="{{ str_starts_with($expert->profile_picture, 'http') ? $expert->profile_picture : asset('storage/' . $expert->profile_picture) }}" alt="{{ $expert->full_name }}" 
                             class="mx-auto h-24 w-24 rounded-full object-cover">
                    @else
                        <div class="mx-auto h-24 w-24 rounded-full bg-gray-300 flex items-center justify-center">
                            <i data-lucide="user" class="h-12 w-12 text-gray-400"></i>
                        </div>
                    @endif
                    
                    <h3 class="mt-4 text-lg font-semibold text-gray-900 font-poppins">{{ $expert->full_name }}</h3>
                    <p class="text-sm text-gray-500">{{ $expert->email }}</p>
                </div>
                
                <!-- Statuts -->
                <div class="mt-6 space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Statut</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            @switch($expert->status)
                                @case('approved') bg-green-100 text-green-800 @break
                                @case('pending') bg-yellow-100 text-yellow-800 @break
                                @case('rejected') bg-red-100 text-red-800 @break
                                @case('inactive') bg-gray-100 text-gray-800 @break
                                @default bg-gray-100 text-gray-800
                            @endswitch">
                            {{ \App\Models\Expert::STATUSES[$expert->status] ?? $expert->status }}
                        </span>
                    </div>
                    
                    @if($expert->processed_at)
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Traité le</span>
                        <span class="text-sm text-gray-900">{{ $expert->processed_at->format('d/m/Y H:i') }}</span>
                    </div>
                    @endif
                </div>
            </div>
            
            <!-- Statistiques -->
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Statistiques</h3>
                
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Inscrit depuis</span>
                        <span class="text-sm font-medium text-gray-900">{{ $expert->created_at->diffForHumans() }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Dernière modification</span>
                        <span class="text-sm font-medium text-gray-900">{{ $expert->updated_at->diffForHumans() }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Spécialités</span>
                        <span class="text-sm font-medium text-gray-900">{{ count($expert->specialties ?? []) }}</span>
                    </div>
                </div>
            </div>
            
            <!-- Actions rapides -->
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Actions rapides</h3>
                
                <div class="space-y-3">
                    @if($expert->status === 'pending')
                        <form action="{{ route('admin.experts.update', $expert) }}" method="POST" class="inline">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="approved">
                            <button type="submit" class="w-full inline-flex items-center justify-center px-3 py-2 border border-green-300 rounded-lg text-sm font-medium text-green-700 bg-white hover:bg-green-50 transition-colors font-poppins">
                                <i data-lucide="check" class="h-4 w-4 mr-2"></i>
                                Approuver
                            </button>
                        </form>
                        
                        <form action="{{ route('admin.experts.update', $expert) }}" method="POST" class="inline">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="rejected">
                            <button type="submit" class="w-full inline-flex items-center justify-center px-3 py-2 border border-red-300 rounded-lg text-sm font-medium text-red-700 bg-white hover:bg-red-50 transition-colors font-poppins">
                                <i data-lucide="x" class="h-4 w-4 mr-2"></i>
                                Rejeter
                            </button>
                        </form>
                    @elseif($expert->status === 'approved')
                        <form action="{{ route('admin.experts.update', $expert) }}" method="POST" class="inline">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="inactive">
                            <button type="submit" class="w-full inline-flex items-center justify-center px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors font-poppins">
                                <i data-lucide="pause" class="h-4 w-4 mr-2"></i>
                                Désactiver
                            </button>
                        </form>
                    @elseif($expert->status === 'inactive')
                        <form action="{{ route('admin.experts.update', $expert) }}" method="POST" class="inline">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="approved">
                            <button type="submit" class="w-full inline-flex items-center justify-center px-3 py-2 border border-green-300 rounded-lg text-sm font-medium text-green-700 bg-white hover:bg-green-50 transition-colors font-poppins">
                                <i data-lucide="play" class="h-4 w-4 mr-2"></i>
                                Réactiver
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialiser les icônes Lucide
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
});
</script>
@endsection