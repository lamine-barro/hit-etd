<section class="relative min-h-screen bg-black overflow-hidden" id="hero" x-data="{ 
    stats: [
        { value: '100+', label: '{{ __("Supported Startups") }}' },
        { value: '50M€', label: '{{ __("Raised by our startups") }}' },
        { value: '1000+', label: '{{ __("Trained Entrepreneurs") }}' },
        { value: '30+', label: '{{ __("Partners") }}' }
    ],
    show: false
}" x-init="setTimeout(() => show = true, 500)">
    <!-- Image de fond avec overlay -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/hero_bg.jpg') }}" alt="Innovation Hub" class="w-full h-full object-cover scale-105 transition-transform duration-[2s] hover:scale-100">
        <div class="absolute inset-0 bg-gradient-to-b from-black/90 via-black/70 to-black/90"></div>
    </div>

    <!-- Motif en cube avec animation -->
    <div class="absolute inset-0 bg-cube-pattern opacity-5 sm:opacity-10 animate-pulse"></div>

    <!-- Contenu -->
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 min-h-screen py-20 sm:py-0">
        <div class="flex flex-col justify-center items-center min-h-screen space-y-8 sm:space-y-16">
            <!-- Texte principal avec animations -->
            <div class="text-center max-w-3xl mt-16 sm:mt-0" 
                x-show="show" 
                x-transition:enter="transition ease-out duration-1000"
                x-transition:enter-start="opacity-0 transform translate-y-12"
                x-transition:enter-end="opacity-100 transform translate-y-0">
                <h1 class="text-white text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold leading-tight sm:leading-tight pt-28">
                    <span class="block mb-2 hover:text-primary-500 transition-colors duration-300 transform hover:scale-105">
                        {{ __('Join the largest') }}
                    </span>
                    <span class="block bg-gradient-to-r from-primary-500 to-secondary-500 text-transparent bg-clip-text hover:scale-110 transition-transform duration-500">
                        {{ __('Startup Campus') }}
                    </span>
                    <span class="block mt-2 hover:text-primary-500 transition-colors duration-300 transform hover:scale-105">
                        {{ __('in Africa') }}
                    </span>
                </h1>
                <p class="mt-6 text-base sm:text-lg md:text-xl text-gray-100 max-w-2xl mx-auto font-light bg-black/30 backdrop-blur-sm hover:backdrop-blur-lg rounded-lg p-4 sm:p-6 border border-white/10 transition-all duration-500 hover:border-primary-500/50 hover:shadow-lg hover:shadow-primary-500/20">
                    {{ __('Accelerate your growth, innovate and transform your ideas into success. A unique place dedicated to innovation, sharing and creating solutions that transform Ivory Coast and Africa.') }}
                </p>
                <!-- Boutons CTA -->
                <div class="mt-8 flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="#why-hit" class="btn-primary w-full sm:w-auto text-base sm:text-lg py-3 px-6 sm:px-8 smooth-scroll hover:scale-105 transition-transform duration-300">
                        {{ __('Learn more') }}
                    </a>
                    <a href="{{ route('visitez-le-campus') }}" class="btn-secondary w-full sm:w-auto text-base sm:text-lg py-3 px-6 sm:px-8 hover:scale-105 transition-transform duration-300">
                        {{ __('Visit the campus') }}
                    </a>
                </div>
            </div>

            <!-- Statistiques avec animations -->
            <div class="grid grid-cols-2 gap-6 sm:gap-8 md:grid-cols-4 w-full max-w-4xl px-4 sm:px-0"
                x-show="show"
                x-transition:enter="transition ease-out duration-1000 delay-500"
                x-transition:enter-start="opacity-0 transform translate-y-12"
                x-transition:enter-end="opacity-100 transform translate-y-0">
                <template x-for="(stat, index) in stats" :key="index">
                    <div class="flex flex-col items-center bg-black/20 backdrop-blur-sm rounded-lg p-4 sm:p-6 hover:bg-black/30 transition-all duration-300 hover:transform hover:scale-105 hover:shadow-lg hover:shadow-primary-500/20 group">
                        <span class="text-2xl sm:text-3xl md:text-4xl font-bold text-primary-500 group-hover:scale-110 transition-transform duration-300" x-text="stat.value"></span>
                        <span class="mt-2 text-xs sm:text-sm text-center text-gray-100 group-hover:text-primary-500 transition-colors duration-300" x-text="stat.label"></span>
                    </div>
                </template>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
.bg-cube-pattern {
    background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}

[x-cloak] {
    display: none !important;
}

@keyframes float {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
    100% { transform: translateY(0px); }
}
</style>
@endpush