@extends('pages.admin.layouts.app')

@section('title', 'Détails utilisateur')
@section('page-title', 'Détails utilisateur')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- En-tête -->
    <div class="mb-8">
        <div class="flex items-center space-x-3 text-sm text-gray-500 mb-4">
            <a href="{{ route('admin.users.index') }}" class="hover:text-primary transition-colors">Utilisateurs</a>
            <i data-lucide="chevron-right" class="h-4 w-4"></i>
            <span class="text-gray-900">{{ $user->name }}</span>
        </div>
        
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900 font-poppins">{{ $user->name }}</h1>
                <p class="mt-2 text-sm text-gray-600">
                    Membre depuis le {{ $user->created_at->format('d/m/Y') }}
                </p>
            </div>
            
            <!-- Actions -->
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.users.edit', $user) }}" 
                   class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors font-poppins">
                    <i data-lucide="edit" class="h-4 w-4 mr-2"></i>
                    Modifier
                </a>
                
                <button onclick="openConfirmModal('{{ route('admin.users.destroy', $user) }}', 'Êtes-vous sûr de vouloir supprimer cet utilisateur ?', 'delete')"
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
            <!-- Profil -->
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 rounded-xl p-6">
                <h2 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Informations du profil</h2>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Email</label>
                        <p class="text-sm text-gray-900">{{ $user->email }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Téléphone</label>
                        <p class="text-sm text-gray-900">{{ $user->phone ?: 'Non renseigné' }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Catégorie</label>
                        <p class="text-sm text-gray-900">
                            {{ $user->category ? \App\Models\User::CATEGORIES[$user->category] ?? $user->category : 'Non renseignée' }}
                        </p>
                    </div>
                    
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Profession</label>
                        <p class="text-sm text-gray-900">{{ $user->profession ?: 'Non renseignée' }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Organisation</label>
                        <p class="text-sm text-gray-900">{{ $user->organization ?: 'Non renseignée' }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Ville</label>
                        <p class="text-sm text-gray-900">{{ $user->city ?: 'Non renseignée' }}</p>
                    </div>
                </div>
                
                @if($user->bio)
                <div class="mt-6">
                    <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Biographie</label>
                    <p class="text-sm text-gray-900">{{ $user->bio }}</p>
                </div>
                @endif
                
                @if($user->startup_description)
                <div class="mt-6">
                    <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Description entreprise</label>
                    <p class="text-sm text-gray-900">{{ $user->startup_description }}</p>
                </div>
                @endif
            </div>

            <!-- Commandes/Réservations -->
            @if($user->orders && $user->orders->count() > 0)
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 rounded-xl p-6">
                <h2 class="text-lg font-semibold text-gray-900 font-poppins mb-4">
                    Commandes ({{ $user->orders->count() }})
                </h2>
                
                <div class="overflow-hidden">
                    <table class="min-w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">ID</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">Date</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">Statut</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">Total</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($user->orders->take(5) as $order)
                            <tr>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">#{{ $order->id }}</td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->created_at->format('d/m/Y') }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($order->status === 'completed') bg-green-100 text-green-800
                                        @elseif($order->status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ number_format($order->total_amount, 0, ',', ' ') }} FCFA
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
        
        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Photo et statut -->
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 rounded-xl p-6">
                <div class="text-center">
                    @if($user->profile_picture)
                        <img src="{{ str_starts_with($user->profile_picture, 'http') ? $user->profile_picture : Storage::url($user->profile_picture) }}" alt="{{ $user->name }}" 
                             class="mx-auto h-24 w-24 rounded-full object-cover">
                    @else
                        <div class="mx-auto h-24 w-24 rounded-full bg-gray-300 flex items-center justify-center">
                            <i data-lucide="user" class="h-12 w-12 text-gray-400"></i>
                        </div>
                    @endif
                    
                    <h3 class="mt-4 text-lg font-semibold text-gray-900 font-poppins">{{ $user->name }}</h3>
                    <p class="text-sm text-gray-500">{{ $user->email }}</p>
                </div>
                
                <!-- Statuts -->
                <div class="mt-6 space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Statut du compte</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            {{ $user->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $user->is_active ? 'Actif' : 'Inactif' }}
                        </span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Vérifié</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            {{ $user->is_verified ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $user->is_verified ? 'Oui' : 'Non' }}
                        </span>
                    </div>
                    
                    @if($user->email_verified_at)
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Email vérifié</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            {{ $user->email_verified_at->format('d/m/Y') }}
                        </span>
                    </div>
                    @endif
                </div>
                
                @if(!$user->is_active && $user->lock_raison)
                <div class="mt-4 p-3 bg-red-50 border border-red-200 rounded-lg">
                    <h4 class="text-sm font-medium text-red-800 mb-1">Raison du blocage</h4>
                    <p class="text-sm text-red-700">{{ $user->lock_raison }}</p>
                </div>
                @endif
            </div>
            
            <!-- Statistiques -->
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Statistiques</h3>
                
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Commandes total</span>
                        <span class="text-sm font-medium text-gray-900">{{ $user->orders->count() }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Inscrit depuis</span>
                        <span class="text-sm font-medium text-gray-900">{{ $user->created_at->diffForHumans() }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Dernière connexion OTP</span>
                        <span class="text-sm font-medium text-gray-900">
                            @if($user->otp_expires_at)
                                {{ $user->otp_expires_at->diffForHumans() }}
                            @else
                                Jamais
                            @endif
                        </span>
                    </div>
                </div>
            </div>
            
            <!-- Actions rapides -->
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Actions rapides</h3>
                
                <div class="space-y-3">
                    @if(!$user->is_active)
                        <button onclick="toggleUserStatus('{{ route('admin.users.update', $user) }}', true)"
                                class="w-full inline-flex items-center justify-center px-3 py-2 border border-green-300 rounded-lg text-sm font-medium text-green-700 bg-white hover:bg-green-50 transition-colors font-poppins">
                            <i data-lucide="user-check" class="h-4 w-4 mr-2"></i>
                            Activer le compte
                        </button>
                    @else
                        <button onclick="toggleUserStatus('{{ route('admin.users.update', $user) }}', false)"
                                class="w-full inline-flex items-center justify-center px-3 py-2 border border-red-300 rounded-lg text-sm font-medium text-red-700 bg-white hover:bg-red-50 transition-colors font-poppins">
                            <i data-lucide="user-x" class="h-4 w-4 mr-2"></i>
                            Désactiver le compte
                        </button>
                    @endif
                    
                    @if(!$user->is_verified)
                        <button onclick="verifyUser('{{ route('admin.users.update', $user) }}')"
                                class="w-full inline-flex items-center justify-center px-3 py-2 border border-blue-300 rounded-lg text-sm font-medium text-blue-700 bg-white hover:bg-blue-50 transition-colors font-poppins">
                            <i data-lucide="shield-check" class="h-4 w-4 mr-2"></i>
                            Vérifier le compte
                        </button>
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

function toggleUserStatus(url, activate) {
    const message = activate ? 
        'Êtes-vous sûr de vouloir activer ce compte utilisateur ?' :
        'Êtes-vous sûr de vouloir désactiver ce compte utilisateur ?';
    
    const actionType = activate ? 'approve' : 'reject';
    
    // Créer un formulaire temporaire pour l'action
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = url;
    form.innerHTML = `
        @csrf
        @method('PUT')
        <input type="hidden" name="is_active" value="${activate ? '1' : '0'}">
    `;
    document.body.appendChild(form);
    
    openConfirmModal(url, message, actionType, 'PUT');
    
    // Remplacer la soumission du modal
    document.getElementById('deleteForm').innerHTML = form.innerHTML;
    document.getElementById('deleteForm').action = url;
}

function verifyUser(url) {
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = url;
    form.innerHTML = `
        @csrf
        @method('PUT')
        <input type="hidden" name="is_verified" value="1">
    `;
    document.body.appendChild(form);
    
    openConfirmModal(url, 'Êtes-vous sûr de vouloir vérifier ce compte utilisateur ?', 'approve', 'PUT');
    
    // Remplacer la soumission du modal
    document.getElementById('deleteForm').innerHTML = form.innerHTML;
    document.getElementById('deleteForm').action = url;
}
</script>
@endsection