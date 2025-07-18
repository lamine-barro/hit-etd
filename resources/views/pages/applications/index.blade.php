<x-layouts.main>
    <x-slot:title>{{ __("Candidatures") }} - {{ config('app.name') }}</x-slot:title>
    <x-slot:metaDescription>{{ __("Rejoignez notre écosystème d'innovation et contribuez au développement entrepreneurial") }}</x-slot:metaDescription>

    <div class="bg-white">
        <!-- Header Section -->
        <div class="relative bg-gradient-to-br from-emerald-800 via-teal-700 to-cyan-800 py-16 sm:py-20 lg:py-32 overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.05"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-30"></div>
            
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <!-- Title -->
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-6">
                        {{ __("Candidatures") }}
                    </h1>
                    
                    <!-- Subtitle -->
                    <p class="text-xl sm:text-2xl text-emerald-100 max-w-3xl mx-auto">
                        {{ __("Rejoignez notre écosystème d'innovation et contribuez au développement entrepreneurial") }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Navigation par onglets -->
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10">
            <div class="bg-white rounded-t-xl shadow-xl overflow-hidden" 
                 x-data="{ activeTab: 'resident' }">
                
                <!-- Onglets -->
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex" aria-label="Candidature tabs">
                        <button @click="activeTab = 'resident'" 
                                :class="{ 'border-primary-500 text-primary-600': activeTab === 'resident', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'resident' }"
                                class="flex-1 whitespace-nowrap py-4 px-6 border-b-2 font-medium text-sm transition duration-200">
                            <div class="flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                <span>{{ __("Résident") }}</span>
                            </div>
                        </button>
                        
                        <button @click="activeTab = 'partnership'" 
                                :class="{ 'border-primary-500 text-primary-600': activeTab === 'partnership', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'partnership' }"
                                class="flex-1 whitespace-nowrap py-4 px-6 border-b-2 font-medium text-sm transition duration-200">
                            <div class="flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6m0 0v6m0-6H8m0 0V6m0 0v6m0-6V4" />
                                </svg>
                                <span>{{ __("Partenaire") }}</span>
                            </div>
                        </button>
                        
                        <button @click="activeTab = 'expert'" 
                                :class="{ 'border-primary-500 text-primary-600': activeTab === 'expert', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'expert' }"
                                class="flex-1 whitespace-nowrap py-4 px-6 border-b-2 font-medium text-sm transition duration-200">
                            <div class="flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                </svg>
                                <span>{{ __("Expert") }}</span>
                            </div>
                        </button>
                    </nav>
                </div>

                <!-- Contenu des onglets -->
                <div class="p-8">
                    
                    <!-- Résident -->
                    <div x-show="activeTab === 'resident'" 
                         x-transition:enter="transition ease-out duration-300" 
                         x-transition:enter-start="opacity-0 transform translate-y-4" 
                         x-transition:enter-end="opacity-100 transform translate-y-0">
                        <div class="text-center mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 mb-2">Devenir Résident</h2>
                            <p class="text-gray-600">Rejoignez notre communauté de résidents et accédez à nos espaces, services et opportunités.</p>
                        </div>
                        <x-forms.resident-application-form />
                    </div>

                    <!-- Partenaire -->
                    <div x-show="activeTab === 'partnership'" 
                         x-transition:enter="transition ease-out duration-300" 
                         x-transition:enter-start="opacity-0 transform translate-y-4" 
                         x-transition:enter-end="opacity-100 transform translate-y-0">
                        <div class="text-center mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 mb-2">Devenir Partenaire</h2>
                            <p class="text-gray-600">Rejoignez notre écosystème et contribuez au développement de l'innovation entrepreneuriale.</p>
                        </div>
                        <x-forms.partnership-application-form />
                    </div>

                    <!-- Expert -->
                    <div x-show="activeTab === 'expert'" 
                         x-transition:enter="transition ease-out duration-300" 
                         x-transition:enter-start="opacity-0 transform translate-y-4" 
                         x-transition:enter-end="opacity-100 transform translate-y-0">
                        <div class="text-center mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 mb-2">Devenir Expert</h2>
                            <p class="text-gray-600">Partagez votre expertise et accompagnez la prochaine génération d'entrepreneurs.</p>
                        </div>
                        <x-forms.expert-application-form />
                    </div>
                </div>
            </div>
        </div>

        <!-- Espacement pour la fin de page -->
        <div class="py-16"></div>
    </div>
</x-layouts.main> 