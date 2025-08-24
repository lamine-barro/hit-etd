@extends('pages.admin.layouts.app')

@section('title', 'Demandes de visite')

@section('content')
<div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
        <h1 class="text-base font-semibold leading-6 text-gray-900">Demandes de visite</h1>
        <p class="mt-2 text-sm text-gray-700">Gérez les demandes de visite de votre hub d'innovation.</p>
    </div>
    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
        <a href="{{ route('admin.bookings.create') }}" class="inline-flex items-center rounded-md bg-primary px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-orange-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary transition-colors">
            <i data-lucide="plus" class="h-4 w-4 mr-2"></i>
            Nouvelle demande
        </a>
    </div>
</div>

<!-- Filters -->
<div class="mt-4 bg-white p-4 rounded-lg shadow">
    <form method="GET" action="{{ route('admin.bookings.index') }}" class="flex flex-wrap gap-4">
        <div class="flex-1 min-w-0">
            <select name="status" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <option value="">Tous les statuts</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>En attente</option>
                <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmé</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Annulé</option>
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
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Visiteur</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date de visite</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Espaces</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Objectif</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Demandé le</th>
                            <th scope="col" class="relative px-6 py-3"><span class="sr-only">Actions</span></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($bookings as $booking)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('admin.bookings.show', $booking) }}" class="block hover:text-primary transition-colors">
                                        <div class="text-sm font-medium text-gray-900 hover:text-primary">{{ $booking->full_name }}</div>
                                    </a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $booking->email }}</div>
                                    <div class="text-sm text-gray-500">{{ $booking->phone }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <div>{{ $booking->date->format('d/m/Y') }}</div>
                                    <div class="text-sm text-gray-500">{{ $booking->time }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
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
                                        <div class="text-sm text-gray-900">
                                            @foreach($spaces as $space)
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800 mr-1 mb-1">
                                                    {{ $space }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-gray-400">Non spécifié</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $booking->purpose ?? 'Non spécifié' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @switch($booking->status?->value)
                                        @case('pending')
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                En attente
                                            </span>
                                            @break
                                        @case('confirmed')
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                Confirmé
                                            </span>
                                            @break
                                        @case('cancelled')
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                                Annulé
                                            </span>
                                            @break
                                        @default
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                                {{ $booking->status }}
                                            </span>
                                    @endswitch
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $booking->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        @if($booking->status?->value === 'pending')
                                            <button type="button" class="inline-flex items-center p-2 text-gray-500 hover:text-green-600 rounded-lg hover:bg-green-50 transition-colors" onclick="openConfirmModal('{{ route('admin.bookings.approve', $booking) }}', 'Confirmer cette demande ?', 'approve', 'POST')" title="Confirmer">
                                                <i data-lucide="check" class="h-4 w-4"></i>
                                            </button>
                                            <button type="button" class="inline-flex items-center p-2 text-gray-500 hover:text-red-600 rounded-lg hover:bg-red-50 transition-colors" onclick="openConfirmModal('{{ route('admin.bookings.reject', $booking) }}', 'Annuler cette demande ?', 'reject', 'POST')" title="Rejeter">
                                                <i data-lucide="x" class="h-4 w-4"></i>
                                            </button>
                                        @endif
                                        <a href="{{ route('admin.bookings.show', $booking) }}" class="inline-flex items-center p-2 text-gray-500 hover:text-primary rounded-lg hover:bg-gray-100 transition-colors" title="Voir les détails">
                                            <i data-lucide="eye" class="h-4 w-4"></i>
                                        </a>
                                        <a href="{{ route('admin.bookings.edit', $booking) }}" class="inline-flex items-center p-2 text-gray-500 hover:text-primary rounded-lg hover:bg-gray-100 transition-colors" title="Modifier">
                                            <i data-lucide="edit" class="h-4 w-4"></i>
                                        </a>
                                        <button type="button" onclick="openConfirmModal('{{ route('admin.bookings.destroy', $booking) }}', 'Êtes-vous sûr de vouloir supprimer cette demande ?', 'delete', 'DELETE')" class="inline-flex items-center p-2 text-gray-500 hover:text-red-600 rounded-lg hover:bg-red-50 transition-colors" title="Supprimer">
                                            <i data-lucide="trash-2" class="h-4 w-4"></i>
                                        </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                    Aucune demande de visite trouvée.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@if($bookings->hasPages())
    <div class="mt-6">
        {{ $bookings->links() }}
    </div>
@endif
@endsection