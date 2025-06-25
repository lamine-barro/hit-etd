
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
    <form action="{{ route('join-hub.export') }}" method="POST" enctype="multipart/form-data" class="space-y-8 bg-white rounded-2xl shadow-xl p-8 border border-gray-100 backdrop-blur-sm bg-white/90" id="expert-form">
        @csrf
        <!-- 1. Informations personnelles -->
        <h2 class="text-xl font-bold mb-4">Informations personnelles</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label for="full_name" class="block text-sm font-medium text-gray-700 mb-2">Nom et Prénom</label>
                <input type="text" name="full_name" id="full_name" class="block w-full pl-4 pr-4 py-3.5 rounded-xl border border-gray-300 bg-white focus:ring-primary-500 focus:border-primary-500 focus:outline-none transition duration-200 placeholder-gray-400 shadow-sm" required>
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Adresse email</label>
                <input type="email" name="email" id="email" class="block w-full pl-4 pr-4 py-3.5 rounded-xl border border-gray-300 bg-white focus:ring-primary-500 focus:border-primary-500 focus:outline-none transition duration-200 placeholder-gray-400 shadow-sm" required>
            </div>
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Numéro de téléphone</label>
                <input type="tel" name="phone" id="phone" class="block w-full pl-4 pr-4 py-3.5 rounded-xl border border-gray-300 bg-white focus:ring-primary-500 focus:border-primary-500 focus:outline-none transition duration-200 placeholder-gray-400 shadow-sm">
            </div>
            <div>
                <label for="organization" class="block text-sm font-medium text-gray-700 mb-2">Organisation/Affiliation (si applicable)</label>
                <input type="text" name="organization" id="organization" class="block w-full pl-4 pr-4 py-3.5 rounded-xl border border-gray-300 bg-white focus:ring-primary-500 focus:border-primary-500 focus:outline-none transition duration-200 placeholder-gray-400 shadow-sm">
            </div>
        </div>

        <!-- 2. Spécialité(s) -->
        <h2 class="text-xl font-bold mt-8 mb-4">Spécialité(s)</h2>
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
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="specialties[]" value="{{ $specialty }}" class="rounded border-gray-300 text-primary-600 shadow-sm focus:ring-primary-500">
                    <span>{{ $specialty }}</span>
                </label>
            @endforeach
            <label class="flex items-center space-x-2 col-span-full">
                <input type="checkbox" name="specialties[]" value="Autre" class="rounded border-gray-300 text-primary-600 shadow-sm focus:ring-primary-500" id="specialty_other_checkbox">
                <span>Autre - à préciser :</span>
                <input type="text" name="specialty_other" id="specialty_other" class="ml-2 block w-1/2 pl-2 pr-2 py-2 rounded border border-gray-300 bg-white focus:ring-primary-500 focus:border-primary-500 focus:outline-none transition duration-200 placeholder-gray-400 shadow-sm" placeholder="Votre spécialité">
            </label>
        </div>

        <!-- 3. Type(s) de formation/masterclass préféré(s) -->
        <h2 class="text-xl font-bold mt-8 mb-4">Type(s) de formation/masterclass préféré(s)</h2>
        <div class="space-y-4">
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="training_types[]" value="Présentiel" class="rounded border-gray-300 text-primary-600 shadow-sm focus:ring-primary-500" id="training_in_person">
                <span>Présentiel</span>
            </label>
            <div class="ml-6 space-x-2">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="training_campus" value="Campus" class="rounded border-gray-300 text-primary-600 shadow-sm focus:ring-primary-500">
                    <span>Campus</span>
                </label>
            </div>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="training_types[]" value="Virtuel" class="rounded border-gray-300 text-primary-600 shadow-sm focus:ring-primary-500" id="training_virtual">
                <span>Virtuel</span>
            </label>
            <div class="ml-6 flex flex-wrap gap-2">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="virtual_platforms[]" value="Zoom" class="rounded border-gray-300 text-primary-600 shadow-sm focus:ring-primary-500">
                    <span>Zoom</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" name="virtual_platforms[]" value="Microsoft Teams" class="rounded border-gray-300 text-primary-600 shadow-sm focus:ring-primary-500">
                    <span>Microsoft Teams</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" name="virtual_platforms[]" value="Google Chrome" class="rounded border-gray-300 text-primary-600 shadow-sm focus:ring-primary-500">
                    <span>Google Chrome</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" name="virtual_platforms[]" value="Autre" class="rounded border-gray-300 text-primary-600 shadow-sm focus:ring-primary-500" id="platform_other_checkbox">
                    <span>Autre :</span>
                    <input type="text" name="platform_other" id="platform_other" class="ml-2 block w-32 pl-2 pr-2 py-2 rounded border border-gray-300 bg-white focus:ring-primary-500 focus:border-primary-500 focus:outline-none transition duration-200 placeholder-gray-400 shadow-sm" placeholder="Votre plateforme">
                </label>
            </div>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="training_types[]" value="Expérientiel" class="rounded border-gray-300 text-primary-600 shadow-sm focus:ring-primary-500" id="training_experiential">
                <span>Expérientiel (ex. ateliers pratiques, hackathons, simulations)</span>
            </label>
            <div class="ml-6 flex flex-wrap gap-2">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="experiential_format[]" value="Individuel" class="rounded border-gray-300 text-primary-600 shadow-sm focus:ring-primary-500">
                    <span>Individuel</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" name="experiential_format[]" value="En groupe" class="rounded border-gray-300 text-primary-600 shadow-sm focus:ring-primary-500">
                    <span>En groupe</span>
                </label>
            </div>
        </div>

        <!-- 4. Public cible -->
        <h2 class="text-xl font-bold mt-8 mb-4">Public cible</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            @php
                $audiences = [
                    "Startups en phase d'idéation", "Startups en early stage", "Startups en phase de croissance",
                    "Partenaires externes (investisseurs, incubateurs, etc.)", "Étudiants"
                ];
            @endphp
            @foreach($audiences as $audience)
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="audiences[]" value="{{ $audience }}" class="rounded border-gray-300 text-primary-600 shadow-sm focus:ring-primary-500">
                    <span>{{ $audience }}</span>
                </label>
            @endforeach
        </div>

        <!-- 5. Fréquence d’intervention préférée -->
        <h2 class="text-xl font-bold mt-8 mb-4">Fréquence d’intervention préférée</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="frequencies[]" value="Hebdomadaire" class="rounded border-gray-300 text-primary-600 shadow-sm focus:ring-primary-500">
                <span>Hebdomadaire</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="frequencies[]" value="Mensuelle" class="rounded border-gray-300 text-primary-600 shadow-sm focus:ring-primary-500">
                <span>Mensuelle</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="frequencies[]" value="Trimestrielle" class="rounded border-gray-300 text-primary-600 shadow-sm focus:ring-primary-500">
                <span>Trimestrielle</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="frequencies[]" value="Annuelle" class="rounded border-gray-300 text-primary-600 shadow-sm focus:ring-primary-500">
                <span>Annuelle</span>
            </label>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="intervention_count[]" value="Une fois" class="rounded border-gray-300 text-primary-600 shadow-sm focus:ring-primary-500">
                <span>Une fois</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="intervention_count[]" value="Deux fois" class="rounded border-gray-300 text-primary-600 shadow-sm focus:ring-primary-500">
                <span>Deux fois</span>
            </label>
            <label class="flex items-center space-x-2 col-span-full">
                <span>Autre :</span>
                <input type="text" name="intervention_count_other" class="ml-2 block w-1/2 pl-2 pr-2 py-2 rounded border border-gray-300 bg-white focus:ring-primary-500 focus:border-primary-500 focus:outline-none transition duration-200 placeholder-gray-400 shadow-sm" placeholder="Nombre d’interventions">
            </label>
        </div>

        <!-- 6. Disponibilités générales -->
        <h2 class="text-xl font-bold mt-8 mb-4">Disponibilités générales</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Jours préférés :</label>
                <div class="flex flex-wrap gap-2">
                    @foreach(['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'] as $day)
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="preferred_days[]" value="{{ $day }}" class="rounded border-gray-300 text-primary-600 shadow-sm focus:ring-primary-500">
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
                            <input type="checkbox" name="preferred_slots[]" value="{{ $slot }}" class="rounded border-gray-300 text-primary-600 shadow-sm focus:ring-primary-500">
                            <span>{{ $slot }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- 7. Suggestions ou remarques supplémentaires -->
        <h2 class="text-xl font-bold mt-8 mb-4">Suggestions ou remarques supplémentaires</h2>
        <textarea name="suggestions" rows="4" class="block w-full rounded-xl border border-gray-300 bg-white focus:ring-primary-500 focus:border-primary-500 focus:outline-none transition duration-200 placeholder-gray-400 shadow-sm"></textarea>

        <!-- 8. CV -->
        <h2 class="text-xl font-bold mt-8 mb-4">Veuillez joindre votre CV</h2>
        <input type="file" name="cv" accept="application/pdf,.doc,.docx" class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100" required>

        <!-- Bouton de soumission -->
        <div class="mt-8 flex justify-center">
            <button type="submit" class="px-6 py-3 bg-primary-500 text-white font-semibold rounded-xl hover:bg-primary-600 transition duration-200 shadow-md hover:shadow-lg">
                Envoyer
            </button>
        </div>
    </form>
</div>
