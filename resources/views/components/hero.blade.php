<section class="relative min-h-screen bg-black overflow-hidden" id="hero" x-data="{ 
    showContent: false,
    showStats: false,
    showTitle: false,
    showSubtitle: false,
    showButtons: false,
    stats: [
        { value: '100+', label: 'Startups Accompagnées' },
        { value: '50M€', label: 'Levés par nos startups' },
        { value: '1000+', label: 'Entrepreneurs Formés' },
        { value: '30+', label: 'Partenaires' }
    ]
}" x-init="() => {
    setTimeout(() => showTitle = true, 300);
    setTimeout(() => showSubtitle = true, 800);
    setTimeout(() => showContent = true, 1300);
    setTimeout(() => showButtons = true, 1800);
    setTimeout(() => showStats = true, 2300);
}">
    <!-- Image de fond avec overlay -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/hero_bg.jpg') }}" alt="Innovation Hub" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-b from-black/90 via-black/70 to-black/90"></div>
    </div>

    <!-- Motif en cube -->
    <div class="absolute inset-0 bg-cube-pattern opacity-5 sm:opacity-10"></div>

    <!-- Contenu -->
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 min-h-screen py-20 sm:py-0">
        <div class="flex flex-col justify-center items-center min-h-screen space-y-8 sm:space-y-16">
            <!-- Texte principal -->
            <div class="text-center max-w-3xl mt-16 sm:mt-0">
                <h1 class="text-white text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold leading-tight sm:leading-tight pt-28">
                    <span class="block mb-2 transition-all duration-700 transform"
                        x-show="showTitle"
                        x-transition:enter="transition ease-out duration-700"
                        x-transition:enter-start="opacity-0 translate-y-8"
                        x-transition:enter-end="opacity-100 translate-y-0">
                        Rejoignez le plus grand
                    </span>
                    <span class="block text-gradient typing-animation"
                        x-show="showTitle">
                        Campus de Startups
                    </span>
                    <span class="block mt-2 transition-all duration-700 transform"
                        x-show="showTitle"
                        x-transition:enter="transition ease-out duration-700"
                        x-transition:enter-start="opacity-0 translate-y-8"
                        x-transition:enter-end="opacity-100 translate-y-0">
                        en Afrique
                    </span>
                </h1>
                <p class="mt-6 text-base sm:text-lg md:text-xl text-gray-100 max-w-2xl mx-auto font-light bg-black/30 backdrop-blur-sm hover:backdrop-blur-lg rounded-lg p-4 sm:p-6 border border-white/10 transition-all duration-500"
                    x-show="showSubtitle"
                    x-transition:enter="transition ease-out duration-700"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100">
                    Accélérez votre croissance, innovez et transformez vos idées en succès. Un lieu unique dédié à l'innovation, au partage et à la création de solutions qui transforment la Côte d'Ivoire et l'Afrique.
                </p>
                <!-- Boutons CTA -->
                <div class="mt-8 flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4"
                    x-show="showButtons"
                    x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0 translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0">
                    <a href="#why-hit" class="btn-primary w-full sm:w-auto text-base sm:text-lg py-3 px-6 sm:px-8 smooth-scroll hover:scale-105 transition-transform duration-300">
                        En savoir plus
                        <svg class="w-5 h-5 ml-2 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                    </a>
                    <a href="{{ route('visit') }}" class="btn-secondary w-full sm:w-auto text-base sm:text-lg py-3 px-6 sm:px-8 hover:scale-105 transition-transform duration-300">
                        Visiter le Campus
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Statistiques -->
            <div class="grid grid-cols-2 gap-6 sm:gap-8 md:grid-cols-4 w-full max-w-4xl px-4 sm:px-0"
                x-show="showStats"
                x-transition:enter="transition ease-out duration-1000"
                x-transition:enter-start="opacity-0 translate-y-8"
                x-transition:enter-end="opacity-100 translate-y-0">
                <template x-for="(stat, index) in stats" :key="index">
                    <div class="flex flex-col items-center animate-fade-in bg-black/20 backdrop-blur-sm rounded-lg p-4 sm:p-6 hover:bg-black/30 transition-all duration-300"
                        :style="{ animationDelay: `${index * 200}ms` }">
                        <span class="text-2xl sm:text-3xl md:text-4xl font-bold text-primary-500" x-text="stat.value"></span>
                        <span class="mt-2 text-xs sm:text-sm text-center text-gray-100" x-text="stat.label"></span>
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

.typing-animation {
    border-right: 2px solid;
    animation: typing 3.5s steps(40, end), blink-caret .75s step-end infinite;
    white-space: nowrap;
    overflow: hidden;
    width: 0;
    animation-fill-mode: forwards;
    animation-delay: 0.5s;
}

@keyframes typing {
    from { width: 0 }
    to { width: 100% }
}

@keyframes blink-caret {
    from, to { border-color: transparent }
    50% { border-color: currentColor }
}

@keyframes fade-in {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.animate-fade-in {
    animation: fade-in 0.5s ease-out forwards;
}

[x-cloak] {
    display: none !important;
}

@media (max-width: 640px) {
    .typing-animation {
        white-space: normal;
        animation: none;
        width: auto;
        border-right: none;
    }
}
</style>
@endpush