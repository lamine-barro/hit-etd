@extends('layouts.app')

@section('title', 'Devenir Partenaire - HIT')
@section('meta_description', 'Rejoignez-nous en tant que partenaire ou donateur pour soutenir l\'innovation technologique en Afrique. Découvrez les différentes façons de contribuer au développement du HIT.')

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-br from-blue-900 via-indigo-800 to-purple-900 text-white overflow-hidden">
        <!-- Motif de fond moderne -->
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-black opacity-30"></div>
            <div class="absolute inset-y-0 right-0 w-1/2 bg-gradient-to-l from-blue-500/20 to-transparent"></div>
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmZmZmYiIGZpbGwtb3BhY2l0eT0iMC4xIj48cGF0aCBkPSJNMzYgMzRjMC0yLjIgMS44LTQgNC00czQgMS44IDQgNC0xLjggNC00IDQtNC0xLjgtNC00eiIvPjxwYXRoIGQ9Ik0xNiAxNmMyLjIgMCA0IDEuOCA0IDRzLTEuOCA0LTQgNC00LTEuOC00LTQgMS44LTQgNC00em0xNiAwYzIuMiAwIDQgMS44IDQgNHMtMS44IDQtNCA0LTQtMS44LTQtNCAxLjgtNCA0LTR6TTM2IDM0YzAtMi4yIDEuOC00IDQtNHM0IDEuOCA0IDQtMS44IDQtNCA0LTQtMS44LTQtNHoiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-40"></div>
        </div>
        
        <!-- Éléments décoratifs -->
        <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 rounded-full bg-blue-600/20 blur-3xl" aria-hidden="true"></div>
        <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 rounded-full bg-purple-600/20 blur-3xl" aria-hidden="true"></div>
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-28 relative z-10">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="text-left">
                    <div class="inline-flex items-center px-3 py-1 mb-6 text-xs font-medium tracking-wide text-blue-100 uppercase bg-blue-800/40 rounded-full backdrop-blur-sm border border-blue-700/50">
                        <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
                        </svg>
                        {{ __('Ensemble pour l\'innovation') }}
                    </div>
                    
                    <h1 class="text-4xl md:text-5xl font-extrabold mb-6 leading-tight">
                        <span class="block">{{ __('Devenez') }}</span>
                        <span class="block mt-1 text-transparent bg-clip-text bg-gradient-to-r from-blue-300 via-indigo-200 to-purple-200">{{ __('Partenaire du HIT') }}</span>
                    </h1>
                    
                    <p class="text-xl font-light mb-8 text-blue-100 leading-relaxed max-w-xl">
                        {{ __('Rejoignez notre écosystème d\'innovation et contribuez au développement technologique en Afrique à travers un partenariat stratégique.') }}
                    </p>
                    
                    <div class="flex flex-wrap gap-4 mt-8">
                        <a href="#partnership-form" class="relative inline-flex items-center justify-center px-6 py-3 overflow-hidden font-medium text-indigo-900 transition duration-300 ease-out bg-white rounded-lg shadow-md group hover:ring-2 hover:ring-offset-2 hover:ring-indigo-500 hover:ring-offset-indigo-200">
                            <span class="absolute inset-0 flex items-center justify-center w-full h-full text-white duration-300 -translate-x-full bg-indigo-600 group-hover:translate-x-0 ease">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </span>
                            <span class="absolute flex items-center justify-center w-full h-full text-indigo-900 transition-all duration-300 transform group-hover:translate-x-full ease">{{ __('Soumettre une demande') }}</span>
                            <span class="relative invisible">{{ __('Soumettre une demande') }}</span>
                        </a>
                        <a href="#why-partner" class="relative inline-flex items-center justify-center px-6 py-3 overflow-hidden font-medium text-white transition duration-300 ease-out border border-white/50 rounded-lg shadow-md group hover:bg-white/10">
                            <span class="flex items-center justify-center w-full h-full">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ __('En savoir plus') }}
                            </span>
                        </a>
                    </div>
                </div>
                
                <div class="hidden md:block relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/20 to-purple-500/20 rounded-2xl blur-xl"></div>
                    <div class="relative bg-gradient-to-br from-blue-900/80 to-indigo-900/80 backdrop-blur-sm border border-white/10 p-8 rounded-2xl shadow-2xl">
                        <div class="flex justify-between items-start mb-6">
                            <div class="p-3 bg-blue-600/20 rounded-lg">
                                <svg class="w-8 h-8 text-blue-100" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
                                </svg>
                            </div>
                            <div class="flex space-x-1">
                                <div class="w-3 h-3 rounded-full bg-red-400"></div>
                                <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                                <div class="w-3 h-3 rounded-full bg-green-400"></div>
                            </div>
                        </div>
                        
                        <h3 class="text-xl font-semibold text-white mb-4">Types de partenariats</h3>
                        
                        <div class="space-y-3">
                            <div class="flex items-center p-3 bg-white/5 rounded-lg hover:bg-white/10 transition-colors duration-300">
                                <div class="flex-shrink-0 p-1.5 bg-green-500/20 rounded-md mr-3">
                                    <svg class="w-5 h-5 text-green-300" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="text-sm text-blue-100">Donateur</div>
                            </div>
                            
                            <div class="flex items-center p-3 bg-white/5 rounded-lg hover:bg-white/10 transition-colors duration-300">
                                <div class="flex-shrink-0 p-1.5 bg-blue-500/20 rounded-md mr-3">
                                    <svg class="w-5 h-5 text-blue-300" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="text-sm text-blue-100">Partenaire financier</div>
                            </div>
                            
                            <div class="flex items-center p-3 bg-white/5 rounded-lg hover:bg-white/10 transition-colors duration-300">
                                <div class="flex-shrink-0 p-1.5 bg-purple-500/20 rounded-md mr-3">
                                    <svg class="w-5 h-5 text-purple-300" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="text-sm text-blue-100">Partenaire technique</div>
                            </div>
                        </div>
                        
                        <div class="mt-6 pt-6 border-t border-white/10 text-center">
                            <a href="#partnership-form" class="text-xs font-medium text-blue-200 hover:text-white transition-colors duration-300">Découvrir tous les types de partenariats →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Indicateur de défilement -->
        <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2" aria-hidden="true">
            <a href="#why-partner" class="flex flex-col items-center text-white/70 hover:text-white transition-colors duration-300">
                <span class="text-xs font-medium mb-1">Découvrir</span>
                <div class="w-8 h-12 border-2 border-white/30 rounded-full flex justify-center pt-1">
                    <div class="w-1.5 h-3 bg-white/70 rounded-full animate-bounce"></div>
                </div>
            </a>
        </div>
    </div>
    <!-- Main Content -->
    <div class="relative bg-gradient-to-b from-gray-50 to-gray-100 py-24">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiM2MzY3ZjEiIGZpbGwtb3BhY2l0eT0iMC4wMiI+PHBhdGggZD0iTTM2IDM0YzAtMi4yIDEuOC00IDQtNHM0IDEuOCA0IDQtMS44IDQtNCA0LTQtMS44LTQtNHoiLz48cGF0aCBkPSJNMTYgMTZjMi4yIDAgNCAxLjggNCA0cy0xLjggNC00IDQtNC0xLjgtNC00IDEuOC00IDQtNHptMTYgMGMyLjIgMCA0IDEuOCA0IDRzLTEuOCA0LTQgNC00LTEuOC00LTQgMS44LTQgNC00ek0zNiAzNGMwLTIuMiAxLjgtNCA0LTRzNCAxLjggNCA0LTEuOCA0LTQgNC00LTEuOC00LTR6Ii8+PC9nPjwvZz48L3N2Zz4=')] opacity-50"></div>
        
        <div class="container relative z-10 mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-xl mx-auto text-center mb-16">
                <span class="inline-flex items-center px-3 py-1 mb-3 text-xs font-medium tracking-wide text-indigo-800 uppercase bg-indigo-100 rounded-full">
                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    Nos opportunités
                </span>
                <h2 id="why-partner" class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    <span class="block">Pourquoi devenir</span>
                    <span class="block text-indigo-600">partenaire du HIT ?</span>
                </h2>
                <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto">
                    Rejoignez un écosystème dynamique d'innovation et contribuez au développement technologique en Afrique tout en bénéficiant d'avantages exclusifs.
                </p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-7xl mx-auto">
                
                <!-- Types de partenariats -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300">
                    <div class="bg-gradient-to-r from-indigo-600 to-blue-600 px-6 py-5 text-white">
                        <div class="flex items-center">
                            <span class="flex items-center justify-center w-10 h-10 rounded-full bg-white/20 mr-4">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
                                </svg>
                            </span>
                            <h3 class="text-xl font-bold">Types de partenariats</h3>
                        </div>
                        <p class="mt-2 text-blue-100 text-sm ml-14">Choisissez le type de partenariat qui correspond le mieux à vos objectifs</p>
                    </div>
                    
                    <div class="p-6">
                        <div class="grid gap-6 sm:grid-cols-2">
                            <!-- Donateur -->
                            <div class="bg-gradient-to-br from-white to-green-50 rounded-xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300 flex flex-col h-full">
                                <div class="flex items-center mb-4">
                                    <div class="flex-shrink-0 h-12 w-12 flex items-center justify-center rounded-full bg-green-100 text-green-600 mr-4">
                                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <h4 class="text-lg font-semibold text-gray-900">Donateur</h4>
                                </div>
                                <p class="text-gray-600 flex-grow">Soutenez nos initiatives par des dons ponctuels ou réguliers pour contribuer au développement de nos programmes.</p>
                                <div class="mt-4 pt-4 border-t border-gray-100">
                                    <span class="inline-flex items-center text-xs font-medium text-green-600">
                                        <svg class="mr-1.5 h-2.5 w-2.5" fill="currentColor" viewBox="0 0 8 8">
                                            <circle cx="4" cy="4" r="3" />
                                        </svg>
                                        Accessible à tous
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Partenaire financier -->
                            <div class="bg-gradient-to-br from-white to-blue-50 rounded-xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300 flex flex-col h-full">
                                <div class="flex items-center mb-4">
                                    <div class="flex-shrink-0 h-12 w-12 flex items-center justify-center rounded-full bg-blue-100 text-blue-600 mr-4">
                                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <h4 class="text-lg font-semibold text-gray-900">Partenaire financier</h4>
                                </div>
                                <p class="text-gray-600 flex-grow">Investissez dans notre écosystème pour soutenir l'innovation et bénéficier d'une visibilité privilégiée.</p>
                                <div class="mt-4 pt-4 border-t border-gray-100">
                                    <span class="inline-flex items-center text-xs font-medium text-blue-600">
                                        <svg class="mr-1.5 h-2.5 w-2.5" fill="currentColor" viewBox="0 0 8 8">
                                            <circle cx="4" cy="4" r="3" />
                                        </svg>
                                        Visibilité accrue
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Partenaire technique -->
                            <div class="bg-gradient-to-br from-white to-purple-50 rounded-xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300 flex flex-col h-full">
                                <div class="flex items-center mb-4">
                                    <div class="flex-shrink-0 h-12 w-12 flex items-center justify-center rounded-full bg-purple-100 text-purple-600 mr-4">
                                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <h4 class="text-lg font-semibold text-gray-900">Partenaire technique</h4>
                                </div>
                                <p class="text-gray-600 flex-grow">Apportez votre expertise, vos technologies ou vos services pour enrichir notre offre et collaborer sur des projets innovants.</p>
                                <div class="mt-4 pt-4 border-t border-gray-100">
                                    <span class="inline-flex items-center text-xs font-medium text-purple-600">
                                        <svg class="mr-1.5 h-2.5 w-2.5" fill="currentColor" viewBox="0 0 8 8">
                                            <circle cx="4" cy="4" r="3" />
                                        </svg>
                                        Échange de compétences
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Partenaire stratégique -->
                            <div class="bg-gradient-to-br from-white to-amber-50 rounded-xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300 flex flex-col h-full">
                                <div class="flex items-center mb-4">
                                    <div class="flex-shrink-0 h-12 w-12 flex items-center justify-center rounded-full bg-amber-100 text-amber-600 mr-4">
                                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                                        </svg>
                                    </div>
                                    <h4 class="text-lg font-semibold text-gray-900">Partenaire stratégique</h4>
                                </div>
                                <p class="text-gray-600 flex-grow">Établissez une relation à long terme pour développer des initiatives conjointes et créer un impact durable.</p>
                                <div class="mt-4 pt-4 border-t border-gray-100">
                                    <span class="inline-flex items-center text-xs font-medium text-amber-600">
                                        <svg class="mr-1.5 h-2.5 w-2.5" fill="currentColor" viewBox="0 0 8 8">
                                            <circle cx="4" cy="4" r="3" />
                                        </svg>
                                        Impact maximal
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                    <!-- Avantages -->
                    <div class="bg-white rounded-xl shadow-sm mb-4 border p-6 transition-shadow duration-300">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="w-6 h-6 text-primary-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            Avantages pour nos partenaires
                        </h3>
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-primary-500 mt-1 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-gray-700">Visibilité sur notre site web et nos supports de communication</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-primary-500 mt-1 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-gray-700">Accès privilégié à nos événements et formations</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-primary-500 mt-1 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-gray-700">Opportunités de networking avec notre réseau d'entrepreneurs</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-primary-500 mt-1 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-gray-700">Participation à nos programmes d'innovation</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-primary-500 mt-1 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-gray-700">Reconnaissance comme acteur du développement technologique en Afrique</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Témoignages -->
                    <div class="bg-white rounded-xl shadow-sm mb-4 border p-6 transition-shadow duration-300">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="w-6 h-6 text-primary-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd"></path>
                            </svg>
                            Ils nous font confiance
                        </h3>
                        <div class="space-y-5">
                            <div class="bg-gray-50 p-5 rounded-lg hover:bg-gray-100 transition-colors duration-300">
                                <p class="text-gray-600 italic">"Notre partenariat avec le HIT nous a permis de découvrir des talents exceptionnels et de développer des solutions innovantes pour notre entreprise."</p>
                                <p class="mt-3 text-sm font-medium text-gray-900">— Directeur Innovation, Entreprise Tech</p>
                            </div>
                            <div class="bg-gray-50 p-5 rounded-lg hover:bg-gray-100 transition-colors duration-300">
                                <p class="text-gray-600 italic">"En tant que donateur, je suis fier de contribuer à un projet qui façonne l'avenir technologique de l'Afrique et crée des opportunités pour la jeunesse."</p>
                                <p class="mt-3 text-sm font-medium text-gray-900">— Entrepreneur et philanthrope</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Form -->
            <div id="partnership-form">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-6">
                    Formulaire de demande
                </h2>
                <div class="bg-white rounded-xl shadow-md border p-8 hover:shadow-lg transition-shadow duration-300">
                    
                    <form action="{{ route('partnership.store') }}" method="POST" class="space-y-8">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Type de partenariat -->
                            <div class="md:col-span-2">
                                <label for="type" class="block text-sm font-semibold text-gray-800 mb-2">Type de partenariat</label>
                                <div class="relative">
                                    <select id="type" name="type" class="w-full rounded-lg border-gray-300 bg-gray-50 py-3 px-4 pr-10 text-gray-700 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-20 transition-all duration-200">
                                        @foreach($partnershipTypes as $value => $label)
                                            <option value="{{ $value }}" {{ old('type') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                                @error('type')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Organisation -->
                            <div class="md:col-span-2">
                                <label for="organization_name" class="block text-sm font-semibold text-gray-800 mb-2">Nom de l'organisation</label>
                                <div class="relative rounded-lg shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                    </div>
                                    <input type="text" id="organization_name" name="organization_name" value="{{ old('organization_name') }}" class="w-full rounded-lg border-gray-300 bg-gray-50 py-3 pl-10 pr-4 text-gray-700 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-20 transition-all duration-200" placeholder="Nom de votre entreprise ou organisation">
                                </div>
                                @error('organization_name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Nom du contact -->
                            <div>
                                <label for="contact_name" class="block text-sm font-semibold text-gray-800 mb-2">Nom du contact</label>
                                <div class="relative rounded-lg shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <input type="text" id="contact_name" name="contact_name" value="{{ old('contact_name') }}" class="w-full rounded-lg border-gray-300 bg-gray-50 py-3 pl-10 pr-4 text-gray-700 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-20 transition-all duration-200" placeholder="Votre nom complet">
                                </div>
                                @error('contact_name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-800 mb-2">Email</label>
                                <div class="relative rounded-lg shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full rounded-lg border-gray-300 bg-gray-50 py-3 pl-10 pr-4 text-gray-700 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-20 transition-all duration-200" placeholder="votre.email@exemple.com">
                                </div>
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Téléphone -->
                            <div>
                                <label for="phone" class="block text-sm font-semibold text-gray-800 mb-2">Téléphone</label>
                                <div class="relative rounded-lg shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                        </svg>
                                    </div>
                                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" class="w-full rounded-lg border-gray-300 bg-gray-50 py-3 pl-10 pr-4 text-gray-700 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-20 transition-all duration-200" placeholder="+XXX XX XXX XX XX">
                                </div>
                                @error('phone')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            

                            
                            <!-- Message -->
                            <div class="md:col-span-2">
                                <label for="message" class="block text-sm font-semibold text-gray-800 mb-2">Votre message</label>
                                <div class="relative rounded-lg shadow-sm">
                                    <textarea id="message" name="message" rows="5" class="w-full rounded-lg border-gray-300 bg-gray-50 py-3 px-4 text-gray-700 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-20 transition-all duration-200" placeholder="Décrivez votre intérêt et vos attentes concernant ce partenariat...">{{ old('message') }}</textarea>
                                </div>
                                @error('message')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="mt-8">
                            <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 shadow-md hover:shadow-lg flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                                Soumettre ma demande
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- FAQ Section -->
    <div class="bg-gray-50 py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-8 text-center">
                Questions fréquentes
            </h2>
            
            <div class="max-w-3xl mx-auto">
                <div class="space-y-8">
                    <div class="bg-white rounded-xl shadow-md border p-6 hover:shadow-lg transition-shadow duration-300">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Comment puis-je devenir partenaire du HIT ?</h3>
                        <p class="text-gray-600">Vous pouvez soumettre votre demande via le formulaire sur cette page. Notre équipe vous contactera pour discuter des modalités du partenariat.</p>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-md border p-6 hover:shadow-lg transition-shadow duration-300">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Quels sont les engagements demandés aux partenaires ?</h3>
                        <p class="text-gray-600">Les engagements varient selon le type de partenariat. Nous établissons ensemble un accord qui définit les contributions et bénéfices mutuels.</p>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-md border p-6 hover:shadow-lg transition-shadow duration-300">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Comment sont utilisés les dons ?</h3>
                        <p class="text-gray-600">Les dons sont utilisés pour financer nos programmes d'innovation, soutenir les entrepreneurs technologiques et améliorer nos infrastructures.</p>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-md border p-6 hover:shadow-lg transition-shadow duration-300">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Puis-je visiter le HIT avant de devenir partenaire ?</h3>
                        <p class="text-gray-600">Absolument ! Nous vous invitons à visiter nos locaux et à découvrir notre écosystème. Contactez-nous pour organiser une visite.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
