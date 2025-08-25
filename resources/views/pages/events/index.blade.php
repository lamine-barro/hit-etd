<x-layouts.main>
    <x-slot:title>{{ __("Nos événements") }} - {{ config('app.name') }}</x-slot:title>
    
    <div class="bg-white" x-data="eventFilters()">
        <!-- Header Section -->
        <div class="relative bg-gradient-to-br from-amber-600 via-orange-600 to-red-600 py-16 sm:py-20 lg:py-32 overflow-hidden">
            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/10 via-transparent to-white/5"></div>
            
            <!-- Background Pattern -->
            <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.03"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-20"></div>
            
            <!-- Decorative Elements -->
            <div class="absolute top-20 left-10 w-24 h-24 bg-white/5 rounded-full blur-xl"></div>
            <div class="absolute bottom-20 right-10 w-32 h-32 bg-orange-400/10 rounded-full blur-2xl"></div>
            <div class="absolute top-40 right-20 w-16 h-16 bg-red-300/10 rounded-full blur-lg"></div>
            
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <!-- Title -->
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-6 drop-shadow-sm">
                        {{ __("Nos événements") }}
                    </h1>
                    
                    <!-- Subtitle -->
                    <p class="text-xl sm:text-2xl text-amber-100 max-w-3xl mx-auto opacity-90">
                        {{ __("Participez à nos événements et rencontrez l'écosystème entrepreneurial") }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Content Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16 lg:py-20">
            <!-- Filtres et recherche -->
            <div class="mb-8 flex flex-col sm:flex-row gap-4 justify-between items-center">
                <div class="flex flex-wrap gap-2">
                    <button @click="activeFilter = 'all'" 
                            :class="{ 'bg-primary-600 text-white': activeFilter === 'all', 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-50': activeFilter !== 'all' }"
                            class="px-4 py-2 rounded-lg font-medium transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                        {{ __("Tous") }}
                        <span x-text="'(' + getEventCountByStatus('all') + ')'" 
                              class="ml-1 text-sm opacity-80"></span>
                    </button>
                    <button @click="activeFilter = 'upcoming'" 
                            :class="{ 'bg-primary-600 text-white': activeFilter === 'upcoming', 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-50': activeFilter !== 'upcoming' }"
                            class="px-4 py-2 rounded-lg font-medium transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                        {{ __("À venir") }}
                        <span x-text="'(' + getEventCountByStatus('upcoming') + ')'" 
                              class="ml-1 text-sm opacity-80"></span>
                    </button>
                    <button @click="activeFilter = 'past'" 
                            :class="{ 'bg-primary-600 text-white': activeFilter === 'past', 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-50': activeFilter !== 'past' }"
                            class="px-4 py-2 rounded-lg font-medium transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                        {{ __("Passés") }}
                        <span x-text="'(' + getEventCountByStatus('past') + ')'" 
                              class="ml-1 text-sm opacity-80"></span>
                    </button>
                </div>
                
                <div class="relative">
                    <input type="text" 
                           x-model="searchQuery"
                           @input="filterEvents()"
                           placeholder="{{ __("Rechercher un événement...") }}" 
                           class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200">
                    <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <!-- Bouton clear search -->
                    <button x-show="searchQuery.length > 0" 
                            @click="searchQuery = ''; filterEvents()"
                            class="absolute right-3 top-2.5 w-5 h-5 text-gray-400 hover:text-gray-600 focus:outline-none">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Indicateur de résultats -->
            <div x-show="searchQuery.length > 0 || activeFilter !== 'all'" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 transform translate-y-2"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 class="mb-6 text-sm text-gray-600">
                <span x-text="filteredEvents.length"></span> 
                <span x-text="filteredEvents.length === 1 ? '{{ __("événement trouvé") }}' : '{{ __("événements trouvés") }}'"></span>
                <span x-show="searchQuery.length > 0">
                    {{ __("pour") }} "<span x-text="searchQuery" class="font-medium"></span>"
                </span>
            </div>

            <!-- Grille des événements -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @if(isset($events) && $events->count() > 0)
                    @foreach($events as $event)
                        <div x-show="isEventVisible({{ $loop->index }})" 
                             x-transition:enter="transition ease-out duration-300 delay-{{ $loop->index * 50 }}"
                             x-transition:enter-start="opacity-0 transform scale-95 translate-y-4"
                             x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 transform scale-100"
                             x-transition:leave-end="opacity-0 transform scale-95"
                             data-event-index="{{ $loop->index }}"
                             data-event-title="{{ strtolower($event->getTranslatedAttribute('title')) }}"
                             data-event-description="{{ strtolower(strip_tags($event->getTranslatedAttribute('description'))) }}"
                             data-event-date="{{ $event->start_date ? $event->start_date->format('Y-m-d') : '' }}"
                             data-event-status="{{ $event->start_date && $event->start_date->isPast() ? 'past' : 'upcoming' }}">
                            <x-events.card :event="$event" />
                        </div>
                    @endforeach
                @else
                    <!-- État vide par défaut -->
                    <div x-show="!hasEvents" class="col-span-full text-center py-16">
                        <svg class="mx-auto w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <h3 class="text-xl font-medium text-gray-900 mb-2">{{ __("Aucun événement pour le moment") }}</h3>
                        <p class="text-gray-600">{{ __("Revenez bientôt pour découvrir nos prochains événements !") }}</p>
                    </div>
                @endif
            </div>

            <!-- État vide pour les filtres -->
            <div x-show="hasEvents && filteredEvents.length === 0" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 class="col-span-full text-center py-16">
                <svg class="mx-auto w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <h3 class="text-xl font-medium text-gray-900 mb-2">{{ __("Aucun événement trouvé") }}</h3>
                <p class="text-gray-600 mb-4">{{ __("Essayez de modifier vos critères de recherche ou filtres.") }}</p>
                <button @click="resetFilters()" 
                        class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors duration-200">
                    {{ __("Réinitialiser les filtres") }}
                </button>
            </div>

            <!-- Pagination -->
            @if(isset($events) && $events->hasPages())
                <div class="mt-12 flex justify-center">
                    {{ $events->links() }}
                </div>
            @endif
        </div>
    </div>

    <script>
        function eventFilters() {
            return {
                activeFilter: 'all',
                searchQuery: '',
                filteredEvents: [],
                hasEvents: {{ isset($events) && $events->count() > 0 ? 'true' : 'false' }},

                init() {
                    this.filterEvents();
                },

                filterEvents() {
                    const eventElements = document.querySelectorAll('[data-event-index]');
                    this.filteredEvents = Array.from(eventElements).filter(element => {
                        // Filtre par statut
                        const eventStatus = element.dataset.eventStatus;
                        const statusMatch = this.activeFilter === 'all' || 
                                          (this.activeFilter === 'upcoming' && eventStatus === 'upcoming') ||
                                          (this.activeFilter === 'past' && eventStatus === 'past');

                        // Filtre par recherche
                        let searchMatch = true;
                        if (this.searchQuery.length > 0) {
                            const query = this.searchQuery.toLowerCase();
                            const title = element.dataset.eventTitle;
                            const description = element.dataset.eventDescription;
                            searchMatch = title.includes(query) || description.includes(query);
                        }

                        return statusMatch && searchMatch;
                    });
                },

                isEventVisible(index) {
                    const element = document.querySelector(`[data-event-index="${index}"]`);
                    if (!element) return false;
                    
                    const eventStatus = element.dataset.eventStatus;
                    const statusMatch = this.activeFilter === 'all' || 
                                      (this.activeFilter === 'upcoming' && eventStatus === 'upcoming') ||
                                      (this.activeFilter === 'past' && eventStatus === 'past');

                    let searchMatch = true;
                    if (this.searchQuery.length > 0) {
                        const query = this.searchQuery.toLowerCase();
                        const title = element.dataset.eventTitle;
                        const description = element.dataset.eventDescription;
                        searchMatch = title.includes(query) || description.includes(query);
                    }

                    return statusMatch && searchMatch;
                },

                resetFilters() {
                    this.activeFilter = 'all';
                    this.searchQuery = '';
                    this.filterEvents();
                },

                getEventCountByStatus(status) {
                    const eventElements = document.querySelectorAll('[data-event-index]');
                    return Array.from(eventElements).filter(element => {
                        const eventStatus = element.dataset.eventStatus;
                        return status === 'all' || eventStatus === status;
                    }).length;
                }
            }
        }
    </script>
</x-layouts.main> 