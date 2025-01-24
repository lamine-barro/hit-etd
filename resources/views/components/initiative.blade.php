<section class="py-20 bg-gray-50 relative overflow-hidden" x-data="{ 
    showContent: false,
    showStats: false,
    showPoints: false
}" x-init="() => {
    setTimeout(() => showContent = true, 500);
    setTimeout(() => showPoints = true, 1000);
    setTimeout(() => showStats = true, 1500);
}">
    <!-- Motif en cube (selon la charte) -->
    <div class="absolute inset-0 bg-cube-pattern opacity-5"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-2 lg:gap-16 items-center">
            <!-- Contenu texte -->
            <div class="mb-12 lg:mb-0"
                x-show="showContent"
                x-transition:enter="transition ease-out duration-1000"
                x-transition:enter-start="opacity-0 transform translate-y-8"
                x-transition:enter-end="opacity-100 transform translate-y-0">
                <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl mb-6">
                    Une vision portée par le Gouvernement
                </h2>
                
                <div class="prose prose-lg text-gray-600 max-w-none">
                    <p class="mb-6">
                        Le Hub Ivoire Tech est le fruit d'une collaboration entre le secteur public et privé, visant à stimuler l'innovation en Côte d'Ivoire. Soutenu par le Ministère de l'Économie Numérique, il favorise la création de solutions technologiques et renforce la compétitivité du pays sur la scène internationale.
                    </p>

                    <!-- Points clés -->
                    <div class="space-y-4 mt-8">
                        <template x-for="(point, index) in [
                            { title: 'Programmes Spéciaux', content: 'Dispositifs incitatifs et subventions pour les entrepreneurs innovants.' },
                            { title: 'Partenariats Internationaux', content: 'Collaborations avec des hubs technologiques mondiaux.' },
                            { title: 'Facilités Administratives', content: 'Accompagnement dans les démarches réglementaires.' }
                        ]" :key="index">
                            <div class="flex items-start"
                                x-show="showPoints"
                                x-transition:enter="transition ease-out duration-500"
                                x-transition:enter-start="opacity-0 transform translate-x-4"
                                x-transition:enter-end="opacity-100 transform translate-x-0"
                                :style="{ transitionDelay: `${index * 200}ms` }">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <p class="ml-3 text-gray-600">
                                    <span class="font-semibold text-primary" x-text="point.title"></span>
                                    <span x-text="point.content"></span>
                                </p>
                            </div>
                        </template>
                    </div>
                </div>
                <!-- Bouton d'action -->
                <div class="mt-8">
                    <a href="{{ route('services') }}" class="btn-primary w-full sm:w-auto text-base sm:text-lg py-3 px-6 sm:px-8">
                        Découvrir nos programmes
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Image/Illustration -->
            <div class="relative"
                x-show="showContent"
                x-transition:enter="transition ease-out duration-1000 delay-300"
                x-transition:enter-start="opacity-0 transform translate-x-8"
                x-transition:enter-end="opacity-100 transform translate-x-0">
                <div class="aspect-w-16 aspect-h-9 lg:aspect-none rounded-xl overflow-hidden group">
                    <img class="shadow-2xl object-cover object-center w-full h-full" src="{{ asset('images/collaboration.jpg') }}" alt="Collaboration gouvernementale">
                    <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>

                <!-- Statistiques superposées -->
                <div class="absolute bottom-0 right-0 transform translate-y-1/4 bg-white rounded-lg shadow-xl p-6 max-w-sm"
                    x-show="showStats"
                    x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0 transform translate-y-4"
                    x-transition:enter-end="opacity-100 transform translate-y-1/4">
                    <div class="grid grid-cols-2 gap-8">
                        <div>
                            <p class="text-4xl font-bold text-primary">10+</p>
                            <p class="mt-1 text-sm text-gray-500">Ministères Partenaires</p>
                        </div>
                        <div>
                            <p class="text-4xl font-bold text-primary">5M€</p>
                            <p class="mt-1 text-sm text-gray-500">Budget Annuel</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> 