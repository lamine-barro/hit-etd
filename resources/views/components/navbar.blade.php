<!-- Navbar Container -->
<div class="fixed top-0 left-0 right-0 z-50 px-2 sm:px-4 py-2 sm:py-4" x-data="{ open: false }">
    <nav class="max-w-7xl mx-auto bg-white shadow-lg rounded-lg px-3 sm:px-6 py-2 sm:py-4">
        <div class="flex items-center justify-between">
            <!-- Logo à gauche -->
            <div class="flex-shrink-0">
                <a href="#hero" class="flex items-center space-x-2 scroll-smooth p-1">
                    <img src="{{ asset('logo_hit.png') }}" alt="Logo HIT" class="h-8 sm:h-10 w-auto">
                </a>
            </div>

            <!-- Menu de navigation (centre) -->
            <div class="hidden md:flex items-center justify-center space-x-6 lg:space-x-8">
                <a href="#why-hit" class="text-sm lg:text-base text-gray-700 hover:text-primary-600 font-medium transition scroll-smooth px-2 py-1">Présentation</a>
                <a href="#news" class="text-sm lg:text-base text-gray-700 hover:text-primary-600 font-medium transition scroll-smooth px-2 py-1">Actualités</a>
                <a href="#services" class="text-sm lg:text-base text-gray-700 hover:text-primary-600 font-medium transition scroll-smooth px-2 py-1">Services</a>
                <a href="#campus" class="text-sm lg:text-base text-gray-700 hover:text-primary-600 font-medium transition scroll-smooth px-2 py-1">Visitez le Campus</a>
            </div>

            <!-- Logo à droite -->
            <div class="flex-shrink-0">
                <img src="{{ asset('logo_civ.jpg') }}" alt="Logo Côte d'Ivoire" class="h-8 sm:h-10 w-auto">
            </div>

            <!-- Menu mobile (hamburger) -->
            <div class="md:hidden">
                <button type="button" 
                    @click="open = !open" 
                    class="text-gray-700 hover:text-primary-600 p-2 -mr-2 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 rounded-lg"
                    aria-expanded="false"
                    :aria-expanded="open.toString()">
                    <span class="sr-only">Ouvrir le menu</span>
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
        x-transition:leave-end="opacity-0 transform -translate-y-2"
        @click.away="open = false"
        @keydown.escape.window="open = false">
        <div class="bg-white shadow-lg rounded-lg mt-2 py-2 border border-gray-100">
            <a href="#hero" 
                @click="open = false" 
                class="block px-4 py-3 text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-gray-50 transition scroll-smooth active:bg-gray-100">
                Présentation
            </a>
            <a href="#news" 
                @click="open = false" 
                class="block px-4 py-3 text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-gray-50 transition scroll-smooth active:bg-gray-100">
                Actualités
            </a>
            <a href="#services" 
                @click="open = false" 
                class="block px-4 py-3 text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-gray-50 transition scroll-smooth active:bg-gray-100">
                Services
            </a>
            <a href="#campus" 
                @click="open = false" 
                class="block px-4 py-3 text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-gray-50 transition scroll-smooth active:bg-gray-100">
                Visitez le Campus
            </a>
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