@extends('layouts.app')

@section('content')
   <!-- Hero Section -->
   <div class="relative bg-gradient-to-br from-green-900 via-green-800 to-orange-900 text-white overflow-hidden">
    <!-- Motif de fond moderne -->
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-black opacity-30"></div>
        <div class="absolute inset-y-0 right-0 w-1/2 bg-gradient-to-l from-blue-500/20 to-transparent"></div>
        <div
            class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmZmZmYiIGZpbGwtb3BhY2l0eT0iMC4xIj48cGF0aCBkPSJNMzYgMzRjMC0yLjIgMS44LTQgNC00czQgMS44IDQgNC0xLjggNC00IDQtNC0xLjgtNC00eiIvPjxwYXRoIGQ9Ik0xNiAxNmMyLjIgMCA0IDEuOCA0IDRzLTEuOCA0LTQgNC00LTEuOC00LTQgNC0xLjgtNC00em0xNiAwYzIuMiAwIDQgMS44IDQgNHMtMS44IDQtNCA0LTQtMS44LTQtNCAxLjgtNCA0LTR6TTM2IDM0YzAtMi4yIDEuOC00IDQtNHM0IDEuOCA0IDQtMS44IDQtNCA0LTQtMS44LTQtNHoiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-40">
        </div>
    </div>

    <!-- Éléments décoratifs -->
    <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 rounded-full bg-blue-600/20 blur-3xl" aria-hidden="true">
    </div>
    <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 rounded-full bg-purple-600/20 blur-3xl"
        aria-hidden="true"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-28 relative z-10">
        <div class="text-center mt-5">
            <div class="text-center">
                <div
                    class="inline-flex items-center px-3 py-1 mb-6 text-xs font-medium tracking-wide text-green-100 uppercase bg-green-800/40 rounded-full backdrop-blur-sm border border-green-700/50">
                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                    {{ __("Nos événements") }}
                </div>

                <h1 class="text-4xl md:text-5xl font-extrabold mb-6 leading-tight">
                    <span class="block mt-1 text-transparent bg-clip-text bg-gradient-to-r from-orange-300 via-green-300 to-green-200">{{ __("Nos événements") }}</span>
                </h1>

                <p class="text-xl text-center font-light mb-8 text-green-100 leading-relaxed">
                    {{ __("Découvrez nos prochains événements et inscrivez-vous") }}
                </p>
            </div>
        </div>
    </div>

    <!-- Indicateur de défilement -->
    <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2">
        <a href="#articles-filter-form"
            class="flex flex-col items-center text-white/80 hover:text-white transition-colors duration-300"
            aria-label="Découvrir les filtres d'articles">
            <span class="text-xs font-medium mb-1">Explorer</span>
            <div class="w-8 h-12 border-2 border-white/40 rounded-full flex justify-center pt-1" aria-hidden="true">
                <div class="w-1.5 h-3 bg-white/80 rounded-full animate-bounce"></div>
            </div>
        </a>
    </div>
</div>
    <div class="bg-gray-50 py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
  
        <!-- Filtres -->
        <div class="mb-8">
            <form action="{{ route('events') }}" method="GET" class="flex flex-wrap gap-4 justify-center">
                <select name="type" class="px-4 py-2.5 rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                    <option value="">{{ __("Tous les types") }}</option>
                    <option value="conference" {{ request('type') === 'conference' ? 'selected' : '' }}>{{ __("Conférence") }}</option>
                    <option value="workshop" {{ request('type') === 'workshop' ? 'selected' : '' }}>{{ __("Atelier") }}</option>
                    <option value="webinar" {{ request('type') === 'webinar' ? 'selected' : '' }}>{{ __("Webinaire") }}</option>
                    <option value="training" {{ request('type') === 'training' ? 'selected' : '' }}>{{ __("Formation") }}</option>
                </select>

                <select name="format" class="px-4 py-2.5 rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                    <option value="">{{ __("Tous les formats") }}</option>
                    <option value="physical" {{ request('format') === 'physical' ? 'selected' : '' }}>{{ __("Présentiel") }}</option>
                    <option value="remote" {{ request('format') === 'remote' ? 'selected' : '' }}>{{ __("En ligne") }}</option>
                </select>

                <button type="submit" class="px-6 py-2.5 bg-primary-600 text-white rounded-md hover:bg-primary-700 transition duration-200">
                    {{ __("Filtrer") }}
                </button>
            </form>
        </div>

        <!-- Liste des événements -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($events as $event)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    @if ($event->illustration)
                        <img src="{{ Storage::url($event->illustration) }}" 
                             alt="{{ $event->title }}" 
                             class="w-full h-48 object-cover"
                             loading="lazy">
                    @else
                        <img src="{{ asset('images/default-event.jpg') }}" 
                             alt="{{ $event->title }}" 
                             class="w-full h-48 object-cover"
                             loading="lazy"
                             onerror="this.onerror=null; this.src='https://placehold.co/800x400/f3f4f6/64748b?text=HIT+%7C+{{ urlencode($event->type) }}'">
                    @endif

                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium px-2 py-1 rounded {{ $event->type === 'conference' ? 'bg-blue-100 text-blue-800' : ($event->type === 'workshop' ? 'bg-green-100 text-green-800' : ($event->type === 'webinar' ? 'bg-purple-100 text-purple-800' : 'bg-yellow-100 text-yellow-800')) }}">
                                {{ __($event->type) }}
                            </span>
                            <span class="text-sm text-gray-500">
                                {{ $event->is_remote ? __("En ligne") : __("Présentiel") }}
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
                                {{ $event->registrations_count }} / {{ $event->max_participants }} {{ __("inscrits") }}
                            </span>
                            <a href="{{ route('events.show', $event->slug) }}" class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700">
                                {{ __("En savoir plus") }}
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12">
                    <p class="text-gray-500 text-lg">{{ __("Aucun événement à venir pour le moment.") }}</p>
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
