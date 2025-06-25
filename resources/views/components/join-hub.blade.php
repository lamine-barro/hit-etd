<section class="relative py-20 bg-gradient-to-b from-gray-50/50 to-white overflow-hidden" id="campus">
    <div class="mb-12 flex justify-center">
        <nav class="inline-flex rounded-xl shadow bg-white border border-gray-200 overflow-hidden" x-data="{ tab: window.location.hash === '#resident-join' ? 'resident' : 'expert' }">
            <button type="button" @click="tab = 'expert'; window.location.hash='#export-join'" :class="tab === 'expert' ? 'bg-primary-500 text-white' : 'bg-white text-gray-700 hover:bg-gray-50'" class="px-6 py-3 font-semibold focus:outline-none transition">Devenir Expert</button>
            <button type="button" @click="tab = 'resident'; window.location.hash='#resident-join'" :class="tab === 'resident' ? 'bg-primary-500 text-white' : 'bg-white text-gray-700 hover:bg-gray-50'" class="px-6 py-3 font-semibold focus:outline-none transition">Devenir Résident</button>
        </nav>
    </div>
</section>

<div x-data="{ tab: window.location.hash === '#resident-join' ? 'resident' : 'expert' }" x-init="$watch('tab', t => { if(t === 'expert'){ document.getElementById('campus').scrollIntoView({behavior: 'smooth'}); } else { document.getElementById('resident-join').scrollIntoView({behavior: 'smooth'}); } })">
    <div x-show="tab === 'expert'">
        <section id="export-join">
            <div class="absolute inset-0 pointer-events-none">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(0,0,0,0.02)_0%,rgba(0,0,0,0)_100%)]"></div>
            </div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h1 class="text-4xl font-bold text-gray-900 mb-4">Devenir Expert</h1>
                    <p class="text-lg text-gray-600">Rejoignez notre communauté de résidents et accédez à nos espaces, services et opportunités.</p>
                </div>
                <div class="lg:grid lg:grid-cols-2 lg:gap-12">
                    <div class="max-w-2xl mx-auto col-span-2">
                        @if(session('notification'))
                            <div class="mb-6 p-4 rounded-xl {{ session('notification')['type'] === 'success' ? 'bg-green-50 text-green-800' : 'bg-red-50 text-red-800' }}">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        @if(session('notification')['type'] === 'success')
                                            <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        @else
                                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium">{{ session('notification')['type'] === 'success' ? __("Votre inscription a été effectuée avec succès.") : __("Une erreur est survenue lors de l'inscription.") }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <form action="#" method="POST" enctype="multipart/form-data" class="space-y-8 bg-white rounded-2xl shadow-xl p-8 border border-gray-100 backdrop-blur-sm bg-white/90" id="expert-form">
                            @csrf
                            <!-- 1. Informations personnelles -->
                            <h2 class="text-xl font-bold mb-4">Informations personnelles</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <label for="full_name" class="block text-sm font-medium text-gray-700 mb-2">Nom et Prénom</label>
                                    <input type="text" name="full_name" id="full_name" class="form-input" required>
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Adresse email</label>
                                    <input type="email" name="email" id="email" class="form-input" required>
                                </div>
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Numéro de téléphone</label>
                                    <input type="tel" name="phone" id="phone" class="form-input">
                                </div>
                                <div>
                                    <label for="organization" class="block text-sm font-medium text-gray-700 mb-2">Organisation/Affiliation (si applicable)</label>
                                    <input type="text" name="organization" id="organization" class="form-input">
                                </div>
                            </div>
                            <!-- 2. Spécialité(s) -->
                            <h2 class="section-title">Spécialité(s)</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                                @php
                                    $specialties = [
                                        'Intelligence Artificielle (IA)', 'Blockchain', 'e-Santé', 'Robotique', 'SmartCities', 'Marketing',
                                        'Communication', 'Cybersecurité', 'Solution Spatiale Numérique', 'Propriété intellectuelle',
                                        'Programmation', 'Juridique', 'Finances', 'Financement', 'Cloud', 'Formation',
                                        'Entreprenariat accompagnement', 'Protection des données à caractère personnel'
                                    ];
                                @endphp
                                @foreach($specialties as $specialty)
                                    <label class="checkbox-label">
                                        <input type="checkbox" name="specialties[]" value="{{ $specialty }}" class="checkbox-input">
                                        <span>{{ $specialty }}</span>
                                    </label>
                                @endforeach
                                <label class="checkbox-label col-span-full">
                                    <input type="checkbox" name="specialties[]" value="Autre" class="checkbox-input" id="specialty_other_checkbox">
                                    <span>Autre - à préciser :</span>
                                    <input type="text" name="specialty_other" id="specialty_other" class="input-other" placeholder="Votre spécialité">
                                </label>
                            </div>
                            <!-- 3. Type(s) de formation/masterclass préféré(s) -->
                            <h2 class="section-title">Type(s) de formation/masterclass préféré(s)</h2>
                            <div class="space-y-4">
                                <label class="checkbox-label">
                                    <input type="checkbox" name="training_types[]" value="Présentiel" class="checkbox-input" id="training_in_person">
                                    <span>Présentiel</span>
                                </label>
                                <div class="ml-6 space-x-2">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="training_campus" value="Campus" class="checkbox-input">
                                        <span>Campus</span>
                                    </label>
                                </div>
                                <label class="checkbox-label">
                                    <input type="checkbox" name="training_types[]" value="Virtuel" class="checkbox-input" id="training_virtual">
                                    <span>Virtuel</span>
                                </label>
                                <div class="ml-6 flex flex-wrap gap-2">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="virtual_platforms[]" value="Zoom" class="checkbox-input">
                                        <span>Zoom</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="virtual_platforms[]" value="Microsoft Teams" class="checkbox-input">
                                        <span>Microsoft Teams</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="virtual_platforms[]" value="Google Chrome" class="checkbox-input">
                                        <span>Google Chrome</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="virtual_platforms[]" value="Autre" class="checkbox-input" id="platform_other_checkbox">
                                        <span>Autre :</span>
                                        <input type="text" name="platform_other" id="platform_other" class="input-other w-32" placeholder="Votre plateforme">
                                    </label>
                                </div>
                                <label class="checkbox-label">
                                    <input type="checkbox" name="training_types[]" value="Expérientiel" class="checkbox-input" id="training_experiential">
                                    <span>Expérientiel (ex. ateliers pratiques, hackathons, simulations)</span>
                                </label>
                                <div class="ml-6 flex flex-wrap gap-2">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="experiential_format[]" value="Individuel" class="checkbox-input">
                                        <span>Individuel</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="experiential_format[]" value="En groupe" class="checkbox-input">
                                        <span>En groupe</span>
                                    </label>
                                </div>
                            </div>
                            <!-- 4. Public cible -->
                            <h2 class="section-title">Public cible</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                                @php
                                    $audiences = [
                                        "Startups en phase d'idéation", "Startups en early stage", "Startups en phase de croissance",
                                        "Partenaires externes (investisseurs, incubateurs, etc.)", "Étudiants"
                                    ];
                                @endphp
                                @foreach($audiences as $audience)
                                    <label class="checkbox-label">
                                        <input type="checkbox" name="audiences[]" value="{{ $audience }}" class="checkbox-input">
                                        <span>{{ $audience }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <!-- 5. Fréquence d’intervention préférée -->
                            <h2 class="section-title">Fréquence d’intervention préférée</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <label class="checkbox-label">
                                    <input type="checkbox" name="frequencies[]" value="Hebdomadaire" class="checkbox-input">
                                    <span>Hebdomadaire</span>
                                </label>
                                <label class="checkbox-label">
                                    <input type="checkbox" name="frequencies[]" value="Mensuelle" class="checkbox-input">
                                    <span>Mensuelle</span>
                                </label>
                                <label class="checkbox-label">
                                    <input type="checkbox" name="frequencies[]" value="Trimestrielle" class="checkbox-input">
                                    <span>Trimestrielle</span>
                                </label>
                                <label class="checkbox-label">
                                    <input type="checkbox" name="frequencies[]" value="Annuelle" class="checkbox-input">
                                    <span>Annuelle</span>
                                </label>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                                <label class="checkbox-label">
                                    <input type="checkbox" name="intervention_count[]" value="Une fois" class="checkbox-input">
                                    <span>Une fois</span>
                                </label>
                                <label class="checkbox-label">
                                    <input type="checkbox" name="intervention_count[]" value="Deux fois" class="checkbox-input">
                                    <span>Deux fois</span>
                                </label>
                                <label class="checkbox-label col-span-full">
                                    <span>Autre :</span>
                                    <input type="text" name="intervention_count_other" class="input-other" placeholder="Nombre d’interventions">
                                </label>
                            </div>
                            <!-- 6. Disponibilités générales -->
                            <h2 class="section-title">Disponibilités générales</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Jours préférés :</label>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach(['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'] as $day)
                                            <label class="inline-flex items-center">
                                                <input type="checkbox" name="preferred_days[]" value="{{ $day }}" class="checkbox-input">
                                                <span>{{ $day }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Plages horaires :</label>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach(['Matin','Après-midi','Soir'] as $slot)
                                            <label class="inline-flex items-center">
                                                <input type="checkbox" name="preferred_slots[]" value="{{ $slot }}" class="checkbox-input">
                                                <span>{{ $slot }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!-- 7. Suggestions ou remarques supplémentaires -->
                            <h2 class="section-title">Suggestions ou remarques supplémentaires</h2>
                            <textarea name="suggestions" rows="4" class="textarea"></textarea>
                            <!-- 8. CV -->
                            <h2 class="section-title">Veuillez joindre votre CV</h2>
                            <input type="file" name="cv" accept="application/pdf,.doc,.docx" class="file-input" required>
                            <!-- Bouton de soumission -->
                            <div class="mt-8 flex justify-center">
                                <button type="submit" class="submit-btn">
                                    Envoyer
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @push('styles')
            <style>
                .form-input {
                    @apply block w-full pl-4 pr-4 py-3.5 rounded-xl border border-gray-300 bg-white focus:ring-primary-500 focus:border-primary-500 focus:outline-none transition duration-200 placeholder-gray-400 shadow-sm;
                }
                .checkbox-label {
                    @apply flex items-center space-x-2;
                }
                .checkbox-input {
                    @apply rounded border-gray-300 text-primary-600 shadow-sm focus:ring-primary-500;
                }
                .input-other {
                    @apply ml-2 block w-1/2 pl-2 pr-2 py-2 rounded border border-gray-300 bg-white focus:ring-primary-500 focus:border-primary-500 focus:outline-none transition duration-200 placeholder-gray-400 shadow-sm;
                }
                .section-title {
                    @apply text-xl font-bold mt-8 mb-4;
                }
                .textarea {
                    @apply block w-full rounded-xl border border-gray-300 bg-white focus:ring-primary-500 focus:border-primary-500 focus:outline-none transition duration-200 placeholder-gray-400 shadow-sm;
                }
                .file-input {
                    @apply block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100;
                }
                .submit-btn {
                    @apply px-6 py-3 bg-primary-500 text-white font-semibold rounded-xl hover:bg-primary-600 transition duration-200 shadow-md hover:shadow-lg;
                }
            </style>
            @endpush
            @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    console.log('🚀 Initialisation du formulaire de réservation...');

                    document.getElementById('booking-form').addEventListener('submit', function (e) {
                        e.preventDefault();
                        console.log('📝 Soumission du formulaire détectée');

                        const form = this;
                        const formData = new FormData(form);
                        console.log('📊 Données du formulaire:', Object.fromEntries(formData));

                        const submitButton = form.querySelector('button[type="submit"]');
                        const buttonText = submitButton.querySelector('span');
                        const originalText = buttonText.textContent;

                        // Disable the submit button and show loading state
                        submitButton.disabled = true;
                        buttonText.textContent = '{{ __("Envoi en cours...") }}';
                        console.log('⏳ Désactivation du bouton et affichage du chargement');

                        fetch(form.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => {
                            console.log('📡 Réponse du serveur reçue:', {
                                status: response.status,
                                statusText: response.statusText
                            });
                            return response.json();
                        })
                        .then(data => {
                            console.log('✨ Données reçues:', data);

                            if (data.status === 'success') {
                                console.log('✅ Réservation réussie');
                                // Show success message
                                const successDiv = document.createElement('div');
                                successDiv.className = 'fixed top-4 right-4 bg-green-50 text-green-800 p-4 rounded-lg shadow-lg z-50';
                                successDiv.innerHTML = `
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        @else
                                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium">{{ session('notification')['type'] === 'success' ? __("Votre inscription a été effectuée avec succès.") : __("Une erreur est survenue lors de l'inscription.") }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <form action="#" method="POST" enctype="multipart/form-data" class="space-y-8 bg-white rounded-2xl shadow-xl p-8 border border-gray-100 backdrop-blur-sm bg-white/90" id="expert-form">
                            @csrf
                            <!-- 1. Informations personnelles -->
                            <h2 class="text-xl font-bold mb-4">Informations personnelles</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <label for="full_name" class="block text-sm font-medium text-gray-700 mb-2">Nom et Prénom</label>
                                    <input type="text" name="full_name" id="full_name" class="form-input" required>
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Adresse email</label>
                                    <input type="email" name="email" id="email" class="form-input" required>
                                </div>
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Numéro de téléphone</label>
                                    <input type="tel" name="phone" id="phone" class="form-input">
                                </div>
                                <div>
                                    <label for="organization" class="block text-sm font-medium text-gray-700 mb-2">Organisation/Affiliation (si applicable)</label>
                                    <input type="text" name="organization" id="organization" class="form-input">
                                </div>
                            </div>
                            <!-- 2. Spécialité(s) -->
                            <h2 class="section-title">Spécialité(s)</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                                @php
                                    $specialties = [
                                        'Intelligence Artificielle (IA)', 'Blockchain', 'e-Santé', 'Robotique', 'SmartCities', 'Marketing',
                                        'Communication', 'Cybersecurité', 'Solution Spatiale Numérique', 'Propriété intellectuelle',
                                        'Programmation', 'Juridique', 'Finances', 'Financement', 'Cloud', 'Formation',
                                        'Entreprenariat accompagnement', 'Protection des données à caractère personnel'
                                    ];
                                @endphp
                                @foreach($specialties as $specialty)
                                    <label class="checkbox-label">
                                        <input type="checkbox" name="specialties[]" value="{{ $specialty }}" class="checkbox-input">
                                        <span>{{ $specialty }}</span>
                                    </label>
                                @endforeach
                                <label class="checkbox-label col-span-full">
                                    <input type="checkbox" name="specialties[]" value="Autre" class="checkbox-input" id="specialty_other_checkbox">
                                    <span>Autre - à préciser :</span>
                                    <input type="text" name="specialty_other" id="specialty_other" class="input-other" placeholder="Votre spécialité">
                                </label>
                            </div>
                            <!-- 3. Type(s) de formation/masterclass préféré(s) -->
                            <h2 class="section-title">Type(s) de formation/masterclass préféré(s)</h2>
                            <div class="space-y-4">
                                <label class="checkbox-label">
                                    <input type="checkbox" name="training_types[]" value="Présentiel" class="checkbox-input" id="training_in_person">
                                    <span>Présentiel</span>
                                </label>
                                <div class="ml-6 space-x-2">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="training_campus" value="Campus" class="checkbox-input">
                                        <span>Campus</span>
                                    </label>
                                </div>
                                <label class="checkbox-label">
                                    <input type="checkbox" name="training_types[]" value="Virtuel" class="checkbox-input" id="training_virtual">
                                    <span>Virtuel</span>
                                </label>
                                <div class="ml-6 flex flex-wrap gap-2">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="virtual_platforms[]" value="Zoom" class="checkbox-input">
                                        <span>Zoom</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="virtual_platforms[]" value="Microsoft Teams" class="checkbox-input">
                                        <span>Microsoft Teams</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="virtual_platforms[]" value="Google Chrome" class="checkbox-input">
                                        <span>Google Chrome</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="virtual_platforms[]" value="Autre" class="checkbox-input" id="platform_other_checkbox">
                                        <span>Autre :</span>
                                        <input type="text" name="platform_other" id="platform_other" class="input-other w-32" placeholder="Votre plateforme">
                                    </label>
                                </div>
                                <label class="checkbox-label">
                                    <input type="checkbox" name="training_types[]" value="Expérientiel" class="checkbox-input" id="training_experiential">
                                    <span>Expérientiel (ex. ateliers pratiques, hackathons, simulations)</span>
                                </label>
                                <div class="ml-6 flex flex-wrap gap-2">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="experiential_format[]" value="Individuel" class="checkbox-input">
                                        <span>Individuel</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="experiential_format[]" value="En groupe" class="checkbox-input">
                                        <span>En groupe</span>
                                    </label>
                                </div>
                            </div>
                            <!-- 4. Public cible -->
                            <h2 class="section-title">Public cible</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                                @php
                                    $audiences = [
                                        "Startups en phase d'idéation", "Startups en early stage", "Startups en phase de croissance",
                                        "Partenaires externes (investisseurs, incubateurs, etc.)", "Étudiants"
                                    ];
                                @endphp
                                @foreach($audiences as $audience)
                                    <label class="checkbox-label">
                                        <input type="checkbox" name="audiences[]" value="{{ $audience }}" class="checkbox-input">
                                        <span>{{ $audience }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <!-- 5. Fréquence d’intervention préférée -->
                            <h2 class="section-title">Fréquence d’intervention préférée</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <label class="checkbox-label">
                                    <input type="checkbox" name="frequencies[]" value="Hebdomadaire" class="checkbox-input">
                                    <span>Hebdomadaire</span>
                                </label>
                                <label class="checkbox-label">
                                    <input type="checkbox" name="frequencies[]" value="Mensuelle" class="checkbox-input">
                                    <span>Mensuelle</span>
                                </label>
                                <label class="checkbox-label">
                                    <input type="checkbox" name="frequencies[]" value="Trimestrielle" class="checkbox-input">
                                    <span>Trimestrielle</span>
                                </label>
                                <label class="checkbox-label">
                                    <input type="checkbox" name="frequencies[]" value="Annuelle" class="checkbox-input">
                                    <span>Annuelle</span>
                                </label>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                                <label class="checkbox-label">
                                    <input type="checkbox" name="intervention_count[]" value="Une fois" class="checkbox-input">
                                    <span>Une fois</span>
                                </label>
                                <label class="checkbox-label">
                                    <input type="checkbox" name="intervention_count[]" value="Deux fois" class="checkbox-input">
                                    <span>Deux fois</span>
                                </label>
                                <label class="checkbox-label col-span-full">
                                    <span>Autre :</span>
                                    <input type="text" name="intervention_count_other" class="input-other" placeholder="Nombre d’interventions">
                                </label>
                            </div>
                            <!-- 6. Disponibilités générales -->
                            <h2 class="section-title">Disponibilités générales</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Jours préférés :</label>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach(['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'] as $day)
                                            <label class="inline-flex items-center">
                                                <input type="checkbox" name="preferred_days[]" value="{{ $day }}" class="checkbox-input">
                                                <span>{{ $day }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Plages horaires :</label>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach(['Matin','Après-midi','Soir'] as $slot)
                                            <label class="inline-flex items-center">
                                                <input type="checkbox" name="preferred_slots[]" value="{{ $slot }}" class="checkbox-input">
                                                <span>{{ $slot }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!-- 7. Suggestions ou remarques supplémentaires -->
                            <h2 class="section-title">Suggestions ou remarques supplémentaires</h2>
                            <textarea name="suggestions" rows="4" class="textarea"></textarea>
                            <!-- 8. CV -->
                            <h2 class="section-title">Veuillez joindre votre CV</h2>
                            <input type="file" name="cv" accept="application/pdf,.doc,.docx" class="file-input" required>
                            <!-- Bouton de soumission -->
                            <div class="mt-8 flex justify-center">
                                <button type="submit" class="submit-btn">
                                    Envoyer
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @push('styles')
            <style>
                .form-input {
                    @apply block w-full pl-4 pr-4 py-3.5 rounded-xl border border-gray-300 bg-white focus:ring-primary-500 focus:border-primary-500 focus:outline-none transition duration-200 placeholder-gray-400 shadow-sm;
                }
                .checkbox-label {
                    @apply flex items-center space-x-2;
                }
                .checkbox-input {
                    @apply rounded border-gray-300 text-primary-600 shadow-sm focus:ring-primary-500;
                }
                .input-other {
                    @apply ml-2 block w-1/2 pl-2 pr-2 py-2 rounded border border-gray-300 bg-white focus:ring-primary-500 focus:border-primary-500 focus:outline-none transition duration-200 placeholder-gray-400 shadow-sm;
                }
                .section-title {
                    @apply text-xl font-bold mt-8 mb-4;
                }
                .textarea {
                    @apply block w-full rounded-xl border border-gray-300 bg-white focus:ring-primary-500 focus:border-primary-500 focus:outline-none transition duration-200 placeholder-gray-400 shadow-sm;
                }
                .file-input {
                    @apply block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100;
                }
                .submit-btn {
                    @apply px-6 py-3 bg-primary-500 text-white font-semibold rounded-xl hover:bg-primary-600 transition duration-200 shadow-md hover:shadow-lg;
                }
            </style>
            @endpush
            @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    console.log('🚀 Initialisation du formulaire de réservation...');

                    document.getElementById('booking-form').addEventListener('submit', function (e) {
                        e.preventDefault();
                        console.log('📝 Soumission du formulaire détectée');

                        const form = this;
                        const formData = new FormData(form);
                        console.log('📊 Données du formulaire:', Object.fromEntries(formData));

                        const submitButton = form.querySelector('button[type="submit"]');
                        const buttonText = submitButton.querySelector('span');
                        const originalText = buttonText.textContent;

                        // Disable the submit button and show loading state
                        submitButton.disabled = true;
                        buttonText.textContent = '{{ __("Envoi en cours...") }}';
                        console.log('⏳ Désactivation du bouton et affichage du chargement');

                        fetch(form.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => {
                            console.log('📡 Réponse du serveur reçue:', {
                                status: response.status,
                                statusText: response.statusText
                            });
                            return response.json();
                        })
                        .then(data => {
                            console.log('✨ Données reçues:', data);

                            if (data.status === 'success') {
                                console.log('✅ Réservation réussie');
                                // Show success message
                                const successDiv = document.createElement('div');
                                successDiv.className = 'fixed top-4 right-4 bg-green-50 text-green-800 p-4 rounded-lg shadow-lg z-50';
                                successDiv.innerHTML = `
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium">{{ __("Merci pour votre réservation !") }}</p>
                                        </div>
                                    </div>
                                `;
                                document.body.appendChild(successDiv);
                                console.log('📢 Message de succès affiché');

                                // Remove success message after 5 seconds and redirect
                                setTimeout(() => {
                                    successDiv.remove();
                                    form.reset();
                                    window.location.href = '/'; // Redirection vers la page d'accueil
                                }, 5000);
                            } else {
                                console.warn('⚠️ Statut non-succès reçu:', data);
                                throw new Error(data.message);
                            }
                        })
                        .catch(error => {
                            console.error('❌ Erreur lors de la réservation:', error);
                            // Show error message
                            const errorDiv = document.createElement('div');
                            errorDiv.className = 'fixed top-4 right-4 bg-red-50 text-red-800 p-4 rounded-lg shadow-lg z-50';
                            errorDiv.innerHTML = `
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium">{{ __("Erreur lors de la réservation") }}</p>
                                    </div>
                                </div>
                            `;
                            document.body.appendChild(errorDiv);
                            console.log('📢 Message d\'erreur affiché');

                            // Remove error message after 5 seconds
                            setTimeout(() => {
                                console.log('🗑️ Suppression du message d\'erreur');
                                errorDiv.remove();
                            }, 5000);
                        })
                        .finally(() => {
                            console.log('🔄 Réinitialisation du bouton de soumission');
                            // Reset button state
                            submitButton.disabled = false;
                            buttonText.textContent = originalText;
                        });
                    });
                });
            </script>
            @endpush
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
                    <form action="#" method="POST" enctype="multipart/form-data" class="space-y-8 bg-white rounded-2xl shadow-xl p-8 border border-gray-100 backdrop-blur-sm bg-white/90" id="resident-form">
                        @csrf
                        <!-- 1. Informations personnelles -->
                        <h2 class="section-title">Informations personnelles</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="resident_full_name" class="block text-sm font-medium text-gray-700 mb-2">Nom et Prénom</label>
                                <input type="text" name="resident_full_name" id="resident_full_name" class="form-input" required>
                            </div>
                            <div>
                                <label for="resident_email" class="block text-sm font-medium text-gray-700 mb-2">Adresse email</label>
                                <input type="email" name="resident_email" id="resident_email" class="form-input" required>
                            </div>
                            <div>
                                <label for="resident_phone" class="block text-sm font-medium text-gray-700 mb-2">Numéro de téléphone</label>
                                <input type="tel" name="resident_phone" id="resident_phone" class="form-input">
                            </div>
                            <div>
                                <label for="resident_organization" class="block text-sm font-medium text-gray-700 mb-2">Organisation/Affiliation (si applicable)</label>
                                <input type="text" name="resident_organization" id="resident_organization" class="form-input">
                            </div>
                        </div>
                        <!-- 2. Objectif de résidence -->
                        <h2 class="section-title">Objectif de résidence</h2>
                        <textarea name="resident_objective" rows="3" class="textarea" placeholder="Décrivez brièvement votre objectif ou projet en tant que résident" required></textarea>
                        <!-- 3. Type d'espace recherché -->
                        <h2 class="section-title">Type d'espace recherché</h2>
                        <div class="flex flex-wrap gap-4">
                            @php
                                $espaceTypes = ['Bureau', 'Open Space', 'Salle de réunion', 'Salle de conférence', 'Atelier', 'Autre'];
                            @endphp
                            @foreach($espaceTypes as $type)
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="resident_space_types[]" value="{{ $type }}" class="checkbox-input">
                                    <span>{{ $type }}</span>
                                </label>
                            @endforeach
                        </div>
                        <!-- 4. Durée de résidence souhaitée -->
                        <h2 class="section-title">Durée de résidence souhaitée</h2>
                        <div class="flex flex-wrap gap-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="resident_duration" value="1 mois" class="checkbox-input">
                                <span>1 mois</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="resident_duration" value="3 mois" class="checkbox-input">
                                <span>3 mois</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="resident_duration" value="6 mois" class="checkbox-input">
                                <span>6 mois</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="resident_duration" value="12 mois" class="checkbox-input">
                                <span>12 mois</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="resident_duration" value="Autre" class="checkbox-input">
                                <span>Autre :</span>
                                <input type="text" name="resident_duration_other" class="input-other w-32" placeholder="Précisez">
                            </label>
                        </div>
                        <!-- 5. Besoins spécifiques ou remarques -->
                        <h2 class="section-title">Besoins spécifiques ou remarques</h2>
                        <textarea name="resident_needs" rows="3" class="textarea" placeholder="Précisez vos besoins, attentes ou remarques"></textarea>
                        <!-- 6. CV -->
                        <h2 class="section-title">Veuillez joindre votre CV</h2>
                        <input type="file" name="resident_cv" accept="application/pdf,.doc,.docx" class="file-input" required>
                        <!-- Bouton de soumission -->
                        <div class="mt-8 flex justify-center">
                            <button type="submit" class="submit-btn">
                                Envoyer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
