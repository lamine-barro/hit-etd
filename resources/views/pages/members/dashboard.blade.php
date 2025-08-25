@extends('layouts.app')

@section('content')
<div class="min-h-[calc(100vh-80px)] flex items-center justify-center px-4 py-8 sm:px-6 lg:px-8">
    <div class="w-full max-w-[420px] mx-auto">
        <!-- Card -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="px-6 py-6 text-center border-b border-gray-200 bg-gradient-to-r from-primary-600 to-primary-700">
                <h4 class="text-xl sm:text-2xl font-semibold text-white">{{ __("Espace résident") }}</h4>
            </div>

            <!-- Body -->
            <div class="px-6 py-6">
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                        <span class="block font-semibold text-red-600 mb-2">{{ __("Erreur de connexion") }}</span>
                        <ul class="list-disc list-inside text-sm text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login.send-otp') }}" class="space-y-6">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ __("Adresse e-mail") }}
                        </label>
                        <div class="relative rounded-lg border border-gray-300 shadow-sm focus-within:border-primary-500 focus-within:ring-4 focus-within:ring-primary-100 transition-all duration-200">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <input type="email" 
                                id="email" 
                                name="email" 
                                class="block w-full pl-11 pr-4 py-3 text-gray-900 placeholder-gray-400 border-0 focus:ring-0 sm:text-sm rounded-lg bg-transparent"
                                required 
                                autofocus
                                placeholder="{{ __("nom@hit.ci") }}">
                        </div>
                    </div>

                    <button type="submit" 
                        class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-gradient-to-r from-primary-600 to-primary-700 text-white text-sm font-semibold rounded-lg hover:from-primary-700 hover:to-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-100 transition-all duration-200">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        {{ __("Recevoir le code de connexion") }}
                    </button>
                </form>

                <!-- Security Info -->
                <div class="mt-8 bg-gray-50 rounded-lg border border-gray-200 p-4">
                    <div class="flex gap-3">
                        <svg class="h-6 w-6 text-primary-600 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        <div>
                            <h6 class="text-sm font-semibold text-gray-900 mb-1">{{ __("Information de sécurité") }}</h6>
                            <p class="text-sm text-gray-600">
                                {{ __("Un code de vérification sera envoyé à votre adresse e-mail pour une connexion sécurisée.") }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Help Section -->
                <div class="mt-6 pt-6 text-center border-t border-gray-200">
                    <a href="#" class="inline-flex items-center gap-2 text-sm font-medium text-primary-600 hover:text-primary-700 transition-colors duration-200">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ __("Besoin d'aide ?") }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 