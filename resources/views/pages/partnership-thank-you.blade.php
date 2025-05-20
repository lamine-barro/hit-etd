@extends('layouts.app')

@section('title', 'Merci pour votre demande de partenariat - HIT')
@section('meta_description', 'Merci pour votre demande de partenariat avec le HIT. Notre équipe va étudier votre demande et vous recontactera prochainement.')

@section('content')
<div class="min-h-screen bg-white">
    <!-- Hero Section -->
    <div class="pt-32 pb-12 bg-gradient-to-r from-primary-600 to-primary-800">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl sm:text-4xl font-bold text-white mb-4">
                {{ __('Merci pour votre demande !') }}
            </h1>
            <p class="text-xl text-white/90 max-w-2xl mx-auto">
                {{ __('Votre demande de partenariat a été enregistrée avec succès') }}
            </p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="max-w-3xl mx-auto text-center">
            <div class="bg-white rounded-xl shadow-sm border p-8 mb-8">
                <div class="flex justify-center mb-6">
                    <div class="rounded-full bg-green-100 p-3">
                        <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                </div>
                
                <h2 class="text-2xl font-bold text-gray-900 mb-4">
                    {{ __('Demande envoyée avec succès') }}
                </h2>
                
                <p class="text-gray-600 mb-6">
                    {{ __('Nous avons bien reçu votre demande de partenariat. Notre équipe va l'étudier attentivement et vous recontactera dans les plus brefs délais.') }}
                </p>
                
                <div class="border-t border-gray-200 pt-6 mt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-3">
                        {{ __('Prochaines étapes') }}
                    </h3>
                    
                    <ul class="space-y-4 text-left">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary-500 mt-1 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-600">{{ __('Notre équipe examinera votre demande sous 48 heures ouvrées') }}</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary-500 mt-1 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                            </svg>
                            <span class="text-gray-600">{{ __('Vous serez contacté par email ou téléphone pour discuter des détails') }}</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary-500 mt-1 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-600">{{ __('Une réunion pourra être planifiée pour définir les modalités du partenariat') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="{{ route('home') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-primary-700 bg-primary-100 hover:bg-primary-200 transition duration-150 ease-in-out">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    {{ __('Retour à l'accueil') }}
                </a>
                
                <a href="{{ route('events') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 transition duration-150 ease-in-out">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    {{ __('Découvrir nos événements') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
