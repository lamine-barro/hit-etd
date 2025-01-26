<!-- Navbar Container -->
<div class="fixed top-0 left-0 right-0 z-50 px-2 sm:px-4 py-2 sm:py-4" 
    x-data="{ 
        open: false
    }">
    <nav class="max-w-7xl mx-auto bg-white shadow-lg rounded-lg px-3 sm:px-6 py-2 sm:py-4">
        <div class="flex items-center justify-between">
            <!-- Logo à gauche -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="flex items-center space-x-2 p-1">
                    <img src="{{ asset('logo_hit.png') }}" alt="{{ __('messages.nav.logo_alt.hit') }}" class="h-8 sm:h-10 w-auto">
                </a>
            </div>

            <!-- Menu de navigation (centre) -->
            <div class="hidden md:flex items-center justify-center space-x-6 lg:space-x-8">
                <a href="{{ route('home') }}" class="text-sm lg:text-base text-gray-700 hover:text-primary-600 font-medium transition px-2 py-1">{{ __('Home') }}</a>
                <a href="{{ route('formations') }}" class="text-sm lg:text-base text-gray-700 hover:text-primary-600 font-medium transition px-2 py-1">{{ __('Courses') }}</a>
                <a href="{{ route('actualites') }}" class="text-sm lg:text-base text-gray-700 hover:text-primary-600 font-medium transition px-2 py-1">{{ __('News') }}</a>
                <a href="{{ route('visitez-le-campus') }}" class="text-sm lg:text-base text-gray-700 hover:text-primary-600 font-medium transition px-2 py-1">{{ __('Visit Campus') }}</a>
            </div>

            <!-- Sélecteur de langue et Logo à droite -->
            <div class="flex items-center space-x-4">
                <!-- Language Toggle Desktop -->
                <div class="hidden md:flex items-center space-x-1 border border-gray-200 rounded-lg p-1">
                    <form action="{{ route('language.switch') }}" method="POST" class="inline">
                        @csrf
                        <input type="hidden" name="lang" value="fr">
                        <button type="submit" 
                            class="px-2 py-1 text-sm font-medium rounded-md transition-colors duration-200 {{ app()->getLocale() === 'fr' ? 'bg-primary-50 text-primary-600' : 'text-gray-500 hover:text-gray-700' }}">
                            FR
                        </button>
                    </form>
                    <form action="{{ route('language.switch') }}" method="POST" class="inline">
                        @csrf
                        <input type="hidden" name="lang" value="en">
                        <button type="submit" 
                            class="px-2 py-1 text-sm font-medium rounded-md transition-colors duration-200 {{ app()->getLocale() === 'en' ? 'bg-primary-50 text-primary-600' : 'text-gray-500 hover:text-gray-700' }}">
                            EN
                        </button>
                    </form>
                </div>

                <!-- Logo CIV -->
                <div class="flex-shrink-0">
                    <img src="{{ asset('logo_civ.jpg') }}" alt="{{ __('messages.nav.logo_alt.civ') }}" class="h-8 sm:h-10 w-auto">
                </div>
            </div>

            <!-- Menu mobile (hamburger) -->
            <div class="md:hidden">
                <button type="button" 
                    @click="open = !open" 
                    class="text-gray-700 hover:text-primary-600 p-2 -mr-2 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 rounded-lg"
                    aria-expanded="false"
                    :aria-expanded="open.toString()">
                    <span class="sr-only">{{ __('messages.nav.toggle_menu') }}</span>
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
            <a href="{{ route('home') }}" class="block text-gray-700 hover:text-primary-600 font-medium transition px-2 py-2">{{ __('Home') }}</a>
            <a href="{{ route('formations') }}" class="block text-gray-700 hover:text-primary-600 font-medium transition px-2 py-2">{{ __('Courses') }}</a>
            <a href="{{ route('actualites') }}" class="block text-gray-700 hover:text-primary-600 font-medium transition px-2 py-2">{{ __('News') }}</a>
            <a href="{{ route('visitez-le-campus') }}" class="block text-gray-700 hover:text-primary-600 font-medium transition px-2 py-2">{{ __('Visit Campus') }}</a>
            
            <!-- Language Toggle Mobile -->
            <div class="flex items-center justify-center border-t border-gray-100 pt-3 mt-3">
                <div class="flex items-center space-x-1 border border-gray-200 rounded-lg p-1">
                    <form action="{{ route('language.switch') }}" method="POST" class="inline">
                        @csrf
                        <input type="hidden" name="lang" value="fr">
                        <button type="submit" 
                            class="px-3 py-1 text-sm font-medium rounded-md transition-colors duration-200 {{ app()->getLocale() === 'fr' ? 'bg-primary-50 text-primary-600' : 'text-gray-500 hover:text-gray-700' }}">
                            FR
                        </button>
                    </form>
                    <form action="{{ route('language.switch') }}" method="POST" class="inline">
                        @csrf
                        <input type="hidden" name="lang" value="en">
                        <button type="submit" 
                            class="px-3 py-1 text-sm font-medium rounded-md transition-colors duration-200 {{ app()->getLocale() === 'en' ? 'bg-primary-50 text-primary-600' : 'text-gray-500 hover:text-gray-700' }}">
                            EN
                        </button>
                    </form>
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
        if (window.innerWidth >= 768) { // md breakpoint
            const mobileMenu = document.querySelector('[x-data]').__x.$data;
            if (mobileMenu && mobileMenu.open) {
                mobileMenu.open = false;
            }
        }
    });
});
</script>
@endpush 