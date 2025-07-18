<x-layouts.main>
    <x-slot:title>{{ $event->getTranslatedAttribute('title') }} - {{ config('app.name') }}</x-slot:title>
    <x-slot:metaDescription>{{ Str::limit(strip_tags($event->getTranslatedAttribute('description')), 160) }}</x-slot:metaDescription>

    <div class="bg-white">
        <!-- Hero Section avec image -->
        @if ($event->illustration)
            <div class="relative h-96 overflow-hidden">
                <img src="{{ Str::startsWith($event->illustration, 'http') ? $event->illustration : Storage::url($event->illustration) }}" 
                     alt="{{ $event->getTranslatedAttribute('title') }}" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
                
                <!-- Badge de prix flottant -->
                <div class="absolute top-6 right-6">
                    @if ($event->is_paid)
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-lg font-bold bg-white text-gray-900 shadow-lg">
                            {{ number_format($event->getCurrentPrice(), 0, ',', ' ') }} {{ $event->currency }}
                        </span>
                    @else
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-lg font-bold bg-green-500 text-white shadow-lg">
                            {{ __("Gratuit") }}
                        </span>
                    @endif
                </div>

                <!-- Contenu hero -->
                <div class="absolute bottom-0 left-0 right-0 p-8">
                    <div class="max-w-4xl mx-auto">
                        <div class="mb-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-primary-600 text-white">
                                {{ $event->type ?? __("Événement") }}
                            </span>
                        </div>
                        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">{{ $event->getTranslatedAttribute('title') }}</h1>
                        <div class="flex flex-wrap gap-6 text-white text-lg">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ $event->start_date->format('d F Y à H:i') }}
                            </div>
                            @if($event->location)
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ $event->location }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Hero sans image -->
            <div class="bg-gradient-to-r from-primary-600 to-primary-800 py-16">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <div class="mb-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white/20 text-white">
                            {{ $event->type ?? __("Événement") }}
                        </span>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">{{ $event->getTranslatedAttribute('title') }}</h1>
                    <div class="flex flex-wrap justify-center gap-6 text-white text-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{ $event->start_date->format('d F Y à H:i') }}
                        </div>
                        @if($event->location)
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ $event->location }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        <!-- Breadcrumb -->
        <nav aria-label="Breadcrumb" class="bg-gray-50 border-b">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <ol role="list" class="flex items-center space-x-2">
                    <li>
                        <div class="flex items-center">
                            <a href="{{ route('events') }}" class="mr-2 text-sm font-medium text-gray-600 hover:text-primary-600">{{ __("Événements") }}</a>
                            <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" aria-hidden="true" class="w-4 h-5 text-gray-300">
                                <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                            </svg>
                        </div>
                    </li>
                    <li class="text-sm">
                        <span aria-current="page" class="font-medium text-gray-500">{{ $event->getTranslatedAttribute('title') }}</span>
                    </li>
                </ol>
            </div>
        </nav>

        <!-- Contenu principal -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="lg:grid lg:grid-cols-3 lg:gap-8">
                <!-- Colonne principale -->
                <div class="lg:col-span-2">
                    <!-- Description -->
                    <div class="bg-white rounded-lg border border-gray-200 p-8 mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">{{ __("À propos de cet événement") }}</h2>
                        <div class="prose prose-lg max-w-none">
                            {!! $event->getTranslatedAttribute('description') !!}
                        </div>
                    </div>

                    <!-- Informations pratiques -->
                    <div class="bg-white rounded-lg border border-gray-200 p-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">{{ __("Informations pratiques") }}</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900">{{ __("Date & Heure") }}</h4>
                                    <p class="text-gray-600">{{ $event->start_date->format('l d F Y') }}</p>
                                    <p class="text-sm text-gray-500">{{ $event->start_date->format('H:i') }} - {{ $event->end_date ? $event->end_date->format('H:i') : __('À déterminer') }}</p>
                                </div>
                            </div>

                            @if($event->location)
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0">
                                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900">{{ __("Lieu") }}</h4>
                                        <p class="text-gray-600">{{ $event->location }}</p>
                                    </div>
                                </div>
                            @endif

                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900">{{ __("Format") }}</h4>
                                    <p class="text-gray-600">{{ $event->is_remote ? __("En ligne") : __("Présentiel") }}</p>
                                </div>
                            </div>

                            @if($event->language)
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0">
                                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900">{{ __("Langue") }}</h4>
                                        <p class="text-gray-600">{{ $event->language }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="mt-8 lg:mt-0">
                    <!-- Widget d'inscription -->
                    <div class="bg-white rounded-lg border border-gray-200 p-6 sticky top-6">
                        @if($event->max_participants)
                            <div class="mb-6">
                                @php
                                    $registrations = $event->registrations()->where('status', 'confirmed')->count();
                                    $remaining = $event->max_participants - $registrations;
                                @endphp
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-sm font-medium text-gray-700">{{ __("Places disponibles") }}</span>
                                    <span class="text-sm font-bold text-gray-900">{{ $remaining }}/{{ $event->max_participants }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-primary-600 h-2.5 rounded-full transition-all duration-300" style="width: {{ ($registrations / ($event->max_participants > 0 ? $event->max_participants : 1)) * 100 }}%"></div>
                                </div>
                                @if($remaining <= 5 && $remaining > 0)
                                    <p class="text-sm text-amber-600 mt-2 font-medium">{{ __("Plus que") }} {{ $remaining }} {{ __("places disponibles !") }}</p>
                                @endif
                            </div>
                        @endif

                        @if($event->isRegistrationOpen())
                            <div class="text-center">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">{{ __("Réservez votre place") }}</h3>
                                <p class="text-gray-600 mb-4">{{ __("Rejoignez-nous pour cet événement exceptionnel") }}</p>
                                <a href="{{ route('events.register.form', ['slug' => $event->getSlug()]) }}" 
                                   class="block w-full bg-primary-600 border border-transparent rounded-lg py-3 px-4 text-center text-base font-medium text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors">
                                    {{ $event->is_paid ? __("S'inscrire") . ' - ' . number_format($event->getCurrentPrice(), 0, ',', ' ') . ' ' . $event->currency : __("S'inscrire gratuitement") }}
                                </a>
                                <p class="text-xs text-gray-500 mt-2">{{ __("Inscription sécurisée en quelques clics") }}</p>
                            </div>
                        @else
                            <div class="text-center">
                                @if($event->hasReachedCapacity())
                                    <div class="flex items-center justify-center space-x-2 p-4 bg-red-50 rounded-lg">
                                        <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v4a1 1 0 102 0V7zm-1 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="text-red-800 font-medium">{{ __("Événement complet") }}</span>
                                    </div>
                                @elseif($event->start_date->isPast())
                                    <div class="flex items-center justify-center space-x-2 p-4 bg-gray-50 rounded-lg">
                                        <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v4a1 1 0 102 0V7zm-1 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="text-gray-700 font-medium">{{ __("Événement terminé") }}</span>
                                    </div>
                                @else
                                    <div class="flex items-center justify-center space-x-2 p-4 bg-yellow-50 rounded-lg">
                                        <svg class="w-5 h-5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v4a1 1 0 102 0V7zm-1 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="text-yellow-800 font-medium">{{ __("Inscriptions fermées") }}</span>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.main> 