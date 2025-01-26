<section class="section bg-gradient-to-b from-gray-50 to-white py-12 sm:py-20" id="services">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- En-tête -->
        <div class="section-title text-center">
            <span class="section-subtitle text-sm sm:text-base">{{ __('Our Services') }}</span>
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mt-2">{{ __('Complete services for success') }}</h2>
            <p class="mt-4 text-base sm:text-xl max-w-2xl mx-auto text-gray-600">
                {{ __('Whatever your stage of development, we have the solution adapted to your needs.') }}
            </p>
        </div>

        <!-- Grille des services principaux -->
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3 mt-12">
            <!-- Incubation & Accélération -->
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden group">
                <div class="relative h-48 sm:h-56 overflow-hidden">
                    <img src="{{ asset('images/incubation.jpg') }}" alt="{{ __('Incubation & Acceleration') }}" 
                         class="w-full h-full object-cover transform transition duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent"></div>
                    <h3 class="absolute bottom-4 left-4 right-4 text-lg sm:text-xl font-semibold text-white transform transition duration-300 group-hover:translate-x-2">
                        {{ __('Incubation & Acceleration') }}
                    </h3>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 mb-6">
                        {{ __('Training programs, coaching, mentoring, coworking space, access to experts and our partner network.') }}
                    </p>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary-500 mt-1 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600">{{ __('6 to 12 months program') }}</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary-500 mt-1 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600">{{ __('Weekly personalized follow-up') }}</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary-500 mt-1 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600">{{ __('Expert & mentor network') }}</span>
                        </li>
                    </ul>
                    <a href="{{ route('visitez-le-campus') }}" class="inline-flex items-center justify-center w-full px-6 py-3 text-base font-medium text-primary-600 bg-transparent border-2 border-primary-500 rounded-xl hover:bg-primary-50 transition-colors duration-300">
                        {{ __('Learn more') }}
                        <svg class="w-5 h-5 ml-2 -mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Hébergement & Espaces -->
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden group">
                <div class="relative h-48 sm:h-56 overflow-hidden">
                    <img src="{{ asset('images/coworking.jpg') }}" alt="{{ __('Hosting & Spaces') }}" 
                         class="w-full h-full object-cover transform transition duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent"></div>
                    <h3 class="absolute bottom-4 left-4 right-4 text-lg sm:text-xl font-semibold text-white transform transition duration-300 group-hover:translate-x-2">
                        {{ __('Hosting & Spaces') }}
                    </h3>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 mb-6">
                        {{ __('Private offices, coworking spaces, café, equipped meeting rooms, relaxation and networking areas.') }}
                    </p>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary-500 mt-1 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600">{{ __('24/7 secure access') }}</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary-500 mt-1 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600">{{ __('High-speed fiber internet') }}</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary-500 mt-1 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600">{{ __('Services & coffee included') }}</span>
                        </li>
                    </ul>
                    <a href="{{ route('visitez-le-campus') }}" class="inline-flex items-center justify-center w-full px-6 py-3 text-base font-medium text-primary-600 bg-transparent border-2 border-primary-500 rounded-xl hover:bg-primary-50 transition-colors duration-300">
                        {{ __('Learn more') }}
                        <svg class="w-5 h-5 ml-2 -mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Fablab & Innovation -->
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden group">
                <div class="relative h-48 sm:h-56 overflow-hidden">
                    <img src="{{ asset('images/fablab.jpg') }}" alt="{{ __('Fablab & Innovation') }}" 
                         class="w-full h-full object-cover transform transition duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent"></div>
                    <h3 class="absolute bottom-4 left-4 right-4 text-lg sm:text-xl font-semibold text-white transform transition duration-300 group-hover:translate-x-2">
                        {{ __('Fablab & Innovation') }}
                    </h3>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 mb-6">
                        {{ __('Rapid prototyping, 3D printing, laser cutting, electronics and personalized technical support.') }}
                    </p>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary-500 mt-1 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600">{{ __('Cutting-edge equipment') }}</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary-500 mt-1 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600">{{ __('Advanced technical training') }}</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary-500 mt-1 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600">{{ __('Dedicated technical support') }}</span>
                        </li>
                    </ul>
                    <a href="{{ route('visitez-le-campus') }}" class="inline-flex items-center justify-center w-full px-6 py-3 text-base font-medium text-primary-600 bg-transparent border-2 border-primary-500 rounded-xl hover:bg-primary-50 transition-colors duration-300">
                        {{ __('Learn more') }}
                        <svg class="w-5 h-5 ml-2 -mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Services additionnels -->
        <div class="mt-12 sm:mt-16 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Formations -->
            <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden group">
                <div class="relative h-40 overflow-hidden">
                    <img src="{{ asset('images/formation.jpg') }}" alt="{{ __('Training & Workshops') }}" 
                         class="w-full h-full object-cover transform transition duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent"></div>
                    <h4 class="absolute bottom-4 left-4 right-4 text-lg font-semibold text-white transform transition duration-300 group-hover:translate-x-2">
                        {{ __('Training & Workshops') }}
                    </h4>
                </div>
                <div class="p-6">
                    <p class="text-gray-600">{{ __('Masterclasses, hackathons, conferences, workshops and thematic meetings to develop your skills.') }}</p>
                </div>
            </div>

            <!-- Accès Investisseurs -->
            <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden group">
                <div class="relative h-40 overflow-hidden">
                    <img src="{{ asset('images/investisseurs.jpg') }}" alt="{{ __('Investor Access') }}" 
                         class="w-full h-full object-cover transform transition duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent"></div>
                    <h4 class="absolute bottom-4 left-4 right-4 text-lg font-semibold text-white transform transition duration-300 group-hover:translate-x-2">
                        {{ __('Investor Access') }}
                    </h4>
                </div>
                <div class="p-6">
                    <p class="text-gray-600">{{ __('Connection with our network of business angels, investment funds and financial partners.') }}</p>
                </div>
            </div>

            <!-- Support Admin -->
            <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden group">
                <div class="relative h-40 overflow-hidden">
                    <img src="{{ asset('images/admin.jpg') }}" alt="{{ __('Administrative Support') }}" 
                         class="w-full h-full object-cover transform transition duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent"></div>
                    <h4 class="absolute bottom-4 left-4 right-4 text-lg font-semibold text-white transform transition duration-300 group-hover:translate-x-2">
                        {{ __('Administrative Support') }}
                    </h4>
                </div>
                <div class="p-6">
                    <p class="text-gray-600">{{ __('Support in your creation formalities, legal advice and personalized accounting support.') }}</p>
                </div>
            </div>
        </div>

        <!-- CTA -->
        <div class="mt-12 sm:mt-16 text-center">
            <a href="{{ route('visitez-le-campus') }}" class="inline-flex items-center justify-center px-8 py-4 text-lg font-medium text-white bg-primary-600 rounded-xl hover:bg-primary-700 transition-colors duration-300 transform hover:scale-105">
                {{ __('Book a visit') }}
                <svg class="w-5 h-5 ml-2 -mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>
    </div>
</section> 