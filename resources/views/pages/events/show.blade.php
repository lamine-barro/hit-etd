<x-layouts.main>
    <x-slot:title>{{ $event->title }} - {{ config('app.name') }}</x-slot:title>
    <x-slot:metaDescription>{{ Str::limit(strip_tags($event->description), 160) }}</x-slot:metaDescription>

    <div class="min-h-screen bg-gray-50">
        <!-- Notifications -->
        @if (session('success'))
            <div class="fixed top-4 right-4 z-[150] bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-lg" role="alert">
                <p class="font-medium">{{ session('success') }}</p>
            </div>
        @endif

        @if (session('error'))
            <div class="fixed top-4 right-4 z-[150] bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-lg" role="alert">
                <p class="font-medium">{{ session('error') }}</p>
            </div>
        @endif

        <!-- Bannière principale avec image et superposition -->
        <div class="relative w-full h-[50vh] mt-16 overflow-hidden">
            @if ($event->illustration)
                <img
                    src="{{ Storage::url($event->illustration) }}"
                    alt="{{ $event->title }}"
                    class="w-full h-full object-cover"
                >
            @else
                <img
                    src="{{ asset('images/default-event.jpg') }}"
                    alt="{{ $event->title }}"
                    class="w-full h-full object-cover"
                    onerror="this.onerror=null; this.src='https://placehold.co/1920x1080/f3f4f6/64748b?text=HIT+%7C+{{ urlencode($event->type ?? 'Événement') }}'"
                >
            @endif

            <!-- Superposition dégradée pour améliorer la lisibilité du texte -->
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/70 to-transparent"></div>

            <!-- Contenu superposé sur l'image -->
            <div class="absolute inset-0 flex items-end">
                <div class="container mx-auto px-4 pb-8">
                    <div class="text-white">
                        <!-- Type d'événement -->
                        <div class="mb-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-primary-600 text-white">
                                {{ $event->type ?? __("Événement") }}
                            </span>
                        </div>

                        <!-- Titre de l'événement -->
                        <h1 class="text-4xl lg:text-5xl font-bold mb-4">{{ $event->title }}</h1>

                        <!-- Informations de base -->
                        <div class="flex flex-wrap gap-6 text-lg">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ $event->start_date->format('d/m/Y à H:i') }}
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
        </div>

        <!-- Contenu principal -->
        <div class="container mx-auto px-4 py-8">
            <div class="flex flex-col lg:flex-row lg:gap-8">
                <!-- Colonne principale (gauche, 65%) -->
                <div class="w-full lg:w-2/3 mb-8 lg:mb-0">
                    <!-- Contenu détaillé de l'événement -->
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                        <h2 class="text-2xl font-bold mb-4">{{ __("À propos de cet événement") }}</h2>
                        <div class="prose prose-lg max-w-none">
                            {!! $event->description !!}
                        </div>
                    </div>
                </div>

                <!-- Colonne secondaire (droite, 35%) -->
                <div class="w-full lg:w-1/3">
                    <!-- Bloc d'inscription flottant -->
                    <div class="bg-white rounded-lg shadow-sm p-6 sticky top-24">
                        <!-- Prix -->
                        <div class="mb-6">
                            @if ($event->is_paid)
                                <p class="text-3xl font-bold text-gray-900">
                                    {{ number_format($event->getCurrentPrice(), 0, ',', ' ') }}
                                    <span class="text-base font-normal text-gray-500">{{ $event->currency }}</span>
                                </p>
                            @else
                                <p class="text-2xl font-bold text-green-600">{{ __("Gratuit") }}</p>
                            @endif
                        </div>

                        <!-- Places disponibles -->
                        @if($event->max_participants)
                            @php
                                $registrations = $event->registrations()->where('status', 'confirmed')->count();
                                $remaining = $event->max_participants - $registrations;
                            @endphp
                            <div class="mb-6">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-sm font-medium text-gray-700">{{ __("Places disponibles") }}</span>
                                    <span class="text-sm text-gray-600">{{ $remaining }}/{{ $event->max_participants }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-primary-600 h-2 rounded-full" style="width: {{ ($registrations / $event->max_participants) * 100 }}%"></div>
                                </div>
                            </div>
                        @endif

                        <!-- Bouton d'inscription -->
                        @if($event->start_date->isFuture())
                            @if(!$event->max_participants || $remaining > 0)
                                <x-ui.button 
                                    variant="primary" 
                                    size="lg" 
                                    class="w-full mb-4"
                                    onclick="window.location.href='{{ route('events.register', $event) }}'"
                                >
                                    {{ __("S'inscrire maintenant") }}
                                </x-ui.button>
                            @else
                                <x-ui.button 
                                    variant="secondary" 
                                    size="lg" 
                                    class="w-full mb-4"
                                    disabled
                                >
                                    {{ __("Événement complet") }}
                                </x-ui.button>
                            @endif
                        @else
                            <x-ui.button 
                                variant="secondary" 
                                size="lg" 
                                class="w-full mb-4"
                                disabled
                            >
                                {{ __("Événement terminé") }}
                            </x-ui.button>
                        @endif

                        <!-- Informations complémentaires -->
                        <div class="space-y-3 text-sm text-gray-600">
                            @if($event->duration)
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ __("Durée") }}: {{ $event->duration }}
                                </div>
                            @endif

                            @if($event->language)
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
                                    </svg>
                                    {{ __("Langue") }}: {{ $event->language }}
                                </div>
                            @endif

                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                {{ $event->is_remote ? __("En ligne") : __("Présentiel") }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.main> 