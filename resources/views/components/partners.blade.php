<section class="py-16 bg-gradient-to-b from-white to-gray-50">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- En-tête avec animation -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-4xl font-bold text-gray-900 sm:text-5xl">
                Nos Partenaires
            </h2>
            <p class="mt-6 text-xl text-gray-600 leading-relaxed">
                Ensemble, nous créons un écosystème d'innovation dynamique pour transformer les idées en succès.
            </p>
        </div>

        <!-- Grille unifiée des partenaires -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6 place-items-center">
            @php
                $allPartners = array_merge(
                    config('hit.partners.premium', []),
                    config('hit.partners.platinum', []),
                    config('hit.partners.gold', []),
                    config('hit.partners.silver', [])
                );
            @endphp
            
            @foreach($allPartners as $partner)
                <div class="group relative bg-white rounded-xl p-4 w-full max-w-[220px] aspect-square flex items-center justify-center shadow-sm hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                    <!-- Effet de fond -->
                    <div class="absolute inset-0 bg-gradient-to-br from-primary-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <!-- Logo du partenaire -->
                    <img src="{{ asset('partenaires/' . Str::slug($partner) . '.png') }}" 
                         alt="Logo {{ $partner }}" 
                         class="relative h-28 w-auto object-contain transform transition-all duration-300 group-hover:scale-105 filter grayscale group-hover:grayscale-0">
                </div>
            @endforeach
        </div>

        <!-- CTA Devenir Partenaire amélioré -->
        <div class="mt-16 text-center">
            <div class="inline-flex flex-col items-center bg-white p-6 rounded-xl shadow-lg transform hover:-translate-y-1 transition-all duration-300">
                <p class="text-lg text-gray-700 mb-4 font-medium">
                    Vous souhaitez rejoindre notre écosystème d'innovation ?
                </p>
                <a href="#" class="group inline-flex items-center px-6 py-3 text-base font-semibold rounded-lg text-white bg-gradient-to-r from-orange-600 to-orange-500 hover:from-orange-500 hover:to-orange-400 transition-all duration-300 shadow-md hover:shadow-xl transform hover:-translate-y-0.5">
                    Devenir Partenaire
                    <svg class="ml-2 w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section> 