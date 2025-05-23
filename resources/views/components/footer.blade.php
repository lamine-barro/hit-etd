<!-- Footer -->
<footer class="bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
        <!-- Logos Section -->
        <div class="flex flex-col sm:flex-row items-center justify-center space-y-6 sm:space-y-0 sm:space-x-8 mb-8 sm:mb-12">
            <div class="flex-shrink-0">
                <img src="{{ asset('logo_hit.png') }}" alt="Logo HIT" class="h-14 sm:h-16 w-auto rounded-lg shadow-lg">
            </div>
            <div class="flex-shrink-0">
                <img src="{{ asset('logo_civ.jpg') }}" alt="Logo Côte d'Ivoire" class="h-14 sm:h-16 w-auto rounded-lg shadow-lg">
            </div>
        </div>
        <div class="grid grid-cols-1 gap-8 sm:gap-6 md:grid-cols-2 lg:grid-cols-3">
            <!-- À propos -->
            <div class="text-center sm:text-left">
                <h3 class="text-lg font-semibold mb-4 sm:mb-6">{{ config("hit.name") }}</h3>
                <p class="text-gray-400 mb-6 text-sm sm:text-base">
                    {{ __("Hub Ivoire Tech a pour vocation d'être le plus grand Campus de Startups en Afrique. Il réunit un écosystème d'incubateurs, d'accélérateurs, d'investisseurs, d'experts et d'entrepreneurs afin de stimuler l'innovation et de transformer les idées en succès concrets sur le territoire ivoirien et au-delà.") }}
                </p>
                <div class="flex justify-center sm:justify-start space-x-6 sm:space-x-4">
                    <a href="https://web.facebook.com/profile.php?id=61568083378984" target="_blank" class="text-gray-400 hover:text-primary-500 transition-colors duration-200">
                        <span class="sr-only">Facebook</span>
                        <svg class="h-7 w-7 sm:h-6 sm:w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/>
                        </svg>
                    </a>
                    <a href="https://x.com/hub_ivoire" target="_blank" class="text-gray-400 hover:text-primary-500 transition-colors duration-200">
                        <span class="sr-only">X (Twitter)</span>
                        <svg class="h-7 w-7 sm:h-6 sm:w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                        </svg>
                    </a>
                    <a href="https://www.linkedin.com/company/hub-ivoire-tech/about/?viewAsMember=true" target="_blank" class="text-gray-400 hover:text-primary-500 transition-colors duration-200">
                        <span class="sr-only">LinkedIn</span>
                        <svg class="h-7 w-7 sm:h-6 sm:w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </a>
                    <a href="https://www.instagram.com/hub_ivoire_tech/?hl=fr%C2%B5" target="_blank" class="text-gray-400 hover:text-primary-500 transition-colors duration-200">
                        <span class="sr-only">Instagram</span>
                        <svg class="h-7 w-7 sm:h-6 sm:w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Liens rapides -->
            <div class="text-center sm:text-left">
                <h3 class="text-lg font-semibold mb-4 sm:mb-6">{{ __("Liens rapides") }}</h3>
                <ul class="space-y-3 sm:space-y-4">
                    <li>
                        <a href="#hero" target="_blank" class="text-base sm:text-sm text-gray-400 hover:text-primary-500 transition-colors duration-200 scroll-smooth">{{ __("Accueil") }}</a>
                    </li>
                    <li>
                        <a href="#services" target="_blank" class="text-base sm:text-sm text-gray-400 hover:text-primary-500 transition-colors duration-200 scroll-smooth">{{ __("Services") }}</a>
                    </li>
                    <li>
                        <a href="#campus" target="_blank" class="text-base sm:text-sm text-gray-400 hover:text-primary-500 transition-colors duration-200 scroll-smooth">{{ __("Campus") }}</a>
                    </li>
                    <li>
                        <a href="#news" target="_blank" class="text-base sm:text-sm text-gray-400 hover:text-primary-500 transition-colors duration-200 scroll-smooth">{{ __("Actualités") }}</a>
                    </li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="text-center sm:text-left">
                <h3 class="text-lg font-semibold mb-4 sm:mb-6">{{ __("Contact") }}</h3>
                <ul class="space-y-3 sm:space-y-4">
                    <li class="flex flex-col sm:flex-row items-center sm:items-start">
                        <svg class="h-7 w-7 sm:h-6 sm:w-6 text-primary-500 mb-2 sm:mb-0 sm:mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="text-base sm:text-sm text-gray-400">{{ __("Adresse") }}</span>
                    </li>
                    <li class="flex flex-col sm:flex-row items-center sm:items-center">
                        <svg class="h-7 w-7 sm:h-6 sm:w-6 text-primary-500 mb-2 sm:mb-0 sm:mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <a href="mailto:{{ config('hit.email') }}" target="_blank" class="text-base sm:text-sm text-gray-400 hover:text-primary-500 transition-colors duration-200">{{ __("Email") }}</a>
                    </li>
                    <li class="flex flex-col sm:flex-row items-center sm:items-center">
                        <svg class="h-7 w-7 sm:h-6 sm:w-6 text-primary-500 mb-2 sm:mb-0 sm:mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <a href="tel:{{ config('hit.phone') }}" target="_blank" class="text-base sm:text-sm text-gray-400 hover:text-primary-500 transition-colors duration-200">{{ __("Téléphone") }}</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Copyright -->
        <div class="mt-8 sm:mt-12 pt-6 sm:pt-8 border-t border-gray-800">
            <p class="text-center text-sm sm:text-base text-gray-400">{{ __("&copy; {year} {name}. Tous droits réservés.", ['year' => date('Y'), 'name' => config('hit.name')]) }}</p>
        </div>
    </div>
</footer>
