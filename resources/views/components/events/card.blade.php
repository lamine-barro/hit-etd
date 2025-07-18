@props(['event'])

<div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:shadow-xl hover:-translate-y-1 group border border-gray-100 h-full">
    <div class="relative">
        @if($event->illustration)
            <div class="aspect-w-16 aspect-h-9 overflow-hidden">
                <img src="{{ Illuminate\Support\Str::startsWith($event->illustration, 'http') ? $event->illustration : Storage::url($event->illustration) }}"
                    alt="{{ $event->title }}"
                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
            </div>
        @else
            <div class="aspect-w-16 aspect-h-9 bg-gradient-to-br from-primary-200 to-primary-400 flex items-center justify-center">
                <svg class="w-16 h-16 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
        @endif

        <!-- Badge de statut -->
        <div class="absolute top-4 left-4">
            @if($event->start_date->isFuture())
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    {{ __("À venir") }}
                </span>
            @elseif($event->start_date->isPast() && $event->end_date->isFuture())
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    {{ __("En cours") }}
                </span>
            @else
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                    {{ __("Terminé") }}
                </span>
            @endif
        </div>

        <!-- Badge de prix -->
        @if($event->is_paid)
            <div class="absolute top-4 right-4">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white/90 text-gray-900 backdrop-blur-sm">
                    {{ number_format($event->getCurrentPrice(), 0, ',', ' ') }} {{ $event->currency }}
                </span>
            </div>
        @else
            <div class="absolute top-4 right-4">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    {{ __("Gratuit") }}
                </span>
            </div>
        @endif
    </div>

    <div class="p-6 flex flex-col h-full">
        <!-- Date et lieu -->
        <div class="flex items-center justify-between text-sm text-gray-600 mb-3">
            <div class="flex items-center space-x-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span>{{ $event->start_date->format('d/m/Y') }}</span>
            </div>
            
            @if($event->location)
                <div class="flex items-center space-x-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="truncate">{{ Str::limit($event->location, 20) }}</span>
                </div>
            @endif
        </div>

        <!-- Titre -->
        <a href="{{ route('events.show', ['slug' => $event->getSlug()]) }}">
            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-primary-600 transition-colors duration-300 line-clamp-2">
                {{ $event->getTranslatedAttribute('title') }}
            </h3>
        </a>

        <!-- Description -->
        <p class="text-gray-600 text-sm leading-relaxed mb-4 flex-grow line-clamp-3">
            {{ Str::limit(strip_tags($event->description), 120) }}
        </p>

        <!-- Footer de la card -->
        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
            <!-- Places disponibles -->
            @if($event->max_participants)
                <div class="flex items-center space-x-1 text-sm text-gray-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span>
                        @php
                            $registrations = $event->registrations()->where('status', 'confirmed')->count();
                            $remaining = $event->max_participants - $registrations;
                        @endphp
                        {{ $remaining > 0 ? $remaining . ' ' . __("places") : __("Complet") }}
                    </span>
                </div>
            @endif

            <a href="{{ route('events.show', ['slug' => $event->getSlug()]) }}" 
               class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium text-sm transition-colors duration-300">
                {{ __("Voir détails") }}
                <svg class="w-4 h-4 ml-1 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>
    </div>
</div> 