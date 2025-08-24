@extends('pages.admin.layouts.app')

@section('title', 'Événements')

@section('content')
<div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
        <h1 class="text-base font-semibold leading-6 text-gray-900">Événements</h1>
        <p class="mt-2 text-sm text-gray-700">Gérez les événements de votre hub d'innovation.</p>
    </div>
    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
        <a href="{{ route('admin.events.create') }}" class="inline-flex items-center rounded-md bg-primary px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-orange-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary transition-colors">
            <i data-lucide="plus" class="h-4 w-4 mr-2"></i>
            Nouvel événement
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
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Événement</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Participants</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            <th scope="col" class="relative px-6 py-3"><span class="sr-only">Actions</span></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($events as $event)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($event->illustration)
                                        <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/' . $event->illustration) }}" alt="">
                                    @else
                                        <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5a2.25 2.25 0 002.25-2.25m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5a2.25 2.25 0 002.25 2.25v7.5" />
                                            </svg>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('admin.events.show', $event) }}" class="block hover:text-primary transition-colors">
                                        <div class="text-sm font-medium text-gray-900 hover:text-primary">{{ $event->getTranslatedAttribute('title') }}</div>
                                        <div class="text-sm text-gray-500">{{ $event->getTranslatedAttribute('location') }}</div>
                                        @if($event->is_remote)
                                            <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full" style="background-color: #FFF4ED; color: #CC4700;" class="mt-1">
                                                🌐 En ligne
                                            </span>
                                        @endif
                                    </a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                        {{ ucfirst($event->type) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div>{{ $event->start_date->format('d/m/Y H:i') }}</div>
                                    <div class="text-xs text-gray-400">
                                        Fin: {{ $event->end_date->format('d/m/Y H:i') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @if($event->max_participants)
                                        {{ $event->registrations->count() }} / {{ $event->max_participants }}
                                        @if($event->isFull())
                                            <span class="text-red-600 text-xs">Complet</span>
                                        @endif
                                    @else
                                        {{ $event->registrations->count() }} / ∞
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @if($event->is_paid)
                                        {{ number_format($event->getCurrentPrice(), 0, ',', ' ') }} {{ $event->currency ?? 'FCFA' }}
                                        @if($event->early_bird_price && $event->early_bird_end_date && now()->lt($event->early_bird_end_date))
                                            <span class="text-xs text-orange-600">Early bird</span>
                                        @endif
                                    @else
                                        <span class="text-green-600 font-medium">Gratuit</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
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
                                                {{ $event->status }}
                                            </span>
                                    @endswitch
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <a href="{{ route('admin.events.show', $event) }}" class="inline-flex items-center p-2 text-gray-500 hover:text-primary rounded-lg hover:bg-gray-100 transition-colors" title="Voir les détails">
                                            <i data-lucide="eye" class="h-4 w-4"></i>
                                        </a>
                                        <a href="{{ route('admin.events.edit', $event) }}" class="inline-flex items-center p-2 text-gray-500 hover:text-primary rounded-lg hover:bg-gray-100 transition-colors" title="Modifier">
                                            <i data-lucide="edit" class="h-4 w-4"></i>
                                        </a>
                                        <button type="button" onclick="openConfirmModal('{{ route('admin.events.destroy', $event) }}', 'Êtes-vous sûr de vouloir supprimer cet événement ?', 'delete', 'DELETE')" class="inline-flex items-center p-2 text-gray-500 hover:text-red-600 rounded-lg hover:bg-red-50 transition-colors" title="Supprimer">
                                            <i data-lucide="trash-2" class="h-4 w-4"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                    Aucun événement trouvé.
                                    <a href="{{ route('admin.events.create') }}" class="text-primary hover:text-primary ml-1">Créer le premier événement</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@if($events->hasPages())
    <div class="mt-6">
        {{ $events->links() }}
    </div>
@endif
@endsection