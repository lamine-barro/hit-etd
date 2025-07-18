<x-layouts.main>
    <x-slot:title>{{ __("Événements") }} - {{ config('app.name') }}</x-slot:title>
    
    <div class="bg-gray-50 py-12 sm:py-16 lg:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- En-tête -->
            <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
                <h1 class="text-4xl font-bold text-gray-900 sm:text-5xl">{{ __("Nos Événements") }}</h1>
                <p class="mt-4 text-xl text-gray-600">
                    {{ __("Participez à nos événements et rencontrez l'écosystème entrepreneurial") }}
                </p>
            </div>

            <!-- Filtres et recherche -->
            <div class="mb-8 flex flex-col sm:flex-row gap-4 justify-between items-center">
                <div class="flex flex-wrap gap-2">
                    <button class="px-4 py-2 bg-primary-600 text-white rounded-lg font-medium">
                        {{ __("Tous") }}
                    </button>
                    <button class="px-4 py-2 bg-white text-gray-700 border border-gray-300 rounded-lg font-medium hover:bg-gray-50">
                        {{ __("À venir") }}
                    </button>
                    <button class="px-4 py-2 bg-white text-gray-700 border border-gray-300 rounded-lg font-medium hover:bg-gray-50">
                        {{ __("Passés") }}
                    </button>
                </div>
                
                <div class="relative">
                    <input type="text" placeholder="{{ __("Rechercher un événement...") }}" 
                           class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>

            <!-- Grille des événements -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @if(isset($events) && $events->count() > 0)
                    @foreach($events as $event)
                        <x-events.card :event="$event" />
                    @endforeach
                @else
                    <!-- État vide -->
                    <div class="col-span-full text-center py-16">
                        <svg class="mx-auto w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <h3 class="text-xl font-medium text-gray-900 mb-2">{{ __("Aucun événement pour le moment") }}</h3>
                        <p class="text-gray-600">{{ __("Revenez bientôt pour découvrir nos prochains événements !") }}</p>
                    </div>
                @endif
            </div>

            <!-- Pagination -->
            @if(isset($events) && $events->hasPages())
                <div class="mt-12 flex justify-center">
                    {{ $events->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Newsletter Section -->
    <x-sections.newsletter />
</x-layouts.main> 