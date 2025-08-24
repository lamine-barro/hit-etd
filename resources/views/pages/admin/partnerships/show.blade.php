@extends('pages.admin.layouts.app')

@section('title', 'Détails partenariat')
@section('page-title', 'Détails partenariat')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- En-tête -->
    <div class="mb-8">
        <div class="flex items-center space-x-3 text-sm text-gray-500 mb-4">
            <a href="{{ route('admin.partnerships.index') }}" class="hover:text-primary transition-colors">Partenariats</a>
            <i data-lucide="chevron-right" class="h-4 w-4"></i>
            <span class="text-gray-900">{{ $partnership->organization_name }}</span>
        </div>
        
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900 font-poppins">{{ $partnership->organization_name }}</h1>
                <p class="mt-2 text-sm text-gray-600">
                    Demande de partenariat créée le {{ $partnership->created_at->format('d/m/Y') }}
                </p>
            </div>
            
            <!-- Actions -->
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.partnerships.edit', $partnership) }}" 
                   class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors font-poppins">
                    <i data-lucide="edit" class="h-4 w-4 mr-2"></i>
                    Modifier
                </a>
                
                <button onclick="openConfirmModal('{{ route('admin.partnerships.destroy', $partnership) }}', 'Êtes-vous sûr de vouloir supprimer ce partenariat ?', 'delete')"
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
            <!-- Informations de l'organisation -->
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 rounded-xl p-6">
                <h2 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Informations de l'organisation</h2>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Nom de l'organisation</label>
                        <p class="text-sm text-gray-900">{{ $partnership->organization_name }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Type de partenariat</label>
                        <p class="text-sm text-gray-900">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @switch($partnership->type->value)
                                    @case('financial') bg-green-100 text-green-800 @break
                                    @case('technical') bg-blue-100 text-blue-800 @break
                                    @case('strategic') bg-purple-100 text-purple-800 @break
                                    @case('media') bg-yellow-100 text-yellow-800 @break
                                    @default bg-gray-100 text-gray-800
                                @endswitch">
                                {{ $partnership->type->label() }}
                            </span>
                        </p>
                    </div>
                    
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Personne de contact</label>
                        <p class="text-sm text-gray-900">{{ $partnership->contact_name ?: 'Non renseigné' }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Email</label>
                        <p class="text-sm text-gray-900">
                            <a href="mailto:{{ $partnership->email }}" class="text-primary hover:text-orange-700">
                                {{ $partnership->email }}
                            </a>
                        </p>
                    </div>
                    
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Téléphone</label>
                        <p class="text-sm text-gray-900">{{ $partnership->phone ?: 'Non renseigné' }}</p>
                    </div>
                    
                    @if($partnership->amount)
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Montant</label>
                        <p class="text-sm text-gray-900">{{ number_format($partnership->amount, 0, ',', ' ') }} FCFA</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Message de la demande -->
            @if($partnership->message)
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 rounded-xl p-6">
                <h2 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Message de la demande</h2>
                <div class="prose prose-sm max-w-none">
                    <p class="text-gray-900 whitespace-pre-line">{{ $partnership->message }}</p>
                </div>
            </div>
            @endif

            <!-- Notes internes -->
            @if($partnership->internal_notes)
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 rounded-xl p-6">
                <h2 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Notes internes</h2>
                <div class="prose prose-sm max-w-none">
                    <p class="text-gray-900 whitespace-pre-line">{{ $partnership->internal_notes }}</p>
                </div>
            </div>
            @endif
        </div>
        
        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Statut -->
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Statut</h3>
                
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Statut actuel</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            @switch($partnership->status->value)
                                @case('pending') bg-yellow-100 text-yellow-800 @break
                                @case('approved') bg-green-100 text-green-800 @break
                                @case('rejected') bg-red-100 text-red-800 @break
                                @case('in_discussion') bg-blue-100 text-blue-800 @break
                                @default bg-gray-100 text-gray-800
                            @endswitch">
                            {{ $partnership->status->label() }}
                        </span>
                    </div>
                    
                    @if($partnership->processed_at)
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Traité le</span>
                        <span class="text-sm text-gray-900">{{ $partnership->processed_at->format('d/m/Y H:i') }}</span>
                    </div>
                    @endif
                </div>
            </div>
            
            <!-- Statistiques -->
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Informations</h3>
                
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Créé le</span>
                        <span class="text-sm font-medium text-gray-900">{{ $partnership->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Dernière modification</span>
                        <span class="text-sm font-medium text-gray-900">{{ $partnership->updated_at->diffForHumans() }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">ID</span>
                        <span class="text-sm font-medium text-gray-900">#{{ $partnership->id }}</span>
                    </div>
                </div>
            </div>
            
            <!-- Actions rapides -->
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Actions rapides</h3>
                
                <div class="space-y-3">
                    @if($partnership->status->value === 'pending')
                        <form action="{{ route('admin.partnerships.update', $partnership) }}" method="POST" class="inline">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="approved">
                            <button type="submit" class="w-full inline-flex items-center justify-center px-3 py-2 border border-green-300 rounded-lg text-sm font-medium text-green-700 bg-white hover:bg-green-50 transition-colors font-poppins">
                                <i data-lucide="check" class="h-4 w-4 mr-2"></i>
                                Approuver
                            </button>
                        </form>
                        
                        <form action="{{ route('admin.partnerships.update', $partnership) }}" method="POST" class="inline">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="in_discussion">
                            <button type="submit" class="w-full inline-flex items-center justify-center px-3 py-2 border border-blue-300 rounded-lg text-sm font-medium text-blue-700 bg-white hover:bg-blue-50 transition-colors font-poppins">
                                <i data-lucide="message-circle" class="h-4 w-4 mr-2"></i>
                                En discussion
                            </button>
                        </form>
                        
                        <form action="{{ route('admin.partnerships.update', $partnership) }}" method="POST" class="inline">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="rejected">
                            <button type="submit" class="w-full inline-flex items-center justify-center px-3 py-2 border border-red-300 rounded-lg text-sm font-medium text-red-700 bg-white hover:bg-red-50 transition-colors font-poppins">
                                <i data-lucide="x" class="h-4 w-4 mr-2"></i>
                                Rejeter
                            </button>
                        </form>
                    @elseif($partnership->status->value === 'in_discussion')
                        <form action="{{ route('admin.partnerships.update', $partnership) }}" method="POST" class="inline">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="approved">
                            <button type="submit" class="w-full inline-flex items-center justify-center px-3 py-2 border border-green-300 rounded-lg text-sm font-medium text-green-700 bg-white hover:bg-green-50 transition-colors font-poppins">
                                <i data-lucide="check" class="h-4 w-4 mr-2"></i>
                                Approuver
                            </button>
                        </form>
                        
                        <form action="{{ route('admin.partnerships.update', $partnership) }}" method="POST" class="inline">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="rejected">
                            <button type="submit" class="w-full inline-flex items-center justify-center px-3 py-2 border border-red-300 rounded-lg text-sm font-medium text-red-700 bg-white hover:bg-red-50 transition-colors font-poppins">
                                <i data-lucide="x" class="h-4 w-4 mr-2"></i>
                                Rejeter
                            </button>
                        </form>
                    @endif

                    <!-- Contact -->
                    <div class="pt-3 border-t border-gray-200">
                        <a href="mailto:{{ $partnership->email }}" 
                           class="w-full inline-flex items-center justify-center px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors font-poppins">
                            <i data-lucide="mail" class="h-4 w-4 mr-2"></i>
                            Contacter
                        </a>
                    </div>
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