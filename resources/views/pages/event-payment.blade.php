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
                <a href="{{ route('events.show', $eventRegistration->event) }}" class="text-gray-500 hover:text-gray-700">{{ $eventRegistration->event->title }}</a>
                <span class="mx-2 text-gray-400">/</span>
                <span class="text-gray-900">{{ __("Paiement") }}</span>
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
        <div class="max-w-2xl mx-auto">
            <!-- Carte de paiement -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <!-- En-tête -->
                <div class="bg-primary-600 px-6 py-4">
                    <h2 class="text-xl font-semibold text-white">{{ __("Finaliser votre inscription") }}</h2>
                </div>

                <!-- Détails de la commande -->
                <div class="p-6 space-y-6">
                    <!-- Informations de l'événement -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __("Détails de l'événement") }}</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">{{ __("Événement") }}</span>
                                <span class="text-gray-900 font-medium">{{ $eventRegistration->event->title }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">{{ __("Date") }}</span>
                                <span class="text-gray-900">{{ $eventRegistration->event->start_date->format('d/m/Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">{{ __("Lieu") }}</span>
                                <span class="text-gray-900">{{ $eventRegistration->event->location }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Informations du participant -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __("Vos informations") }}</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">{{ __("Nom") }}</span>
                                <span class="text-gray-900">{{ $eventRegistration->name }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">{{ __("Email") }}</span>
                                <span class="text-gray-900">{{ $eventRegistration->email }}</span>
                            </div>
                            @if($eventRegistration->whatsapp)
                            <div class="flex justify-between">
                                <span class="text-gray-600">{{ __("WhatsApp") }}</span>
                                <span class="text-gray-900">{{ $eventRegistration->whatsapp }}</span>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Récapitulatif du paiement -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __("Récapitulatif") }}</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">{{ __("Prix") }}</span>
                                <span class="text-gray-900 font-medium">
                                    {{ number_format($eventRegistration->event->getCurrentPrice(), 0, ',', ' ') }} {{ $eventRegistration->event->currency }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bouton de paiement -->
                <div class="px-6 py-4 bg-gray-50">
                    <button
                        onclick="initiatePayment()"
                        class="w-full flex justify-center items-center px-6 py-3 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transform transition hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2"
                    >
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        {{ __("Payer maintenant") }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function initiatePayment() {
        fetch("{{ route('payment.initiate', ['registration' => $eventRegistration->uuid]) }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                window.location.href = data.data.authorization_url;
            } else {
                alert("{{ __("Une erreur est survenue. Veuillez réessayer.") }}");
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert("{{ __("Une erreur est survenue. Veuillez réessayer.") }}");
        });
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
</script>
@endpush
