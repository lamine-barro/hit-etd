@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-white mt-20">
    <!-- Fil d'Ariane -->
    <div class="mt-36">
        <div class="container mx-auto px-10 py-3">
            <nav class="flex text-sm">
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-gray-700">{{ __("Accueil") }}</a>
                <span class="mx-2 text-gray-400">/</span>
                <a href="{{ route('events') }}" class="text-gray-500 hover:text-gray-700">{{ __("Événements") }}</a>
                <span class="mx-2 text-gray-400">/</span>
                <span class="text-gray-900">{{ $event->title }}</span>
            </nav>
        </div>
    </div>

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

    <!-- Contenu principal -->
    <div class="container mx-auto px-4 py-8">
        <div class="lg:grid lg:grid-cols-2 lg:gap-12">
            <!-- Colonne de gauche (Image) -->
            <div class="mb-8 lg:mb-0">
                <div class="relative rounded-2xl overflow-hidden shadow-lg">
                    @if ($event->illustration)
                        <img
                            src="{{ Storage::url($event->illustration) }}"
                            alt="{{ $event->title }}"
                            class="w-full aspect-[4/3] object-cover"
                        >
                    @else
                        <img
                            src="{{ asset('images/default-event.jpg') }}"
                            alt="{{ $event->title }}"
                            class="w-full aspect-[4/3] object-cover"
                            onerror="this.onerror=null; this.src='https://placehold.co/800x600/f3f4f6/64748b?text=HIT+%7C+{{ urlencode($event->type) }}'"
                        >
                    @endif
                </div>
            </div>

            <!-- Colonne de droite (Informations) -->
            <div class="space-y-8">
                <!-- En-tête -->
                <div>
                    <!-- Tags et Share -->
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex flex-wrap items-center gap-3">
                            <span class="text-sm font-semibold px-4 py-1.5 rounded-full bg-secondary-100 text-secondary-800">
                                {{ __($event->type) }}
                            </span>
                            <span class="text-sm font-semibold px-4 py-1.5 rounded-full {{ $event->is_remote ? 'bg-primary-100 text-primary-800' : 'bg-orange-100 text-orange-800' }}">
                                {{ $event->is_remote ? __("En ligne") : __("Présentiel") }}
                            </span>
                        </div>
                        <div class="relative" x-data="{ open: false }">
                            <button
                                @click="open = !open"
                                @click.away="open = false"
                                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 text-gray-600 hover:bg-gray-200 transition-colors"
                                title="{{ __("Partager l'événement") }}"
                            >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                            </svg>
                        </button>

                            <!-- Menu de partage -->
                            <div
                                x-show="open"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50"
                            >
                                <div class="py-1">
                                    <!-- WhatsApp -->
                                    <a href="https://wa.me/?text={{ urlencode($event->title . ' - ' . route('events.show', $event)) }}"
                                       target="_blank"
                                       class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <svg class="w-5 h-5 mr-3 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                        </svg>
                                        WhatsApp
                                    </a>

                                    <!-- Facebook -->
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('events.show', $event)) }}"
                                       target="_blank"
                                       class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <svg class="w-5 h-5 mr-3 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                        </svg>
                                        Facebook
                                    </a>

                                    <!-- Twitter/X -->
                                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($event->title) }}&url={{ urlencode(route('events.show', $event)) }}"
                                       target="_blank"
                                       class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <svg class="w-5 h-5 mr-3 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                        </svg>
                                        Twitter/X
                                    </a>

                                    <!-- Email -->
                                    <a href="mailto:?subject={{ urlencode($event->title) }}&body={{ urlencode($event->description . '\n\nPlus de détails : ' . route('events.show', $event)) }}"
                                       class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <svg class="w-5 h-5 mr-3 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                        Email
                                    </a>

                                    <!-- Copier le lien -->
                                    <button
                                        onclick="copyEventLink('{{ route('events.show', $event) }}')"
                                        class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <svg class="w-5 h-5 mr-3 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/>
                                        </svg>
                                        Copier le lien
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Titre -->
                    <h1 class="text-4xl font-bold text-gray-900 mb-6">
                        {{ $event->title }}
                    </h1>

                    <!-- Informations principales -->
                    <div class="space-y-4">
                        <!-- Description -->
                        <div class="prose prose-sm max-w-none mb-6">
                            {!! $event->description !!}
                        </div>

                        <!-- Date et heure -->
                        <div class="flex items-center gap-3 text-gray-700">
                            <div class="w-10 h-10 flex items-center justify-center rounded-full bg-primary-50">
                                <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <p>{{ $event->start_date->format('d/m/Y') }} - {{ $event->start_date->format('H:i') }}</p>
                        </div>

                        <!-- Lieu -->
                        <div class="flex items-center gap-3 text-gray-700">
                            <div class="w-10 h-10 flex items-center justify-center rounded-full bg-primary-50">
                                <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <p>{{ $event->location }}</p>
                        </div>

                        <!-- Format -->
                        <div class="flex items-center gap-3 text-gray-700">
                            <div class="w-10 h-10 flex items-center justify-center rounded-full bg-primary-50">
                                <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                </svg>
                            </div>
                            <p>{{ $event->is_remote ? __("En ligne") : __("Présentiel") }}</p>
                        </div>

                        <!-- Prix -->
                        <div class="flex items-center gap-3 text-gray-700">
                            <div class="w-10 h-10 flex items-center justify-center rounded-full bg-primary-50">
                                <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            @if ($event->is_paid)
                                <p class="text-2xl font-bold text-primary-600">
                                    {{ number_format($event->getCurrentPrice(), 0, ',', ' ') }}
                                    <span class="text-base font-normal text-gray-500">{{ $event->currency }}</span>
                                </p>
                            @else
                                <p class="text-green-600 font-medium">{{ __("Gratuit") }}</p>
                            @endif
                        </div>

                        <!-- Places disponibles -->
                        <div class="flex items-center gap-3 text-gray-700">
                            <div class="w-10 h-10 flex items-center justify-center rounded-full bg-primary-50">
                                <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between gap-4">
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-primary-600 h-2 rounded-full transition-all duration-300"
                                            style="width: {{ ($event->registrations_count / $event->max_participants) * 100 }}%">
                                        </div>
                                    </div>
                                    <span class="text-sm whitespace-nowrap">
                                        {{ $event->registrations_count }}/{{ $event->max_participants }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="flex flex-col sm:flex-row gap-4">
                    @if ($event->registrations_count < $event->max_participants && now()->lt($event->registration_end_date))
                        <button
                            onclick="openEventRegistrationModal()"
                            class="flex-1 inline-flex justify-center items-center px-6 py-3 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transform transition hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2"
                        >
                            {{ __("S'inscrire maintenant") }}
                        </button>
                        @if($event->phone || $event->external_link)
                            <a href="{{ $event->phone ? 'https://wa.me/'.$event->phone : $event->external_link }}" target="_blank" class="flex-1 inline-flex justify-center items-center px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transform transition hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-gray-200 focus:ring-offset-2">
                                {{ __("Plus de détails") }}
                            </a>
                        @endif
                    @else
                        <button disabled class="flex-1 px-6 py-3 bg-gray-200 text-gray-500 font-semibold rounded-xl cursor-not-allowed">
                            {{ __("Inscriptions fermées") }}
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal d'inscription -->
<div id="EventRegistrationModal" class="fixed inset-0 z-[100] hidden overflow-y-auto">
    <div class="min-h-screen px-4 text-center">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <span class="inline-block h-screen align-middle">&#8203;</span>
        <div class="inline-block w-full max-w-md p-6 my-8 text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl modal-content">
            <!-- En-tête du modal -->
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-semibold leading-6 text-gray-900">
                    {{ __("Inscription à l'événement") }}
                </h3>
                <button onclick="closeEventRegistrationModal()" class="text-gray-400 hover:text-gray-500 transition-colors">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Formulaire -->
            <form action="{{ route('events.register', $event->slug) }}" method="POST" class="space-y-6">
                @csrf
                <!-- Nom -->
                <div class="relative">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                        {{ __("Nom complet") }} <span class="text-red-500">*</span>
                    </label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <input type="text" name="name" id="name" required
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 sm:text-sm transition-shadow"
                            placeholder="{{ __("Entrez votre nom complet") }}">
                    </div>
                </div>

                <!-- Email -->
                <div class="relative">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                        {{ __("Email") }} <span class="text-red-500">*</span>
                    </label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <input type="email" name="email" id="email" required
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 sm:text-sm transition-shadow"
                            placeholder="{{ __("Entrez votre adresse email") }}">
                    </div>
                </div>

                <!-- WhatsApp -->
                <div class="relative">
                    <label for="whatsapp" class="block text-sm font-medium text-gray-700 mb-1">
                        {{ __("WhatsApp") }}
                    </label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <input type="text" name="whatsapp" id="whatsapp"
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 sm:text-sm transition-shadow"
                            placeholder="{{ __("Entrez votre numéro WhatsApp") }}">
                    </div>
                </div>

                <!-- Poste/Fonction -->
                <div class="relative">
                    <label for="position" class="block text-sm font-medium text-gray-700 mb-1">
                        {{ __("Poste/Fonction") }} <span class="text-red-500">*</span>
                    </label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <input type="text" name="position" id="position" required
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 sm:text-sm transition-shadow"
                            placeholder="{{ __("Votre poste ou fonction") }}">
                    </div>
                </div>

                <!-- Organisation -->
                <div class="relative">
                    <label for="organization" class="block text-sm font-medium text-gray-700 mb-1">
                        {{ __("Organisation/Entreprise") }} <span class="text-red-500">*</span>
                    </label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <input type="text" name="organization" id="organization" required
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 sm:text-sm transition-shadow"
                            placeholder="{{ __("Nom de votre organisation") }}">
                    </div>
                </div>

                <!-- Pays -->
                <div class="relative">
                    <label for="country" class="block text-sm font-medium text-gray-700 mb-1">
                        {{ __("Pays") }} <span class="text-red-500">*</span>
                    </label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.5a2.5 2.5 0 013.182 0l-6 11A2.5 2.5 0 001 17.5V9a2 2 0 012-2h5.5a2 2 0 012 2v5a2 2 0 01-2 2H1v-2c0-1.103.887-2 2-2m0-1h2a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <select name="country" id="country" required
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 sm:text-sm transition-shadow">
                            <option value="">{{ __("Sélectionnez votre pays") }}</option>
                            <option value="Côte d'Ivoire">{{ __("Côte d'Ivoire") }}</option>
                            <option value="Sénégal">{{ __("Sénégal") }}</option>
                            <option value="Cameroun">{{ __("Cameroun") }}</option>
                            <option value="Mali">{{ __("Mali") }}</option>
                            <option value="Burkina Faso">{{ __("Burkina Faso") }}</option>
                            <option value="Togo">{{ __("Togo") }}</option>
                            <option value="Bénin">{{ __("Bénin") }}</option>
                            <option value="Guinée">{{ __("Guinée") }}</option>
                            <option value="Niger">{{ __("Niger") }}</option>
                            <option value="France">{{ __("France") }}</option>
                            <option value="Autre">{{ __("Autre") }}</option>
                        </select>
                    </div>
                </div>

                <!-- Type d'acteur -->
                <div class="relative">
                    <label for="actor_type" class="block text-sm font-medium text-gray-700 mb-1">
                        {{ __("Vous êtes") }} <span class="text-red-500">*</span>
                    </label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <select name="actor_type" id="actor_type" required
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 sm:text-sm transition-shadow">
                            <option value="">{{ __("Sélectionnez votre profil") }}</option>
                            <option value="startup">{{ __("Startup / Entrepreneur") }}</option>
                            <option value="etudiant">{{ __("Étudiant") }}</option>
                            <option value="chercheur">{{ __("Chercheur / Académique") }}</option>
                            <option value="investisseur">{{ __("Investisseur") }}</option>
                            <option value="media">{{ __("Média") }}</option>
                            <option value="corporate">{{ __("Grande entreprise") }}</option>
                            <option value="service_public">{{ __("Service public") }}</option>
                            <option value="structure_accompagnement">{{ __("Structure d'accompagnement") }}</option>
                            <option value="autre">{{ __("Autre") }}</option>
                        </select>
                    </div>
                </div>

                <!-- Bouton de soumission -->
                <div class="mt-8">
                    <button type="submit"
                        class="w-full flex justify-center items-center px-4 py-3 border border-transparent rounded-xl shadow-sm text-base font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ __("S'inscrire") }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Animation d'entrée pour le modal */
    @keyframes modalFadeIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .modal-content {
        animation: modalFadeIn 0.3s ease-out;
    }

    /* Style personnalisé pour le select */
    select {
        background-image: none;
    }

    /* Effet de hover sur les inputs */
    .form-input:hover, .form-select:hover {
        border-color: #a0aec0;
    }

    /* Effet de focus amélioré */
    .form-input:focus, .form-select:focus {
        box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.15);
    }

    @keyframes fade-in-up {
        from {
            opacity: 0;
            transform: translateY(1rem);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in-up {
        animation: fade-in-up 0.3s ease-out;
    }
</style>
@endpush

@push('scripts')
<script>
    function openEventRegistrationModal() {
        document.getElementById('EventRegistrationModal').classList.remove('hidden');
    }

    function closeEventRegistrationModal() {
        document.getElementById('EventRegistrationModal').classList.add('hidden');
    }

    // Auto-hide flash messages after 3 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const flashMessages = document.querySelectorAll('[role="alert"]');
        flashMessages.forEach(function(message) {
            setTimeout(function() {
                message.style.opacity = '0';
                message.style.transition = 'opacity 0.5s ease-out';
                setTimeout(function() {
                    message.remove();
                }, 500);
            }, 3000);
        });
    });

    function copyEventLink(url) {
        navigator.clipboard.writeText(url).then(() => {
            // Afficher une notification de succès
            const notification = document.createElement('div');
            notification.className = 'fixed bottom-4 right-4 bg-gray-800 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-fade-in-up';
            notification.textContent = '{{ __("Lien copié !") }}';
            document.body.appendChild(notification);

            // Supprimer la notification après 2 secondes
            setTimeout(() => {
                notification.style.opacity = '0';
                notification.style.transition = 'opacity 0.5s ease-out';
                setTimeout(() => notification.remove(), 500);
            }, 2000);
        });
    }
</script>
@endpush
