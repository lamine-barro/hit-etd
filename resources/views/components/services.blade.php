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

        <!-- Grille des services -->
        <div class="grid grid-cols-1 gap-6 sm:gap-8 md:grid-cols-2 lg:grid-cols-3 mt-8 sm:mt-12">
            <!-- Incubation & Accélération -->
            <div class="card group">
                <div class="card-image h-48 sm:h-56">
                    <div class="absolute inset-0">
                        <img src="{{ asset('images/incubation.jpg') }}" alt="Incubation & Accélération" class="w-full h-full object-cover transform transition-transform duration-700 ease-out group-hover:scale-110">
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent opacity-90 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <h3 class="absolute bottom-4 left-4 text-lg sm:text-xl font-semibold text-white transform transition duration-300 group-hover:translate-x-2">Incubation & Accélération</h3>
                </div>
                <div class="card-content p-4 sm:p-6">
                    <p class="mb-6 text-sm sm:text-base">
                        Programmes de formation, coaching, mentoring, espace de coworking, accès à des experts et à notre réseau de partenaires.
                    </p>
                    <ul class="space-y-3 text-xs sm:text-sm text-gray-600">
                        <li class="flex items-center">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-primary-500 mr-2 sm:mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span>Programme sur 6 à 12 mois</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-primary-500 mr-2 sm:mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span>Suivi personnalisé hebdomadaire</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-primary-500 mr-2 sm:mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span>Réseau d'experts & mentors</span>
                        </li>
                    </ul>
                    <div class="mt-6 sm:mt-8">
                        <a href="#campus" class="btn-secondary w-full sm:w-auto text-center">
                            En savoir plus
                            <svg class="w-4 h-4 ml-2 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Hébergement & Espaces -->
            <div class="card group">
                <div class="card-image h-48 sm:h-56">
                    <div class="absolute inset-0">
                        <img src="{{ asset('images/coworking.jpg') }}" alt="Hébergement & Espaces" class="w-full h-full object-cover transform transition-transform duration-700 ease-out group-hover:scale-110">
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent opacity-90 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <h3 class="absolute bottom-4 left-4 text-lg sm:text-xl font-semibold text-white transform transition duration-300 group-hover:translate-x-2">Hébergement & Espaces</h3>
                </div>
                <div class="card-content p-4 sm:p-6">
                    <p class="mb-6 text-sm sm:text-base">
                        Bureaux privatifs, espaces de coworking, café, salles de réunion équipées, zones de détente et de networking.
                    </p>
                    <ul class="space-y-3 text-xs sm:text-sm text-gray-600">
                        <li class="flex items-center">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-primary-500 mr-2 sm:mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span>Accès 24/7 sécurisé</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-primary-500 mr-2 sm:mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span>Internet fibre haut débit</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-primary-500 mr-2 sm:mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span>Services & café inclus</span>
                        </li>
                    </ul>
                    <div class="mt-6 sm:mt-8">
                        <a href="#campus" class="btn-secondary w-full sm:w-auto text-center">
                            En savoir plus
                            <svg class="w-4 h-4 ml-2 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Fablab & Innovation -->
            <div class="card group">
                <div class="card-image h-48 sm:h-56">
                    <div class="absolute inset-0">
                        <img src="{{ asset('images/fablab.jpg') }}" alt="Fablab & Innovation" class="w-full h-full object-cover transform transition-transform duration-700 ease-out group-hover:scale-110">
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent opacity-90 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <h3 class="absolute bottom-4 left-4 text-lg sm:text-xl font-semibold text-white transform transition duration-300 group-hover:translate-x-2">Fablab & Innovation</h3>
                </div>
                <div class="card-content p-4 sm:p-6">
                    <p class="mb-6 text-sm sm:text-base">
                        Prototypage rapide, impression 3D, découpe laser, électronique et accompagnement technique personnalisé.
                    </p>
                    <ul class="space-y-3 text-xs sm:text-sm text-gray-600">
                        <li class="flex items-center">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-primary-500 mr-2 sm:mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span>Équipements de pointe</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-primary-500 mr-2 sm:mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span>Formation technique avancée</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-primary-500 mr-2 sm:mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span>Support technique dédié</span>
                        </li>
                    </ul>
                    <div class="mt-6 sm:mt-8">
                        <a href="#campus" class="btn-secondary w-full sm:w-auto text-center">
                            En savoir plus
                            <svg class="w-4 h-4 ml-2 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Services additionnels -->
        <div class="mt-12 sm:mt-16 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 sm:gap-8">
            <!-- Formations -->
            <div class="card group">
                <div class="relative h-32 sm:h-40 overflow-hidden">
                    <div class="absolute inset-0">
                        <img src="{{ asset('images/formation.jpg') }}" alt="Formations & Ateliers" class="w-full h-full object-cover transform transition-transform duration-700 ease-out group-hover:scale-110">
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent opacity-90 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <h4 class="absolute bottom-4 left-4 text-base sm:text-lg font-semibold text-white transform transition duration-300 group-hover:translate-x-2">Formations & Ateliers</h4>
                </div>
                <div class="card-content p-4 sm:p-6">
                    <p class="text-xs sm:text-sm">Masterclasses, hackathons, conférences, workshops et rencontres thématiques pour développer vos compétences.</p>
                </div>
            </div>

            <!-- Accès Investisseurs -->
            <div class="card group">
                <div class="relative h-32 sm:h-40 overflow-hidden">
                    <div class="absolute inset-0">
                        <img src="{{ asset('images/investisseurs.jpg') }}" alt="Accès aux Investisseurs" class="w-full h-full object-cover transform transition-transform duration-700 ease-out group-hover:scale-110">
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent opacity-90 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <h4 class="absolute bottom-4 left-4 text-base sm:text-lg font-semibold text-white transform transition duration-300 group-hover:translate-x-2">Accès aux Investisseurs</h4>
                </div>
                <div class="card-content p-4 sm:p-6">
                    <p class="text-xs sm:text-sm">Mise en relation avec notre réseau de business angels, fonds d'investissement et partenaires financiers.</p>
                </div>
            </div>

            <!-- Support Admin -->
            <div class="card group">
                <div class="relative h-32 sm:h-40 overflow-hidden">
                    <div class="absolute inset-0">
                        <img src="{{ asset('images/admin.jpg') }}" alt="Support Administratif" class="w-full h-full object-cover transform transition-transform duration-700 ease-out group-hover:scale-110">
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent opacity-90 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <h4 class="absolute bottom-4 left-4 text-base sm:text-lg font-semibold text-white transform transition duration-300 group-hover:translate-x-2">Support Administratif</h4>
                </div>
                <div class="card-content p-4 sm:p-6">
                    <p class="text-xs sm:text-sm">Accompagnement dans vos formalités de création, conseils juridiques et support comptable personnalisé.</p>
                </div>
            </div>
        </div>

        <!-- CTA -->
        <div class="mt-12 sm:mt-16 text-center">
            <a href="#" class="btn-primary w-full sm:w-auto text-base sm:text-lg py-3 px-6 sm:px-8">
                Réserver une visite
                <svg class="w-5 h-5 ml-2 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>
    </div>
</section> 