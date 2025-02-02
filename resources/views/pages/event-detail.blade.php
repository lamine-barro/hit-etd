@extends('layouts.app')

@section('content')
<div class="bg-gray-50 py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Image de l'événement -->
            @if ($event->illustration)
                <div class="relative h-96">
                    <img src="{{ Storage::url($event->illustration) }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
                </div>
            @endif

            <div class="p-8">
                <!-- En-tête -->
                <div class="flex flex-wrap items-start justify-between gap-4 mb-6">
                    <div>
                        <div class="flex items-center gap-4 mb-4">
                            <span class="text-sm font-medium px-3 py-1 rounded {{ $event->type === 'conference' ? 'bg-blue-100 text-blue-800' : ($event->type === 'workshop' ? 'bg-green-100 text-green-800' : ($event->type === 'webinar' ? 'bg-purple-100 text-purple-800' : 'bg-yellow-100 text-yellow-800')) }}">
                                {{ __($event->type) }}
                            </span>
                            <span class="text-sm text-gray-500">
                                {{ $event->is_remote ? __('En ligne') : __('Présentiel') }}
                            </span>
                        </div>
                        <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $event->title }}</h1>
                    </div>

                    @if ($event->is_paid)
                        <div class="text-right">
                            <p class="text-2xl font-bold text-primary-600">
                                {{ number_format($event->price, 0, ',', ' ') }} {{ $event->currency }}
                            </p>
                        </div>
                    @else
                        <div class="text-right">
                            <p class="text-lg font-medium text-green-600">{{ __('Gratuit') }}</p>
                        </div>
                    @endif
                </div>

                <!-- Informations principales -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                    <div class="col-span-2">
                        <h2 class="text-2xl font-semibold text-gray-900 mb-4">{{ __('À propos') }}</h2>
                        <div class="prose max-w-none">
                            {!! nl2br(e($event->description)) !!}
                        </div>
                    </div>

                    <div class="space-y-6">
                        <!-- Date et heure -->
                        <div>
                            <h3 class="font-medium text-gray-900 mb-2">{{ __('Date et heure') }}</h3>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex items-center mb-2">
                                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>{{ $event->start_date->format('d/m/Y H:i') }}</span>
                                </div>
                                @if ($event->end_date)
                                    <div class="flex items-center text-gray-500">
                                        <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>{{ __('Jusqu\'à') }} {{ $event->end_date->format('H:i') }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Lieu -->
                        <div>
                            <h3 class="font-medium text-gray-900 mb-2">{{ __('Lieu') }}</h3>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span>{{ $event->location }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Places disponibles -->
                        <div>
                            <h3 class="font-medium text-gray-900 mb-2">{{ __('Places disponibles') }}</h3>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <span>{{ $event->registrations_count }} / {{ $event->max_participants }}</span>
                                    <span class="text-sm text-gray-500">{{ __('inscrits') }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-primary-600 h-2 rounded-full" style="width: {{ ($event->registrations_count / $event->max_participants) * 100 }}%"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Date limite d'inscription -->
                        <div>
                            <h3 class="font-medium text-gray-900 mb-2">{{ __('Date limite d\'inscription') }}</h3>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>{{ $event->registration_end_date->format('d/m/Y H:i') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Bouton d'inscription -->
                        @if ($event->registrations_count < $event->max_participants && now()->lt($event->registration_end_date))
                            <a href="#" class="block w-full text-center px-6 py-3 bg-primary-600 text-white font-medium rounded-lg hover:bg-primary-700">
                                {{ __('S\'inscrire') }}
                            </a>
                        @else
                            <button disabled class="block w-full px-6 py-3 bg-gray-300 text-gray-500 font-medium rounded-lg cursor-not-allowed">
                                {{ __('Inscriptions fermées') }}
                            </button>
                        @endif

                        <!-- Lien externe -->
                        @if ($event->external_link)
                            <a href="{{ $event->external_link }}" target="_blank" rel="noopener noreferrer" class="block w-full text-center px-6 py-3 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200">
                                {{ __('Plus d\'informations') }}
                                <svg class="inline-block w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 