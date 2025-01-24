<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- En-tête -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl">
                Actualités & Événements
            </h2>
            <p class="mt-4 text-xl text-gray-600">
                Suivez toute l'actualité du Hub Ivoire Tech et ne manquez aucun temps fort de l'écosystème.
            </p>
        </div>

        <!-- Articles mis en avant -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-16">
            <!-- Article principal -->
            <div class="relative group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                <div class="aspect-w-16 aspect-h-9">
                    <img src="{{ asset('images/news/main-event.jpg') }}" alt="Événement principal" class="object-cover w-full h-full transform group-hover:scale-105 transition duration-500">
                </div>
                <div class="p-6">
                    <div class="flex items-center text-sm text-gray-500 mb-2">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        15 Mars 2024
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">
                        <a href="#" class="hover:text-primary-600 transition duration-300">
                            Lancement de la 5ème promotion du Programme d'Accélération
                        </a>
                    </h3>
                    <p class="text-gray-600 mb-4">
                        Découvrez les 20 startups sélectionnées pour intégrer notre nouveau programme d'accélération. Une cohorte prometteuse qui illustre le dynamisme de l'écosystème tech ivoirien.
                    </p>
                    <a href="#" class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium">
                        Lire la suite
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Événements à venir -->
            <div class="space-y-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Événements à venir</h3>
                
                <!-- Événement 1 -->
                <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-lg transition duration-300">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 bg-primary-100 rounded-lg p-3 text-center">
                            <span class="block text-xl font-bold text-primary-600">20</span>
                            <span class="block text-sm text-primary-600">Mars</span>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-gray-900">Masterclass IA & Big Data</h4>
                            <p class="text-gray-600 text-sm mb-2">14:00 - 17:00 | Auditorium</p>
                            <a href="#" class="text-primary-600 hover:text-primary-700 text-sm font-medium">S'inscrire →</a>
                        </div>
                    </div>
                </div>

                <!-- Événement 2 -->
                <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-lg transition duration-300">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 bg-primary-100 rounded-lg p-3 text-center">
                            <span class="block text-xl font-bold text-primary-600">25</span>
                            <span class="block text-sm text-primary-600">Mars</span>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-gray-900">Hackathon FinTech</h4>
                            <p class="text-gray-600 text-sm mb-2">09:00 - 18:00 | Espace Innovation</p>
                            <a href="#" class="text-primary-600 hover:text-primary-700 text-sm font-medium">S'inscrire →</a>
                        </div>
                    </div>
                </div>

                <!-- Événement 3 -->
                <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-lg transition duration-300">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 bg-primary-100 rounded-lg p-3 text-center">
                            <span class="block text-xl font-bold text-primary-600">30</span>
                            <span class="block text-sm text-primary-600">Mars</span>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-gray-900">Pitch Day</h4>
                            <p class="text-gray-600 text-sm mb-2">15:00 - 18:00 | Auditorium</p>
                            <a href="#" class="text-primary-600 hover:text-primary-700 text-sm font-medium">S'inscrire →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dernières actualités -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Article 1 -->
            <article class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                <div class="aspect-w-16 aspect-h-9">
                    <img src="{{ asset('images/news/article1.jpg') }}" alt="Success Story" class="object-cover w-full h-full">
                </div>
                <div class="p-6">
                    <div class="text-sm text-gray-500 mb-2">10 Mars 2024</div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">
                        <a href="#" class="hover:text-primary-600">Success Story : PayFlex lève 2M€</a>
                    </h3>
                    <p class="text-gray-600 text-sm">Notre startup incubée spécialisée dans le paiement mobile séduit les investisseurs internationaux.</p>
                </div>
            </article>

            <!-- Article 2 -->
            <article class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                <div class="aspect-w-16 aspect-h-9">
                    <img src="{{ asset('images/news/article2.jpg') }}" alt="Partenariat" class="object-cover w-full h-full">
                </div>
                <div class="p-6">
                    <div class="text-sm text-gray-500 mb-2">8 Mars 2024</div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">
                        <a href="#" class="hover:text-primary-600">Nouveau partenariat avec Microsoft</a>
                    </h3>
                    <p class="text-gray-600 text-sm">Un programme d'accompagnement technique exclusif pour nos startups.</p>
                </div>
            </article>

            <!-- Article 3 -->
            <article class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                <div class="aspect-w-16 aspect-h-9">
                    <img src="{{ asset('images/news/article3.jpg') }}" alt="Formation" class="object-cover w-full h-full">
                </div>
                <div class="p-6">
                    <div class="text-sm text-gray-500 mb-2">5 Mars 2024</div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">
                        <a href="#" class="hover:text-primary-600">Formation : Développement Mobile</a>
                    </h3>
                    <p class="text-gray-600 text-sm">Une nouvelle session de formation intensive démarre le mois prochain.</p>
                </div>
            </article>
        </div>

        <!-- CTA -->
        <div class="mt-12 text-center">
            <a href="{{ route('news') }}" class="inline-flex items-center px-6 py-3 border border-primary-600 text-base font-medium rounded-md text-primary-600 bg-white hover:bg-primary-50 transition duration-300">
                Voir toutes les actualités
                <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>
    </div>
</section> 