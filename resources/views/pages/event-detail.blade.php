@extends('layouts.app')

@section('content')
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
                onerror="this.onerror=null; this.src='https://placehold.co/1920x1080/f3f4f6/64748b?text=HIT+%7C+{{ urlencode($event->type) }}'"
            >
        @endif
        
        <!-- Superposition dégradée pour améliorer la lisibilité du texte -->
        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/70 to-transparent"></div>
        
        <!-- Contenu superposé sur l'image -->
        <div class="absolute bottom-0 left-0 right-0 p-8 text-white">
            <div class="container mx-auto">
                <!-- Fil d'Ariane -->
                <nav class="flex text-sm mb-4 text-white/80">
                    <a href="{{ route('home') }}" class="hover:text-white">{{ __("Accueil") }}</a>
                    <span class="mx-2">/</span>
                    <a href="{{ route('events') }}" class="hover:text-white">{{ __("Événements") }}</a>
                    <span class="mx-2">/</span>
                    <span class="text-white/90">{{ $event->title }}</span>
                </nav>
                
                <!-- Tags -->
                <div class="flex flex-wrap items-center gap-3 mb-4">
                    <span class="text-sm font-semibold px-4 py-1.5 rounded-full bg-secondary-500 text-white">
                        {{ __($event->type) }}
                    </span>
                    <span class="text-sm font-semibold px-4 py-1.5 rounded-full {{ $event->is_remote ? 'bg-primary-500 text-white' : 'bg-orange-500 text-white' }}">
                        {{ $event->is_remote ? __("En ligne") : __("Présentiel") }}
                    </span>
                </div>
                
                <!-- Titre -->
                <h1 class="text-4xl md:text-5xl font-bold mb-4 leading-tight">
                    {{ $event->title }}
                </h1>
                
                <!-- Date et lieu -->
                <div class="flex flex-wrap items-center gap-6 text-white/90">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>{{ $event->start_date->format('d/m/Y') }} à {{ $event->start_date->format('H:i') }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>{{ $event->location }}</span>
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
                    <div class="mb-6">
                        <div class="flex items-center justify-between gap-4 mb-2">
                            <span class="text-sm font-medium text-gray-700">{{ __("Places disponibles") }}</span>
                            <span class="text-sm font-medium">
                                {{ $event->max_participants - $event->registrations_count }} / {{ $event->max_participants }}
                            </span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-primary-600 h-2 rounded-full transition-all duration-300"
                                style="width: {{ ($event->registrations_count / $event->max_participants) * 100 }}%">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Date et heure -->
                    <div class="flex items-center gap-3 text-gray-700 mb-4">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <div>
                            <p class="text-sm font-medium">{{ __("Date et heure") }}</p>
                            <p class="text-sm text-gray-500">{{ $event->start_date->format('d/m/Y') }} à {{ $event->start_date->format('H:i') }}</p>
                        </div>
                    </div>
                    
                    <!-- Lieu -->
                    <div class="flex items-center gap-3 text-gray-700 mb-4">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <div>
                            <p class="text-sm font-medium">{{ __("Lieu") }}</p>
                            <p class="text-sm text-gray-500">{{ $event->location }}</p>
                        </div>
                    </div>
                    
                    <!-- Format -->
                    <div class="flex items-center gap-3 text-gray-700 mb-6">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                        </svg>
                        <div>
                            <p class="text-sm font-medium">{{ __("Format") }}</p>
                            <p class="text-sm text-gray-500">{{ $event->is_remote ? __("En ligne") : __("Présentiel") }}</p>
                        </div>
                    </div>

                    <!-- Bouton d'inscription -->
                    @if ($event->registrations_count < $event->max_participants && now()->lt($event->registration_end_date))
                        <button
                            onclick="openEventRegistrationModal()"
                            class="w-full py-4 px-6 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-lg shadow-sm transition-colors focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 flex items-center justify-center gap-2"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            {{ __("S'inscrire maintenant") }}
                        </button>
                        
                        @if($event->phone || $event->external_link)
                            <a href="{{ $event->phone ? 'https://wa.me/'.$event->phone : $event->external_link }}" target="_blank" 
                               class="mt-3 w-full py-3 px-6 bg-gray-100 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition-colors flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ __("Plus de détails") }}
                            </a>
                        @endif
                    @else
                        <button disabled 
                            class="w-full py-4 px-6 bg-gray-200 text-gray-500 font-semibold rounded-lg cursor-not-allowed flex items-center justify-center gap-2"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            {{ __("Inscriptions fermées") }}
                        </button>
                    @endif
                    
                    <!-- Boutons de partage -->
                    <div class="mt-6">
                        <p class="text-sm font-medium text-gray-700 mb-3">{{ __("Partager cet événement") }}</p>
                        <div class="flex space-x-3">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('events.show', $event)) }}" target="_blank" 
                               class="w-10 h-10 flex items-center justify-center rounded-full bg-blue-600 text-white hover:bg-blue-700 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($event->title) }}&url={{ urlencode(route('events.show', $event)) }}" target="_blank" 
                               class="w-10 h-10 flex items-center justify-center rounded-full bg-blue-400 text-white hover:bg-blue-500 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723 10.1 10.1 0 01-3.127 1.184 4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($event->title . ' - ' . route('events.show', $event)) }}" target="_blank" 
                               class="w-10 h-10 flex items-center justify-center rounded-full bg-green-500 text-white hover:bg-green-600 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                                    <path d="M12 0C5.373 0 0 5.373 0 12c0 6.628 5.373 12 12 12 6.628 0 12-5.373 12-12 0-6.627-5.372-12-12-12zm.029 18.88a7.947 7.947 0 01-3.77-.954l-4.195 1.1 1.12-4.082a7.906 7.906 0 01-1.039-3.936c0-4.417 3.582-8 8-8s8 3.583 8 8-3.582 8-8 8z"/>
                                </svg>
                            </a>
                            <button onclick="copyEventLink('{{ route('events.show', $event) }}')" 
                                    class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-200 text-gray-600 hover:bg-gray-300 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- Modal d'inscription -->
<div id="EventRegistrationModal" class="fixed inset-0 z-[100] hidden overflow-y-auto">
    <div class="min-h-screen px-4 text-center">
        <div class="fixed inset-0 bg-gray-800 bg-opacity-75 transition-opacity"></div>
        <span class="inline-block h-screen align-middle">&#8203;</span>
        <div class="inline-block w-full max-w-md p-6 my-8 text-left align-middle transition-all transform bg-white shadow-xl rounded-lg modal-content">
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
            <form action="{{ route('events.register', $event->slug) }}" method="POST" class="space-y-5">
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
                        class="w-full flex justify-center items-center px-4 py-3 border border-transparent rounded-lg shadow-sm text-base font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors">
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
@endsection



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
