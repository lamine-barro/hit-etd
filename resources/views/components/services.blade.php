<section class="section bg-gradient-to-b from-gray-50 to-white py-12 sm:py-20" id="services">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- En-tête -->
        <div class="section-title text-center">
            <span class="section-subtitle text-sm sm:text-base">Nos Services</span>
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mt-2">Des services complets pour réussir</h2>
            <p class="mt-4 text-base sm:text-xl max-w-2xl mx-auto text-gray-600">
                Quel que soit votre stade de développement, nous avons la solution adaptée à vos besoins.
            </p>
        </div>

        <!-- Grille des services principaux -->
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3 mt-12">
            <!-- Incubation & Accélération -->
            <div class="bg-white rounded-2xl shadow-sm border transition-shadow duration-300 overflow-hidden group">
                <div class="relative h-48 sm:h-56 overflow-hidden">
                    <img src="{{ asset('images/incubation.jpg') }}" alt="Incubation & Accélération" 
                         class="w-full h-full object-cover transform transition duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent"></div>
                    <h3 class="absolute bottom-4 left-4 right-4 text-lg sm:text-xl font-semibold text-white transform transition duration-300 group-hover:translate-x-2">
                        Incubation & Accélération
                    </h3>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 mb-6">
                        Programmes de formation, coaching, mentorat, accès aux experts et à notre réseau de partenaires.
                    </p>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary-500 mt-1 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600">Programme de 6 à 12 mois</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary-500 mt-1 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600">Suivi personnalisé hebdomadaire</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary-500 mt-1 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600">Réseau d'experts & mentors</span>
                        </li>
                    </ul>
                    <a href="{{ route('visitez-le-campus') }}" class="inline-flex items-center justify-center w-full px-6 py-3 text-base font-medium text-primary-600 bg-transparent border-2 border-primary-500 rounded-xl hover:bg-primary-50 transition-colors duration-300">
                        En savoir plus
                        <svg class="w-5 h-5 ml-2 -mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Espaces de travail -->
            <div class="bg-white rounded-2xl shadow-sm border transition-shadow duration-300 overflow-hidden group">
                <div class="relative h-48 sm:h-56 overflow-hidden">
                    <img src="{{ asset('images/coworking.jpg') }}" alt="Espaces de travail" 
                         class="w-full h-full object-cover transform transition duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent"></div>
                    <h3 class="absolute bottom-4 left-4 right-4 text-lg sm:text-xl font-semibold text-white transform transition duration-300 group-hover:translate-x-2">
                        Espaces de travail
                    </h3>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 mb-6">
                        Bureaux privés, espaces de coworking équipés, internet haut débit, salles de réunion équipées.
                    </p>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary-500 mt-1 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600">Accès sécurisé 24/7</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary-500 mt-1 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600">Internet fibre haut débit</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary-500 mt-1 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600">Salles de réunion équipées</span>
                        </li>
                    </ul>
                    <a href="{{ route('visitez-le-campus') }}" class="inline-flex items-center justify-center w-full px-6 py-3 text-base font-medium text-primary-600 bg-transparent border-2 border-primary-500 rounded-xl hover:bg-primary-50 transition-colors duration-300">
                        En savoir plus
                        <svg class="w-5 h-5 ml-2 -mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Espaces de détente -->
            <div class="bg-white rounded-2xl shadow-sm border transition-shadow duration-300 overflow-hidden group">
                <div class="relative h-48 sm:h-56 overflow-hidden">
                    <img src="{{ asset('images/detente.jpg') }}" alt="Espaces de détente" 
                         class="w-full h-full object-cover transform transition duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent"></div>
                    <h3 class="absolute bottom-4 left-4 right-4 text-lg sm:text-xl font-semibold text-white transform transition duration-300 group-hover:translate-x-2">
                        Espaces de détente
                    </h3>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 mb-6">
                        Des espaces conviviaux pour vous détendre et favoriser les échanges informels entre entrepreneurs.
                    </p>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary-500 mt-1 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600">Salle de jeux</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary-500 mt-1 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600">Kitchenette équipée</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary-500 mt-1 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600">Cafétéria moderne</span>
                        </li>
                    </ul>
                    <a href="{{ route('visitez-le-campus') }}" class="inline-flex items-center justify-center w-full px-6 py-3 text-base font-medium text-primary-600 bg-transparent border-2 border-primary-500 rounded-xl hover:bg-primary-50 transition-colors duration-300">
                        En savoir plus
                        <svg class="w-5 h-5 ml-2 -mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Services additionnels -->
        <div class="mt-12 sm:mt-16 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Fablab & Innovation -->
            <div class="bg-white rounded-xl shadow-sm border transition-shadow duration-300 overflow-hidden group">
                <div class="relative h-40 overflow-hidden">
                    <img src="{{ asset('images/fablab.jpg') }}" alt="Fablab & Innovation" 
                         class="w-full h-full object-cover transform transition duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent"></div>
                    <h4 class="absolute bottom-4 left-4 right-4 text-lg font-semibold text-white transform transition duration-300 group-hover:translate-x-2">
                        Fablab & Innovation
                    </h4>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 mb-6">Prototypage rapide, impression 3D, découpe laser, électronique et support technique personnalisé.</p>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary-500 mt-1 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600">Équipements de pointe</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary-500 mt-1 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600">Formation technique avancée</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary-500 mt-1 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600">Support technique dédié</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Formation & Ateliers -->
            <div class="bg-white rounded-xl shadow-sm border transition-shadow duration-300 overflow-hidden group">
                <div class="relative h-40 overflow-hidden">
                    <img src="{{ asset('images/formation.jpg') }}" alt="Formation & Ateliers" 
                         class="w-full h-full object-cover transform transition duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent"></div>
                    <h4 class="absolute bottom-4 left-4 right-4 text-lg font-semibold text-white transform transition duration-300 group-hover:translate-x-2">
                        Formation & Ateliers
                    </h4>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 mb-6">Programme complet de formations et d'événements pour développer vos compétences et votre réseau.</p>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary-500 mt-1 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600">Masterclasses régulières</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary-500 mt-1 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600">Hackathons & challenges</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary-500 mt-1 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600">Conférences thématiques</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Support Administratif -->
            <div class="bg-white rounded-xl shadow-sm border transition-shadow duration-300 overflow-hidden group">
                <div class="relative h-40 overflow-hidden">
                    <img src="{{ asset('images/admin.jpg') }}" alt="Support Administratif" 
                         class="w-full h-full object-cover transform transition duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent"></div>
                    <h4 class="absolute bottom-4 left-4 right-4 text-lg font-semibold text-white transform transition duration-300 group-hover:translate-x-2">
                        Support Administratif
                    </h4>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 mb-6">Accompagnement complet dans vos démarches administratives avec le Guichet Unique de l'Administration.</p>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary-500 mt-1 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600">Création d'entreprise</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary-500 mt-1 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600">Conseils juridiques</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary-500 mt-1 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600">Support fiscal</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- CTA -->
        <div class="mt-12 sm:mt-16 text-center">
            <a href="{{ route('visitez-le-campus') }}" class="inline-flex items-center justify-center px-8 py-4 text-lg font-medium text-white bg-primary-600 rounded-xl hover:bg-primary-700 transition-colors duration-300 transform hover:scale-105">
                Réserver une visite
                <svg class="w-5 h-5 ml-2 -mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>