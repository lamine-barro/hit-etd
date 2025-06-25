<section class="relative py-20 bg-gradient-to-b from-gray-50/50 to-white overflow-hidden" id="campus">
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ __("Rejoindre le Hub") }}</h1>
            <p class="text-lg text-gray-600">{{ __("Planifiez une visite de notre campus (sur rendez-vous uniquement)") }} {{ config('hit.name') }}</p>
        </div>
    </div>

    <div class="mb-12 flex justify-center">
        <nav class="inline-flex rounded-xl shadow bg-white border border-gray-200 overflow-hidden" x-data="{ tab: window.location.hash === '#resident-join' ? 'resident' : 'expert' }">
            <button type="button" @click="tab = 'expert'; window.location.hash='#export-join'" :class="tab === 'expert' ? 'bg-primary-500 text-white' : 'bg-white text-gray-700 hover:bg-gray-50'" class="px-6 py-3 font-semibold focus:outline-none transition">Devenir Expert</button>
            <button type="button" @click="tab = 'resident'; window.location.hash= '#resident-join'" :class="tab === 'resident' ? 'bg-primary-500 text-white' : 'bg-white text-gray-700 hover:bg-gray-50'" class="px-6 py-3 font-semibold focus:outline-none transition">Devenir Résident</button>
        </nav>
    </div>
</section>

<div x-data="{ tab: window.location.hash === '#resident-join' ? 'resident' : 'expert' }" x-init="$watch('tab', t => { if(t === 'expert'){ document.getElementById('campus').scrollIntoView({behavior: 'smooth'}); } else { document.getElementById('resident-join').scrollIntoView({behavior: 'smooth'}); } })">
    <div x-show="tab === 'expert'">
        <section id="export-join">
            <!-- Décoration de fond -->
            <div class="absolute inset-0 pointer-events-none">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(0,0,0,0.02)_0%,rgba(0,0,0,0)_100%)]"></div>
            </div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h1 class="text-4xl font-bold text-gray-900 mb-4">Devenir Expert</h1>
                    <p class="text-lg text-gray-600">Rejoignez notre communauté de résidents et accédez à nos espaces, services et opportunités.</p>
                </div>
                @include('components.forms.expert-form')
            </div>
        </section>
    </div>

    <div x-show="tab === 'resident'">
        <section id="resident-join">
            <div class="absolute inset-0 pointer-events-none">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(0,0,0,0.02)_0%,rgba(0,0,0,0)_100%)]"></div>
            </div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h1 class="text-4xl font-bold text-gray-900 mb-4">Devenir Résident</h1>
                    <p class="text-lg text-gray-600">Rejoignez notre communauté de résidents et accédez à nos espaces, services et opportunités.</p>
                </div>
                <div class="max-w-2xl mx-auto">
                    @include('components.forms.resident-form')
                </div>
            </div>
        </section>
    </div>
</div>
