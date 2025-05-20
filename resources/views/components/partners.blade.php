<section class="py-12 sm:py-16 bg-gradient-to-b from-white to-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Partenaires Fondateurs -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                {{ __('Nos Partenaires') }}
            </h2>
            <p class="mt-4 text-lg sm:text-xl text-gray-600 leading-relaxed">
                {{ __('Ensemble, nous avons créer HIT et espérons être rejoins par de nombreux autres acteurs pour co-créer un écosystème d'innovation dynamique pour transformer les idées en succès.') }}
            </p>
        </div>

        <!-- Partenaires Principaux -->
        <div class="flex justify-center mb-16">
                <div class="group relative bg-white rounded-xl p-6 w-full max-w-[200px] sm:max-w-[240px] aspect-square flex items-center justify-center shadow-sm hover:shadow-lg transition-all duration-300">
                    <img src="{{ asset('partenaires/' . Str::slug('presidence') . '.png') }}" 
                         alt="Logo {{ 'presidence' }}" 
                         class="h-24 sm:h-32 w-auto object-contain transform transition-all duration-300 group-hover:scale-105">
                </div>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-6 max-w-4xl mx-auto place-items-center mb-16">
            @foreach(['MTND', 'fjn', 'gude','ANSUT', 'VITIB','mpjipsc'] as $partner)
                <div class="group relative bg-white rounded-xl p-4 w-full max-w-[160px] sm:max-w-[180px] aspect-square flex items-center justify-center shadow-sm hover:shadow-lg transition-all duration-300">
                    <img src="{{ asset('partenaires/' . Str::slug($partner) . '.png') }}" 
                         alt="Logo {{ $partner }}" 
                         class="h-16 sm:h-20 w-auto object-contain transform transition-all duration-300 group-hover:scale-105">
                </div>
            @endforeach
        </div>

        <!-- Donateurs -->
        <div class="text-center max-w-3xl mx-auto mb-12">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                {{ __('Nos Donateurs') }}
            </h2>
            <p class="mt-4 text-lg sm:text-xl text-gray-600 leading-relaxed">
                {{ __('Ces entreprises qui ont contribué financièrement afin de permettre la réalisation du pilote au niveau du Postel 2001') }}
            </p>
        </div>

        <!-- Premium -->
        <div class="mb-16">
            <h3 class="text-2xl font-semibold text-center mb-8 text-primary">Premium</h3>
            <div class="flex justify-center">
                <div class="group relative bg-white rounded-xl p-8 w-full max-w-[280px] sm:max-w-[320px] aspect-square flex items-center justify-center shadow-sm hover:shadow-lg transition-all duration-300">
                    <img src="{{ asset('partenaires/ansut.png') }}" 
                         alt="Logo ANSUT" 
                         class="h-32 sm:h-40 w-auto object-contain transform transition-all duration-300 group-hover:scale-105">
                </div>
            </div>
        </div>

        <!-- Platinum -->
        <div class="mb-16">
            <h3 class="text-xl font-semibold text-center mb-8 text-primary">Platinum</h3>
            <div class="grid grid-cols-2 gap-6 sm:gap-8 max-w-3xl mx-auto place-items-center">
                @foreach(['ARTCI', 'PETROCI'] as $partner)
                    <div class="group relative bg-white rounded-xl p-6 w-full max-w-[220px] sm:max-w-[260px] aspect-square flex items-center justify-center shadow-sm hover:shadow-lg transition-all duration-300">
                        <img src="{{ asset('partenaires/' . Str::slug($partner) . '.png') }}" 
                             alt="Logo {{ $partner }}" 
                             class="h-24 sm:h-32 w-auto object-contain transform transition-all duration-300 group-hover:scale-105">
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Gold -->
        <div class="mb-16">
            <h3 class="text-xl font-semibold text-center mb-8 text-primary">Gold</h3>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 max-w-4xl mx-auto place-items-center">
                @foreach(['PAA', 'ci-energies', 'ccc', 'SIR'] as $partner)
                    <div class="group relative bg-white rounded-xl p-4 w-full max-w-[160px] sm:max-w-[180px] aspect-square flex items-center justify-center shadow-sm hover:shadow-lg transition-all duration-300">
                        <img src="{{ asset('partenaires/' . Str::slug($partner) . '.png') }}" 
                             alt="Logo {{ $partner }}" 
                             class="h-16 sm:h-20 w-auto object-contain transform transition-all duration-300 group-hover:scale-105">
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Silver -->
        <div class="mb-16">
            <h3 class="text-xl font-semibold text-center mb-8 text-primary">Silver</h3>
            <div class="grid grid-cols-2 gap-6 max-w-2xl mx-auto place-items-center">
                @foreach(['LONACI', 'VITIB'] as $partner)
                    <div class="group relative bg-white rounded-xl p-3 w-full max-w-[140px] sm:max-w-[160px] aspect-square flex items-center justify-center shadow-sm hover:shadow-lg transition-all duration-300">
                        <img src="{{ asset('partenaires/' . Str::slug($partner) . '.png') }}" 
                             alt="Logo {{ $partner }}" 
                             class="h-14 sm:h-16 w-auto object-contain transform transition-all duration-300 group-hover:scale-105">
                    </div>
                @endforeach
            </div>
        </div>

        <!-- CTA Devenir Donateur -->
        <div class="mt-16 text-center">
            <div class="inline-flex flex-col items-center bg-white p-6 rounded-xl shadow-lg transform hover:-translate-y-1 transition-all duration-300">
                <p class="text-base sm:text-lg text-gray-700 mb-4 font-medium">
                    {{ __('Vous souhaitez soutenir notre initiative ?') }}
                </p>
                <a href="{{ route('partnership') }}" class="group inline-flex items-center px-6 py-3 text-base font-semibold rounded-lg text-white bg-gradient-to-r from-orange-600 to-orange-500 hover:from-orange-500 hover:to-orange-400 transition-all duration-300 shadow-md hover:shadow-xl transform hover:-translate-y-0.5">
                    {{ __('Devenir Donateur') }}
                    <svg class="ml-2 w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>