@extends('layouts.app')

@section('title', __("Devenir Partenaire - HIT"))
@section('meta_description', __("Rejoignez-nous en tant que partenaire ou donateur pour soutenir l'innovation technologique en Afrique. Découvrez les différentes façons de contribuer au développement du HIT."))

@section('content')
<!-- Hero Section -->
<div class="relative bg-gradient-to-br from-green-900 via-green-800 to-orange-900 text-white overflow-hidden">
    <!-- Motif de fond moderne -->
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-black opacity-30"></div>
        <div class="absolute inset-y-0 right-0 w-1/2 bg-gradient-to-l from-blue-500/20 to-transparent"></div>
        <div
            class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmZmZmYiIGZpbGwtb3BhY2l0eT0iMC4xIj48cGF0aCBkPSJNMzYgMzRjMC0yLjIgMS44LTQgNC00czQgMS44IDQgNC0xLjggNC00IDQtNC0xLjggNC00em0xNiAwYzIuMiAwIDQgMS44IDQgNHMtMS44IDQtNCA0LTQtMS44LTQtNCA0LTQtMS44LTQtNHoiLz48cGF0aCBkPSJNMTYgMTZjMi4yIDAgNCAxLjggNCA0czEtLjggLTQgNC00LTEuOC00LTQtMS44LTQtNHoiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-40">
        </div>
    </div>

    <!-- Éléments décoratifs -->
    <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 rounded-full bg-blue-600/20 blur-3xl" aria-hidden="true">
    </div>
    <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 rounded-full bg-purple-600/20 blur-3xl"
        aria-hidden="true"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-24 sm:py-32 lg:py-40 relative z-10">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div class="text-left">
                <div
                    class="inline-flex items-center px-4 py-2 mb-6 text-xs font-medium tracking-wide text-green-100 uppercase bg-green-800/40 rounded-full backdrop-blur-sm border border-green-700/50">
                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                        </path>
                    </svg>
                    {{ __("Ensemble pour l'innovation") }}
                </div>

                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-6">
                    {{ __("Devenez notre partenaire") }}
                </h1>

                <p class="text-xl sm:text-2xl text-green-100 max-w-3xl mx-auto">
                    {{ __("Rejoignez notre écosystème d'innovation et contribuez au développement technologique en Afrique à travers un partenariat stratégique.") }}
                </p>

                <div class="flex flex-wrap gap-4 mt-8">
                    <a href="#partnership-form"
                        class="inline-flex items-center justify-center px-6 py-3 text-base font-medium text-white bg-orange-600 rounded-md shadow-md hover:bg-orange-700 transition-colors duration-300"
                        aria-label="Accéder au formulaire de demande de partenariat">
                        {{ __("Soumettre une demande") }}
                        <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                    <a href="#why-partner"
                        class="relative inline-flex items-center justify-center px-6 py-3 overflow-hidden font-medium text-white transition duration-300 ease-out border border-white/50 rounded-lg shadow-md group hover:bg-white/10"
                        aria-label="{{ __("En savoir plus sur les avantages de devenir partenaire") }}">
                        <span class="flex items-center justify-center w-full h-full">
                            {{ __("En savoir plus") }}
                            <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </span>
                    </a>
                </div>
            </div>

            <div class="hidden md:block relative">
                <div class="absolute inset-0 bg-gradient-to-t from-green-500/5 to-orange-500/5 rounded-2xl"></div>
                <div class="relative bg-gray-900 border border-gray-800 p-8 rounded-2xl shadow-xl">
                    <div class="flex justify-between items-start mb-6">
                        <div class="p-3 bg-green-600/20 rounded-lg">
                            <svg class="w-8 h-8 text-green-100" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                                </path>
                            </svg>
                        </div>
                        <div class="flex space-x-1">
                            <div class="w-3 h-3 rounded-full bg-orange-400"></div>
                            <div class="w-3 h-3 rounded-full bg-white"></div>
                            <div class="w-3 h-3 rounded-full bg-green-400"></div>
                        </div>
                    </div>

                    <h3 class="text-xl font-semibold text-white mb-4">{{ __("Types de partenariats") }}</h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <!-- Première colonne -->
                        <div
                            class="flex items-center p-3 bg-white/5 rounded-lg hover:bg-white/10 transition-colors duration-300">
                            <div class="flex-shrink-0 p-1.5 bg-green-500/20 rounded-md mr-3">
                                <svg class="w-5 h-5 text-green-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="text-sm text-white">{{ __("Donateur") }}</div>
                        </div>

                        <div
                            class="flex items-center p-3 bg-white/5 rounded-lg hover:bg-white/10 transition-colors duration-300">
                            <div class="flex-shrink-0 p-1.5 bg-orange-500/20 rounded-md mr-3">
                                <svg class="w-5 h-5 text-orange-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z">
                                    </path>
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="text-sm text-white">{{ __("Partenaire financier") }}</div>
                        </div>

                        <!-- Deuxième colonne -->
                        <div
                            class="flex items-center p-3 bg-white/5 rounded-lg hover:bg-white/10 transition-colors duration-300">
                            <div class="flex-shrink-0 p-1.5 bg-green-500/20 rounded-md mr-3">
                                <svg class="w-5 h-5 text-green-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="text-sm text-white">{{ __("Partenaire technique") }}</div>
                        </div>

                        <div
                            class="flex items-center p-3 bg-white/5 rounded-lg hover:bg-white/10 transition-colors duration-300">
                            <div class="flex-shrink-0 p-1.5 bg-orange-500/20 rounded-md mr-3">
                                <svg class="w-5 h-5 text-orange-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z">
                                    </path>
                                </svg>
                            </div>
                            <div class="text-sm text-white">{{ __("Partenaire stratégique") }}</div>
                        </div>
                    </div>

                    <div class="mt-6 pt-6 border-t border-white/10 text-center">
                        <a href="#partnership-form"
                            class="text-xs font-medium text-green-200 hover:text-white transition-colors duration-300">{{ __("Découvrir tous les types de partenariats →") }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- Main Content -->
<div class="relative bg-gradient-to-b from-gray-50 to-gray-100 py-24">
    <div class="container relative z-10 mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-xl mx-auto text-center mb-16">
            <span
                class="inline-flex items-center px-3 py-1 mb-3 text-xs font-medium tracking-wide text-green-800 uppercase bg-green-100 rounded-full">
                <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812a3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812a3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd"></path>
                </svg>
                {{ __("Nos opportunités") }}
            </span>
            <h2 id="why-partner" class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                <span class="block">{{ __("Pourquoi devenir") }}</span>
                <span class="block text-orange-600">{{ __("partenaire du HIT ?") }}</span>
            </h2>
            <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto">
                {{ __("Rejoignez un écosystème dynamique d'innovation et contribuez au développement technologique en Afrique tout en bénéficiant d'avantages exclusifs.") }}
            </p>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Types de partenariats -->
            <div class="mb-16">
                <div class="text-center mb-10">
                    <h3 class="text-2xl font-bold text-gray-900">{{ __("Types de partenariats") }}</h3>
                    <p class="mt-2 text-green-700">{{ __("Choisissez le type de partenariat qui correspond le mieux à vos objectifs") }}</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Donateur -->
                    <div
                        class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-all duration-300">
                        <div class="bg-green-600 h-2 w-full"></div>
                        <div class="p-6">
                            <div class="flex items-center mb-4">
                                <div
                                    class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-full bg-green-100 text-green-600 mr-3">
                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <h4 class="text-lg font-medium text-gray-900">{{ __("Donateur") }}</h4>
                            </div>
                            <p class="text-gray-600 mb-4">{{ __("Soutenez nos initiatives par des dons ponctuels ou réguliers pour contribuer au développement de nos programmes.") }}</p>
                            <div class="text-green-600 text-sm font-medium">{{ __("Accessible à tous") }}</div>
                        </div>
                    </div>

                    <!-- Partenaire financier -->
                    <div
                        class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-all duration-300">
                        <div class="bg-orange-600 h-2 w-full"></div>
                        <div class="p-6">
                            <div class="flex items-center mb-4">
                                <div
                                    class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-full bg-orange-100 text-orange-600 mr-3">
                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z">
                                        </path>
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <h4 class="text-lg font-medium text-gray-900">{{ __("Partenaire financier") }}</h4>
                            </div>
                            <p class="text-gray-600 mb-4">{{ __("Investissez dans notre écosystème pour soutenir l'innovation et bénéficier d'une visibilité privilégiée.") }}</p>
                            <div class="text-orange-600 text-sm font-medium">{{ __("Visibilité accrue") }}</div>
                        </div>
                    </div>

                    <!-- Partenaire technique -->
                    <div
                        class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-all duration-300">
                        <div class="bg-green-600 h-2 w-full"></div>
                        <div class="p-6">
                            <div class="flex items-center mb-4">
                                <div
                                    class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-full bg-green-100 text-green-600 mr-3">
                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <h4 class="text-lg font-medium text-gray-900">{{ __("Partenaire technique") }}</h4>
                            </div>
                            <p class="text-gray-600 mb-4">{{ __("Apportez votre expertise, vos technologies ou vos services pour enrichir notre offre et collaborer sur des projets innovants.") }}</p>
                            <div class="text-green-600 text-sm font-medium">{{ __("Échange de compétences") }}</div>
                        </div>
                    </div>

                    <!-- Partenaire stratégique -->
                    <div
                        class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-all duration-300">
                        <div class="bg-orange-600 h-2 w-full"></div>
                        <div class="p-6">
                            <div class="flex items-center mb-4">
                                <div
                                    class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-full bg-orange-100 text-orange-600 mr-3">
                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z">
                                        </path>
                                    </svg>
                                </div>
                                <h4 class="text-lg font-medium text-gray-900">{{ __("Partenaire stratégique") }}</h4>
                            </div>
                            <p class="text-gray-600 mb-4">{{ __("Établissez une relation à long terme pour développer des initiatives conjointes et créer un impact durable.") }}</p>
                            <div class="text-orange-600 text-sm font-medium">{{ __("Impact maximal") }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Formulaire de demande -->
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-sm border overflow-hidden border border-gray-100 mt-16" id="partnership-form" itemscope itemtype="https://schema.org/ContactPoint">
        <div class="bg-primary-600 px-6 py-5 text-white">
            <div class="flex items-center">
                <h3 class="text-xl font-bold">{{ __("Formulaire de demande de partenariat") }}</h3>
            </div>
            <p class="mt-2 text-white/80 text-sm">{{ __("Remplissez ce formulaire pour nous faire part de votre intérêt") }}</p>
        </div>

        <div class="p-8">
            <form id="partnership-request-form" action="{{ route('partnership.store') }}" method="POST" class="space-y-8">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Type de partenariat -->
                    <div class="md:col-span-2">
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-2">{{ __("Type de partenariat") }}</label>
                        <div class="relative">
                            <select id="type" name="type"
                                class="w-full rounded-lg border border-gray-300 bg-white py-3 px-4 pr-10 text-gray-700 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200 focus:ring-opacity-50 transition-all duration-200">
                                @foreach($partnershipTypes as $value => $label)
                                <option value="{{ $value }}" {{ old('type') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                        @error('type')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Organisation -->
                    <div class="">
                        <label for="organization_name" class="block text-sm font-medium text-gray-700 mb-2">{{ __("Nom de l'organisation") }}</label>
                        <input type="text" id="organization_name" name="organization_name"
                            value="{{ old('organization_name') }}"
                            class="w-full rounded-lg border border-gray-300 bg-white py-3 px-4 text-gray-700 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200 focus:ring-opacity-50 transition-all duration-200"
                            placeholder="{{ __("Nom de votre entreprise ou organisation") }}" autocomplete="off">
                        @error('organization_name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nom du contact -->
                    <div>
                        <label for="contact_name" class="block text-sm font-medium text-gray-700 mb-2">{{ __("Nom du contact") }}</label>
                        <input type="text" id="contact_name" name="contact_name" value="{{ old('contact_name') }}"
                            class="w-full rounded-lg border border-gray-300 bg-white py-3 px-4 text-gray-700 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200 focus:ring-opacity-50 transition-all duration-200"
                            placeholder="{{ __("Votre nom complet") }}" autocomplete="off">
                        @error('contact_name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">{{ __("Email") }}</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            class="w-full rounded-lg border border-gray-300 bg-white py-3 px-4 text-gray-700 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200 focus:ring-opacity-50 transition-all duration-200"
                            placeholder="{{ __("votre.email@exemple.com") }}" autocomplete="off">
                        @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Téléphone -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">{{ __("Téléphone") }}</label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                            class="w-full rounded-lg border border-gray-300 bg-white py-3 px-4 text-gray-700 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200 focus:ring-opacity-50 transition-all duration-200"
                            placeholder="{{ __("+XXX XX XXX XX XX") }}" autocomplete="off">
                        @error('phone')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Message -->
                    <div class="md:col-span-2">
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">{{ __("Votre message") }}</label>
                        <textarea id="message" name="message" rows="5"
                            class="w-full rounded-lg border border-gray-300 bg-white py-3 px-4 text-gray-700 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200 focus:ring-opacity-50 transition-all duration-200"
                            placeholder="{{ __("Décrivez votre intérêt et vos attentes concernant ce partenariat...") }}" autocomplete="off">{{ old('message') }}</textarea>
                        @error('message')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-8">
                    <button type="submit"
                        class="w-full bg-orange-600 hover:bg-orange-700 text-white font-medium py-3 px-6 rounded-lg transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 shadow-md flex items-center justify-center"
                        aria-label="{{ __("Soumettre ma demande de partenariat") }}">
                        <span>{{ __("Soumettre ma demande") }}</span>
                        <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Styles pour corriger la couleur bleue sur les inputs -->
<style>
    #partnership-request-form input:focus,
    #partnership-request-form textarea:focus,
    #partnership-request-form select:focus {
        outline: none !important;
        border-color: #f97316 !important; /* orange-500 */
        box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.2) !important; /* orange-500 avec opacité */
    }

    /* Supprimer l'outline bleu par défaut des navigateurs */
    #partnership-request-form input,
    #partnership-request-form textarea,
    #partnership-request-form select {
        outline: none !important;
    }
</style>

<!-- Scripts pour l'interactivité et le défilement fluide -->
<script>
    // Script pour le défilement fluide
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 100,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Script pour s'assurer que les champs du formulaire sont interactifs
    document.addEventListener('DOMContentLoaded', function() {
        const formInputs = document.querySelectorAll('#partnership-request-form input, #partnership-request-form textarea, #partnership-request-form select');

        formInputs.forEach(input => {
            // S'assurer que les champs ne sont pas en lecture seule
            input.readOnly = false;

            // Ajouter un gestionnaire d'événements pour vérifier l'interactivité
            input.addEventListener('click', function() {
                this.focus();
            });

            // Forcer la mise au point sur le premier clic
            input.addEventListener('mousedown', function() {
                this.focus();
            });
        });
    });
</script>
@endsection
