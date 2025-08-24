@extends('pages.admin.layouts.app')

@section('title', 'Espaces')

@section('content')
<div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
        <h1 class="text-base font-semibold leading-6 text-gray-900">Espaces</h1>
        <p class="mt-2 text-sm text-gray-700">Gérez les espaces de votre hub d'innovation.</p>
    </div>
    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
        <a href="{{ route('admin.espaces.create') }}" class="inline-flex items-center rounded-md bg-primary px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-orange-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary transition-colors">
            <i data-lucide="plus" class="h-4 w-4 mr-2"></i>
            Ajouter un espace
        </a>
    </div>
</div>

<div class="mt-8 flow-root">
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Espace</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix/h</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Étage</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Publié</th>
                            <th scope="col" class="relative px-6 py-3"><span class="sr-only">Actions</span></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($espaces as $espace)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($espace->illustration_url)
                                        <img class="h-10 w-10 rounded-full object-cover" src="{{ $espace->illustration_url }}" alt="{{ $espace->name }}">
                                    @else
                                        <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('admin.espaces.show', $espace) }}" class="block hover:text-primary transition-colors">
                                        <div class="text-sm font-medium text-gray-900 hover:text-primary">{{ $espace->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $espace->code }}</div>
                                    </a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full" style="background-color: #FFF4ED; color: #CC4700;">
                                        {{ \App\Models\Espace::FR_TYPES[$espace->type] ?? $espace->type }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ number_format($espace->price_per_hour, 0, ',', ' ') }} FCFA
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($espace->floor)
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                            {{ \App\Models\Espace::FR_FLOORS[$espace->floor] ?? $espace->floor }}
                                        </span>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
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
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($espace->is_active)
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            Oui
                                        </span>
                                    @else
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                            Non
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <a href="{{ route('admin.espaces.show', $espace) }}" class="inline-flex items-center p-2 text-gray-500 hover:text-primary rounded-lg hover:bg-gray-100 transition-colors" title="Voir les détails">
                                            <i data-lucide="eye" class="h-4 w-4"></i>
                                        </a>
                                        <a href="{{ route('admin.espaces.edit', $espace) }}" class="inline-flex items-center p-2 text-gray-500 hover:text-primary rounded-lg hover:bg-gray-100 transition-colors" title="Modifier">
                                            <i data-lucide="edit" class="h-4 w-4"></i>
                                        </a>
                                        <button type="button" onclick="openConfirmModal('{{ route('admin.espaces.destroy', $espace) }}', 'Êtes-vous sûr de vouloir supprimer cet espace ?', 'delete', 'DELETE')" class="inline-flex items-center p-2 text-gray-500 hover:text-red-600 rounded-lg hover:bg-red-50 transition-colors" title="Supprimer">
                                            <i data-lucide="trash-2" class="h-4 w-4"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                    Aucun espace trouvé.
                                    <a href="{{ route('admin.espaces.create') }}" class="hover:text-primary ml-1" style="color: #FF6B00;">Créer le premier espace</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@if($espaces->hasPages())
    <div class="mt-6">
        {{ $espaces->links() }}
    </div>
@endif
@endsection