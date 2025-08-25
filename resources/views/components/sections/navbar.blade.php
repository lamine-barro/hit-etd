<!-- Navbar Container -->
@php
    $locale = request()->session()->get('locale', 'fr');
@endphp
<div class="fixed top-0 left-0 right-0 z-50 px-2 sm:px-4 py-2 sm:py-4"
    x-data="{
        open: false
    }">
    <nav class="max-w-7xl mx-auto bg-white shadow-lg rounded-lg px-3 sm:px-6 py-2 sm:py-4">
        <div class="flex items-center justify-between">
            <!-- Logo à gauche -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="flex items-center space-x-2 p-1">
                    <img src="{{ asset('logo_hit.png') }}" alt="{{ __("messages.nav.logo_alt.hit") }}" style="width: auto; height: 30px" class="h-8 sm:h-10 w-auto">
                </a>
            </div>

            <!-- Menu de navigation (centre) -->
            <div class="hidden md:flex items-center justify-center space-x-6 lg:space-x-8">
                <a href="{{ route('home') }}#why-hit" class="text-sm lg:text-base {{ request()->routeIs('home') ? 'text-primary-600 font-semibold' : 'text-gray-700 hover:text-primary-600' }} font-medium transition px-2 py-1">{{ __("Accueil") }}</a>
                <a href="{{ route('events') }}" class="text-sm lg:text-base {{ request()->routeIs('events*') ? 'text-primary-600 font-semibold' : 'text-gray-700 hover:text-primary-600' }} font-medium transition px-2 py-1">{{ __("Événements") }}</a>
                <a href="{{ route('actualites') }}" class="text-sm lg:text-base {{ request()->routeIs('actualites*') || request()->routeIs('blog*') ? 'text-primary-600 font-semibold' : 'text-gray-700 hover:text-primary-600' }} font-medium transition px-2 py-1">{{ __("Actualités") }}</a>
                <a href="{{ route('visitez-le-campus') }}" class="text-sm lg:text-base {{ request()->routeIs('visitez-le-campus') ? 'text-primary-600 font-semibold' : 'text-gray-700 hover:text-primary-600' }} font-medium transition px-2 py-1">{{ __("Visiter le hub") }}</a>
                <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button type="button" class="text-sm lg:text-base {{ request()->routeIs('applications*') ? 'text-primary-600 font-semibold' : 'text-gray-700 hover:text-primary-600' }} font-medium transition px-2 py-1 flex items-center gap-1" @click="open = !open">
                        {{ __("Rejoindre Hub") }}
                        <svg class="w-4 h-4 ml-1 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-transition class="absolute left-0 mt-2 w-56 bg-white border border-gray-100 rounded-lg shadow-lg z-50 py-2">
                        <a href="{{ route('applications') }}#resident" class="block px-4 py-2 text-gray-700 hover:bg-primary-50 hover:text-primary-700 transition">{{ __("Devenir Résident") }}</a>
                        <a href="{{ route('applications') }}#partnership" class="block px-4 py-2 text-gray-700 hover:bg-primary-50 hover:text-primary-700 transition">{{ __("Devenir Partenaire") }}</a>
                        <a href="{{ route('applications') }}#expert" class="block px-4 py-2 text-gray-700 hover:bg-primary-50 hover:text-primary-700 transition">{{ __("Devenir Expert") }}</a>
                    </div>
                </div>
            </div>

            <!-- Sélecteur de langue et Logo à droite -->
            <div class="flex items-center space-x-4">
                <!-- Espace membre -->
                <a href="/resident/otp-login" class="hidden md:flex items-center space-x-1 text-sm lg:text-base text-primary-600 hover:text-primary-700 font-medium transition px-3 py-1.5 border border-primary-600 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span>{{ __("Espace résident") }}</span>
                </a>

                <!-- Language Toggle Desktop -->
                <div class="hidden md:flex items-center space-x-1 border border-gray-200 rounded-lg p-1">
                    <a href="{{ route('language.switch', 'fr') }}"
                        class="px-2 py-1 text-sm font-medium rounded-md {{ $locale === 'fr' ? 'bg-primary-100 text-primary-700' : 'text-gray-500 hover:text-gray-700' }}">
                        FR
                    </a>
                    <a href="{{ route('language.switch', 'en') }}"
                        class="px-2 py-1 text-sm font-medium rounded-md {{ $locale === 'en' ? 'bg-primary-100 text-primary-700' : 'text-gray-500 hover:text-gray-700' }}">
                        EN
                    </a>
                </div>
                <!-- Logo CIV -->
                <div class="flex-shrink-0">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('logo_civ.jpg') }}" alt="{{ __("messages.nav.logo_alt.civ") }}" class="h-8 sm:h-10 w-auto">
                    </a>
                </div>
            </div>

            <!-- Menu mobile (hamburger) -->
            <div class="md:hidden">
                <button type="button"
                    @click="open = !open"
                    class="text-gray-700 hover:text-primary-600 p-2 -mr-2 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 rounded-lg"
                    aria-expanded="false"
                    :aria-expanded="open.toString()">
                    <span class="sr-only">{{ __("messages.nav.toggle_menu") }}</span>
                    <svg class="h-6 w-6" :class="{'hidden': open, 'block': !open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg class="h-6 w-6" :class="{'block': open, 'hidden': !open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <!-- Menu mobile (panel) -->
    <div class="md:hidden"
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 transform -translate-y-2"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform -translate-y-2">
        <div class="bg-white shadow-lg rounded-lg mt-2 px-4 py-3 space-y-3">
            <a href="{{ route('home') }}" class="block {{ request()->routeIs('home') ? 'text-primary-600 font-semibold' : 'text-gray-700 hover:text-primary-600' }} font-medium transition px-2 py-2">{{ __("Accueil") }}</a>
            <a href="{{ route('events') }}" class="block {{ request()->routeIs('events*') ? 'text-primary-600 font-semibold' : 'text-gray-700 hover:text-primary-600' }} font-medium transition px-2 py-2">{{ __("Événements") }}</a>
            <a href="{{ route('actualites') }}" class="block {{ request()->routeIs('actualites*') || request()->routeIs('blog*') ? 'text-primary-600 font-semibold' : 'text-gray-700 hover:text-primary-600' }} font-medium transition px-2 py-2">{{ __("Actualités") }}</a>
            <a href="{{ route('visitez-le-campus') }}" class="block {{ request()->routeIs('visitez-le-campus') ? 'text-primary-600 font-semibold' : 'text-gray-700 hover:text-primary-600' }} font-medium transition px-2 py-2">{{ __("Visiter le hub") }}</a>

            <!-- Liens de candidature (Mobile) -->
            <div class="border-t pt-3">
                <a href="{{ route('applications') }}#resident" class="block {{ request()->routeIs('applications*') && request()->fullUrl() == route('applications') . '#resident' ? 'text-primary-600 font-semibold' : 'text-gray-700 hover:text-primary-600' }} font-medium transition px-2 py-2">{{ __("Devenir Résident") }}</a>
                <a href="{{ route('applications') }}#partnership" class="block {{ request()->routeIs('applications*') && request()->fullUrl() == route('applications') . '#partnership' ? 'text-primary-600 font-semibold' : 'text-gray-700 hover:text-primary-600' }} font-medium transition px-2 py-2">{{ __("Devenir Partenaire") }}</a>
                <a href="{{ route('applications') }}#expert" class="block {{ request()->routeIs('applications*') && request()->fullUrl() == route('applications') . '#expert' ? 'text-primary-600 font-semibold' : 'text-gray-700 hover:text-primary-600' }} font-medium transition px-2 py-2">{{ __("Devenir Expert") }}</a>
            </div>

            <!-- Espace membre (Mobile) -->
            <a href="/resident/otp-login" class="flex items-center space-x-2 text-primary-600 hover:text-primary-700 font-medium transition px-2 py-2 border-t mt-3 pt-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span>{{ __("Espace résident") }}</span>
            </a>

            <!-- Language Toggle Mobile -->
            <div class="md:hidden mt-4 border-t pt-4">
                <div class="flex justify-center space-x-2">
                    <a href="{{ route('language.switch', 'fr') }}"
                        class="px-3 py-2 text-sm font-medium rounded-md {{ app()->getLocale() === 'fr' ? 'bg-primary-100 text-primary-700' : 'text-gray-500 hover:text-gray-700' }}">
                        {{ __("Français") }}
                    </a>
                    <a href="{{ route('language.switch', 'en') }}"
                        class="px-3 py-2 text-sm font-medium rounded-md {{ app()->getLocale() === 'en' ? 'bg-primary-100 text-primary-700' : 'text-gray-500 hover:text-gray-700' }}">
                        {{ __("English") }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gestion du défilement fluide pour tous les liens d'ancrage
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);

            if (targetElement) {
                // Ajout d'un offset pour tenir compte de la hauteur du navbar fixe
                const offset = 80; // Ajustez selon la hauteur de votre navbar
                const elementPosition = targetElement.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - offset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Fermeture du menu mobile lors du redimensionnement de la fenêtre
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768) {
            const navbarComponent = document.querySelector('[x-data]');
            if (navbarComponent && navbarComponent.__x && navbarComponent.__x.$data) {
                navbarComponent.__x.$data.open = false;
            }
        }
    });
});
</script>
@endpush
