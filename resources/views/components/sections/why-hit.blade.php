<section class="py-12 sm:py-20 bg-white overflow-hidden" id="why-hit">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- En-tête de section -->
        <div class="text-center mb-12 sm:mb-16">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                {{ __("Pourquoi Hub Ivoire Tech ?") }}
            </h2>
            <p class="text-lg sm:text-xl text-gray-600 max-w-3xl mx-auto px-4">
                {{ __("Des ressources et une localisation idéale pour faciliter votre parcours entrepreneurial") }}
            </p>
        </div>

        <!-- Contenu principal -->
        <div class="grid lg:grid-cols-2 gap-8 sm:gap-12 items-end">
            <!-- Grille de points clés -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                <!-- Écosystème Dynamique -->
                <div class="bg-white rounded-xl p-4 sm:p-6 shadow-sm border transition-shadow duration-300 flex flex-col h-full">
                    <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center mb-4">
                        <i class="fas fa-users text-primary text-xl"></i>
                    </div>
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-900 mb-3">{{ __("Un écosystème dynamique") }}</h3>
                    <p class="text-gray-600 text-sm flex-grow">
                        {{ __("Rejoignez une communauté d'incubateurs, d'accélérateurs, d'investisseurs, d'experts, de mentors, de startups ambitieuses, et de porteurs d'idées prêts à changer le monde.") }}
                    </p>
                </div>

                <!-- Infrastructures Modernes -->
                <div class="bg-white rounded-xl p-4 sm:p-6 shadow-sm border transition-shadow duration-300 flex flex-col h-full">
                    <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center mb-4">
                        <i class="fas fa-building text-primary text-xl"></i>
                    </div>
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-900 mb-3">{{ __("Infrastructures Modernes") }}</h3>
                    <p class="text-gray-600 text-sm flex-grow">
                        {{ __("Des espaces de travail de haute qualité, des salles de réunion équipées, et une connexion internet ultra-rapide pour votre productivité.") }}
                    </p>
                </div>

                <!-- Accompagnement Sur-Mesure -->
                <div class="bg-white rounded-xl p-4 sm:p-6 shadow-sm border transition-shadow duration-300 flex flex-col h-full">
                    <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center mb-4">
                        <i class="fas fa-hands-helping text-primary text-xl"></i>
                    </div>
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-900 mb-3">{{ __("Accompagnement Expert") }}</h3>
                    <p class="text-gray-600 text-sm flex-grow">
                        {{ __("Des experts en résidence, des mentors expérimentés et des programmes de formation personnalisés pour votre réussite.") }}
                    </p>
                </div>

                <!-- Soutien Institutionnel -->
                <div class="bg-white rounded-xl p-4 sm:p-6 shadow-sm border transition-shadow duration-300 flex flex-col h-full">
                    <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center mb-4">
                        <i class="fas fa-shield-alt text-primary text-xl"></i>
                    </div>
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-900 mb-3">{{ __("Position Stratégique") }}</h3>
                    <p class="text-gray-600 text-sm flex-grow">
                        {{ __("Idéalement situé dans le centre de la Côte d'Ivoire, à proximité des institutions et des partenaires clés.") }}
                    </p>
                </div>
            </div>

            <!-- Image avec overlay -->
            <div class="relative rounded-xl overflow-hidden group h-[300px] sm:h-[400px] lg:h-[600px]">
                <img src="{{ asset('images/tour_postel.jpg') }}" alt="Vue extérieure de la Tour Postel 2001 à Abidjan, siège du Hub Ivoire Tech." class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </div>
        </div>

    </div>
</section>
