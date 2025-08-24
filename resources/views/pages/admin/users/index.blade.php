@extends('pages.admin.layouts.app')

@section('title', 'Utilisateurs')

@section('content')
<div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
        <h1 class="text-base font-semibold leading-6 text-gray-900">Utilisateurs</h1>
        <p class="mt-2 text-sm text-gray-700">Gérez les utilisateurs de votre hub d'innovation.</p>
    </div>
    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center rounded-md bg-primary px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-orange-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary transition-colors">
            <i data-lucide="plus" class="h-4 w-4 mr-2"></i>
            Nouvel utilisateur
        </a>
    </div>
</div>

<!-- Filters -->
<div class="mt-4 bg-white p-4 rounded-lg shadow">
    <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-wrap gap-4">
        <div class="flex-1 min-w-0">
            <select name="category" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <option value="">Toutes les catégories</option>
                @foreach(\App\Models\User::CATEGORIES as $key => $label)
                    <option value="{{ $key }}" {{ request('category') == $key ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="flex-1 min-w-0">
            <select name="is_active" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <option value="">Tous les statuts</option>
                <option value="1" {{ request('is_active') === '1' ? 'selected' : '' }}>Actif</option>
                <option value="0" {{ request('is_active') === '0' ? 'selected' : '' }}>Inactif</option>
            </select>
        </div>
        <div class="flex-shrink-0">
            <button type="submit" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Filtrer
            </button>
        </div>
    </form>
</div>

<div class="mt-8 flow-root">
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Avatar</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Utilisateur</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catégorie</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vérification</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Inscrit le</th>
                            <th scope="col" class="relative px-6 py-3"><span class="sr-only">Actions</span></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($users as $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($user->profile_picture)
                                        @if(str_starts_with($user->profile_picture, 'http'))
                                            <img class="h-10 w-10 rounded-full object-cover" src="{{ $user->profile_picture }}" alt="{{ $user->name }}">
                                        @else
                                            <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ $user->name }}">
                                        @endif
                                    @else
                                        <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                                            <span class="text-sm font-medium text-gray-700">{{ substr($user->name, 0, 2) }}</span>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('admin.users.show', $user) }}" class="block hover:text-primary transition-colors">
                                        <div class="text-sm font-medium text-gray-900 hover:text-primary">{{ $user->name }}</div>
                                        <div class="text-sm text-gray-500">ID: {{ $user->id }}</div>
                                    </a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                        @switch($user->category)
                                            @case('startup') style="background-color: #FFF4ED; color: #CC4700;" @break
                                            @case('person') style="background-color: #FFF4ED; color: #CC4700;" @break
                                            @case('expert') bg-green-100 text-green-800 @break
                                            @case('entreprise') bg-orange-100 text-orange-800 @break
                                            @default bg-gray-100 text-gray-800
                                        @endswitch
                                    ">
                                        {{ \App\Models\User::CATEGORIES[$user->category] ?? $user->category }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $user->email }}</div>
                                    <div class="text-sm text-gray-500">{{ $user->phone }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($user->is_verified)
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            ✓ Vérifié
                                        </span>
                                    @else
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            En attente
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($user->is_active)
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            Actif
                                        </span>
                                    @else
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                            Inactif
                                        </span>
                                        @if($user->lock_raison)
                                            <div class="text-xs text-gray-500 mt-1">{{ $user->lock_raison }}</div>
                                        @endif
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $user->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <button type="button" class="inline-flex items-center p-2 text-gray-500 hover:text-{{ $user->is_active ? 'red' : 'green' }}-600 rounded-lg hover:bg-{{ $user->is_active ? 'red' : 'green' }}-50 transition-colors" onclick="openConfirmModal('{{ route('admin.users.toggle-status', $user) }}', '{{ $user->is_active ? 'Désactiver' : 'Activer' }} cet utilisateur ?', '{{ $user->is_active ? 'reject' : 'approve' }}', 'POST')" title="{{ $user->is_active ? 'Désactiver' : 'Activer' }}">
                                            <i data-lucide="{{ $user->is_active ? 'user-x' : 'user-check' }}" class="h-4 w-4"></i>
                                        </button>
                                        <a href="{{ route('admin.users.show', $user) }}" class="inline-flex items-center p-2 text-gray-500 hover:text-primary rounded-lg hover:bg-gray-100 transition-colors" title="Voir les détails">
                                            <i data-lucide="eye" class="h-4 w-4"></i>
                                        </a>
                                        <a href="{{ route('admin.users.edit', $user) }}" class="inline-flex items-center p-2 text-gray-500 hover:text-primary rounded-lg hover:bg-gray-100 transition-colors" title="Modifier">
                                            <i data-lucide="edit" class="h-4 w-4"></i>
                                        </a>
                                        <button type="button" onclick="openConfirmModal('{{ route('admin.users.destroy', $user) }}', 'Êtes-vous sûr de vouloir supprimer cet utilisateur ?', 'delete', 'DELETE')" class="inline-flex items-center p-2 text-gray-500 hover:text-red-600 rounded-lg hover:bg-red-50 transition-colors" title="Supprimer">
                                            <i data-lucide="trash-2" class="h-4 w-4"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                    Aucun utilisateur trouvé.
                                    <a href="{{ route('admin.users.create') }}" class="text-primary hover:text-primary ml-1">Créer le premier utilisateur</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@if($users->hasPages())
    <div class="mt-6">
        {{ $users->links() }}
    </div>
@endif
@endsection