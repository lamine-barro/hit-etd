@extends('layouts.app')

@section('content')
    <br><br><br>
    <div class="bg-gray-50 py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- En-tête -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ __('Nos événements') }}</h1>
            <p class="text-lg text-gray-600">{{ __('Découvrez nos prochains événements et inscrivez-vous') }}</p>
        </div>
        <!-- Filtres -->
        <div class="mb-8">
            <form action="{{ route('events') }}" method="GET" class="flex flex-wrap gap-4 justify-center">
                <select name="type" class="px-4 py-2.5 rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                    <option value="">{{ __('Tous les types') }}</option>
                    <option value="conference" {{ request('type') === 'conference' ? 'selected' : '' }}>{{ __('Conférence') }}</option>
                    <option value="workshop" {{ request('type') === 'workshop' ? 'selected' : '' }}>{{ __('Atelier') }}</option>
                    <option value="webinar" {{ request('type') === 'webinar' ? 'selected' : '' }}>{{ __('Webinaire') }}</option>
                    <option value="training" {{ request('type') === 'training' ? 'selected' : '' }}>{{ __('Formation') }}</option>
                </select>

                <select name="format" class="px-4 py-2.5 rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                    <option value="">{{ __('Tous les formats') }}</option>
                    <option value="physical" {{ request('format') === 'physical' ? 'selected' : '' }}>{{ __('Présentiel') }}</option>
                    <option value="remote" {{ request('format') === 'remote' ? 'selected' : '' }}>{{ __('En ligne') }}</option>
                </select>

                <button type="submit" class="px-6 py-2.5 bg-primary-600 text-white rounded-md hover:bg-primary-700 transition duration-200">
                    {{ __('Filtrer') }}
                </button>
            </form>
        </div>

        <!-- Liste des événements -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($events as $event)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    @if ($event->illustration)
                        <img src="{{ Storage::url($event->illustration) }}" alt="{{ $event->title }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    @endif

                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium px-2 py-1 rounded {{ $event->type === 'conference' ? 'bg-blue-100 text-blue-800' : ($event->type === 'workshop' ? 'bg-green-100 text-green-800' : ($event->type === 'webinar' ? 'bg-purple-100 text-purple-800' : 'bg-yellow-100 text-yellow-800')) }}">
                                {{ __($event->type) }}
                            </span>
                            <span class="text-sm text-gray-500">
                                {{ $event->is_remote ? __('En ligne') : __('Présentiel') }}
                            </span>
                        </div>

                        <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $event->title }}</h3>

                        <div class="mb-4 text-gray-600">
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ $event->start_date->format('d/m/Y H:i') }}
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ $event->location }}
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">
                                {{ $event->EventRegistrations_count }} / {{ $event->max_participants }} {{ __('inscrits') }}
                            </span>
                            <a href="{{ route('events.show', $event) }}" class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700">
                                {{ __('En savoir plus') }}
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12">
                    <p class="text-gray-500 text-lg">{{ __('Aucun événement à venir pour le moment.') }}</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $events->links() }}
        </div>
    </div>
</div>
@endsection
