<!-- Header Section -->
<div class="relative bg-gradient-to-br from-emerald-600 via-teal-600 to-cyan-600 py-16 sm:py-20 lg:py-32 overflow-hidden">
    <!-- Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-t from-black/10 via-transparent to-white/5"></div>
    
    <!-- Background Pattern -->
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.03"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-20"></div>
    
    <!-- Decorative Elements -->
    <div class="absolute top-20 left-10 w-24 h-24 bg-white/5 rounded-full blur-xl"></div>
    <div class="absolute bottom-20 right-10 w-32 h-32 bg-teal-400/10 rounded-full blur-2xl"></div>
    <div class="absolute top-40 right-20 w-16 h-16 bg-cyan-300/10 rounded-full blur-lg"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <!-- Title -->
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-6 drop-shadow-sm">
                {{ __("Visitez notre campus !") }}
            </h1>
            
            <!-- Subtitle -->
            <p class="text-xl sm:text-2xl text-emerald-100 max-w-3xl mx-auto opacity-90">
                {{ __("Planifiez une visite de notre campus ") }} {{ config('hit.name') }}
            </p>
        </div>
    </div>
</div>

<section class="relative py-20 bg-white overflow-hidden" id="campus">
    <!-- Décoration de fond -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(0,0,0,0.02)_0%,rgba(0,0,0,0)_100%)]"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-2 lg:gap-12">
            <!-- Formulaire de réservation -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <div class="px-8 py-6">
                    <!-- Affichage des erreurs générales -->
                    @if ($errors->any())
                        <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">{{ __("Des erreurs ont été détectées") }}</h3>
                                    <div class="mt-2 text-sm text-red-700">
                                        <ul class="list-disc pl-5 space-y-1">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('campus.book-visit') }}" method="POST" class="application-form space-y-6" id="booking-form">
                        @csrf

                        <!-- Informations personnelles -->
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ __("Informations personnelles") }}</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Prénom -->
                                <div>
                                    <label for="firstname" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ __("Prénom") }} <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="firstname" id="firstname" required
                                           value="{{ old('firstname') }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors @error('firstname') border-red-500 @enderror"
                                           placeholder="{{ __("Votre prénom") }}">
                                    @error('firstname')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Nom -->
                                <div>
                                    <label for="lastname" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ __("Nom") }} <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="lastname" id="lastname" required
                                           value="{{ old('lastname') }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors @error('lastname') border-red-500 @enderror"
                                           placeholder="{{ __("Votre nom") }}">
                                    @error('lastname')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ __("Email") }} <span class="text-red-500">*</span>
                                    </label>
                                    <input type="email" name="email" id="email" required
                                           value="{{ old('email') }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors @error('email') border-red-500 @enderror"
                                           placeholder="{{ __("vous@exemple.com") }}">
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Téléphone -->
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ __("Téléphone") }} <span class="text-red-500">*</span>
                                    </label>
                                    <input type="tel" name="phone" id="phone" required
                                           value="{{ old('phone') }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors @error('phone') border-red-500 @enderror"
                                           placeholder="{{ __("+225 XX XX XX XX XX") }}">
                                    @error('phone')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Détails de la visite -->
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Détails de la visite</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Date -->
                                <div>
                                    <label for="date" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ __("Date souhaitée") }} <span class="text-red-500">*</span>
                                    </label>
                                    <select name="date" id="date" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors @error('date') border-red-500 @enderror">
                                        <option value="">{{ __("Sélectionnez une date") }}</option>
                                        @php
                                            $dates = [];
                                            $currentDate = now()->addDays(3); // Préavis de 72h
                                            $endDate = now()->addMonths(2); // Limiter à 2 mois
                                            
                                            while ($currentDate <= $endDate) {
                                                // Mardi = 2, Jeudi = 4
                                                if ($currentDate->dayOfWeek === 2 || $currentDate->dayOfWeek === 4) {
                                                    $dates[] = [
                                                        'value' => $currentDate->format('Y-m-d'),
                                                        'label' => $currentDate->translatedFormat('l j F Y')
                                                    ];
                                                }
                                                $currentDate->addDay();
                                            }
                                        @endphp
                                        @foreach($dates as $dateOption)
                                            <option value="{{ $dateOption['value'] }}" {{ old('date') == $dateOption['value'] ? 'selected' : '' }}>
                                                {{ $dateOption['label'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('date')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Heure -->
                                <div>
                                    <label for="time" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ __("Heure souhaitée") }} <span class="text-red-500">*</span>
                                    </label>
                                    <select name="time" id="time" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors @error('time') border-red-500 @enderror">
                                        <option value="">{{ __("Sélectionnez une heure") }}</option>
                                        <option value="09:00" {{ old('time') == '09:00' ? 'selected' : '' }}>{{ __("09:00") }}</option>
                                        <option value="10:00" {{ old('time') == '10:00' ? 'selected' : '' }}>{{ __("10:00") }}</option>
                                        <option value="11:00" {{ old('time') == '11:00' ? 'selected' : '' }}>{{ __("11:00") }}</option>
                                        <option value="14:00" {{ old('time') == '14:00' ? 'selected' : '' }}>{{ __("14:00") }}</option>
                                        <option value="15:00" {{ old('time') == '15:00' ? 'selected' : '' }}>{{ __("15:00") }}</option>
                                        <option value="16:00" {{ old('time') == '16:00' ? 'selected' : '' }}>{{ __("16:00") }}</option>
                                    </select>
                                    @error('time')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Objet de la visite -->
                                <div class="md:col-span-2">
                                    <label for="purpose" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ __("Objet de la visite") }} <span class="text-red-500">*</span>
                                    </label>
                                    <select name="purpose" id="purpose" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors @error('purpose') border-red-500 @enderror">
                                        <option value="">{{ __("Sélectionnez l'objet de votre visite") }}</option>
                                        <option value="incubation" {{ old('purpose') == 'incubation' ? 'selected' : '' }}>{{ __("Candidature à l'incubation") }}</option>
                                        <option value="partenariat" {{ old('purpose') == 'partenariat' ? 'selected' : '' }}>{{ __("Visite en vue d'un partenariat") }}</option>
                                        <option value="presse" {{ old('purpose') == 'presse' ? 'selected' : '' }}>{{ __("Presse / Média") }}</option>
                                        <option value="etudiant" {{ old('purpose') == 'etudiant' ? 'selected' : '' }}>{{ __("Étudiant.e / Curiosité") }}</option>
                                        <option value="decouverte" {{ old('purpose') == 'decouverte' ? 'selected' : '' }}>{{ __("Découverte du Hub") }}</option>
                                        <option value="coworking" {{ old('purpose') == 'coworking' ? 'selected' : '' }}>{{ __("Espace de coworking") }}</option>
                                        <option value="evenement" {{ old('purpose') == 'evenement' ? 'selected' : '' }}>{{ __("Organisation d'événement") }}</option>
                                        <option value="other" {{ old('purpose') == 'other' ? 'selected' : '' }}>{{ __("Autre") }}</option>
                                    </select>
                                    @error('purpose')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Espaces à visiter -->
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Espaces à visiter <span class="text-red-500">*</span></h3>
                            
                            <div class="space-y-3">
                                <!-- Espace de Coworking -->
                                <label class="flex items-start p-4 bg-white border-2 border-gray-200 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-25 transition-all duration-200 group">
                                    <input type="checkbox" name="spaces[]" value="coworking" 
                                           {{ is_array(old('spaces')) && in_array('coworking', old('spaces')) ? 'checked' : '' }}
                                           class="mt-1 h-5 w-5 border-gray-300 rounded focus:ring-2 focus:ring-primary-500 checkbox-orange">
                                    <div class="ml-4 flex-1">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-primary-200 transition-colors">
                                                <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                            </svg>
                                            </div>
                                            <div>
                                                <h4 class="font-semibold text-gray-900 group-hover:text-primary-700 transition-colors">{{ __("Espace de Coworking") }}</h4>
                                                <p class="text-sm text-gray-600 mt-1">{{ __("Espace moderne et collaboratif de 500m²") }}</p>
                                            </div>
                                        </div>
                                        </div>
                                    </label>

                                <!-- Salles de Réunion -->
                                <label class="flex items-start p-4 bg-white border-2 border-gray-200 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-25 transition-all duration-200 group">
                                    <input type="checkbox" name="spaces[]" value="meeting"
                                           {{ is_array(old('spaces')) && in_array('meeting', old('spaces')) ? 'checked' : '' }}
                                           class="mt-1 h-5 w-5 border-gray-300 rounded focus:ring-2 focus:ring-primary-500 checkbox-orange">
                                    <div class="ml-4 flex-1">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-primary-200 transition-colors">
                                                <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                            </div>
                                            <div>
                                                <h4 class="font-semibold text-gray-900 group-hover:text-primary-700 transition-colors">{{ __("Salles de Réunion") }}</h4>
                                                <p class="text-sm text-gray-600 mt-1">{{ __("6 salles équipées de 4 à 20 personnes") }}</p>
                                            </div>
                                        </div>
                                        </div>
                                    </label>

                                <!-- Auditorium -->
                                <label class="flex items-start p-4 bg-white border-2 border-gray-200 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-25 transition-all duration-200 group">
                                    <input type="checkbox" name="spaces[]" value="auditorium"
                                           {{ is_array(old('spaces')) && in_array('auditorium', old('spaces')) ? 'checked' : '' }}
                                           class="mt-1 h-5 w-5 border-gray-300 rounded focus:ring-2 focus:ring-primary-500 checkbox-orange">
                                    <div class="ml-4 flex-1">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-primary-200 transition-colors">
                                                <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2m0 0V3a1 1 0 011 1v1M7 4V3a1 1 0 011-1m0 0h8m-8 0v1m8-1v1m0 0H8m8 0v1M8 5v1m8-1v1M8 6v1m8-1v1M8 7v1m8-1v1M4 8h16M4 12h16M4 16h16M4 20h16" />
                                            </svg>
                                            </div>
                                            <div>
                                                <h4 class="font-semibold text-gray-900 group-hover:text-primary-700 transition-colors">{{ __("Auditorium") }}</h4>
                                                <p class="text-sm text-gray-600 mt-1">{{ __("Une salle de conférence de 138 places") }}</p>
                                            </div>
                                        </div>
                                        </div>
                                    </label>
                            </div>
                            @error('spaces')
                                <p class="mt-3 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Message optionnel -->
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ __("Message complémentaire") }}</h3>
                            
                            <div>
                                <textarea name="message" id="message" rows="4" maxlength="200"
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors resize-none @error('message') border-red-500 @enderror"
                                          placeholder="{{ __("Informations complémentaires...") }}">{{ old('message') }}</textarea>
                                <p class="text-sm text-gray-500 mt-1">{{ __("Maximum 200 caractères") }}</p>
                                @error('message')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Confirmation -->
                        <div class="flex items-start">
                            <input type="checkbox" name="confirmation" value="1" id="confirmation" required
                                   {{ old('confirmation') ? 'checked' : '' }}
                                   class="h-4 w-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500 mt-1 @error('confirmation') border-red-500 @enderror">
                            <label for="confirmation" class="ml-2 text-sm text-gray-700">
                                {{ __("Je comprends que cette demande n'est pas une réservation automatique, et qu'elle sera confirmée par l'équipe du Hub Ivoire Tech dans un délai de 3 jours ouvrés.") }}
                            </label>
                        </div>
                        @error('confirmation')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <!-- Bouton de soumission -->
                        <div class="flex justify-end pt-6">
                            <button type="submit"
                                    class="bg-primary-600 hover:bg-primary-700 text-white font-medium py-3 px-8 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                                {{ __("Réserver ma visite") }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>

            <!-- Carte et Informations -->
            <div class="mt-10 lg:mt-0">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 h-[850px]">
                    <!-- Carte Google Maps -->
                    <div class="h-[450px] relative">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3972.596586554539!2d-4.019864524664149!3d5.325444294653074!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfc1ebe68aa6e9b7%3A0x674e8bdd65ee891b!2sImmeuble%20Postel%202001!5e0!3m2!1sen!2sci!4v1737931023375!5m2!1sen!2sci"
                            class="w-full h-full border-0"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                    <!-- Informations de contact -->
                    <div class="p-8 backdrop-blur-sm border-t border-gray-100">
                        <h4 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                            <span class="w-8 h-8 rounded-full bg-primary-100 text-primary-600 inline-flex items-center justify-center mr-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </span>
                            {{ config('hit.name') }}
                        </h4>
                        <div class="space-y-5">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-primary-50 text-primary-600 flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    </svg>
                                </div>
                                <div class="ml-4 flex-1">
                                    <p class="text-gray-900 font-medium">{{ __("Adresse") }}</p>
                                    <p class="mt-1 text-gray-600">{{ config('hit.address') }}</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-primary-50 text-primary-600 flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="ml-4 flex-1">
                                    <p class="text-gray-900 font-medium">{{ __("Horaires d'ouverture") }}</p>
                                    <p class="mt-1 text-gray-600">{{ __("Lun - Sam : 08h00 - 20h00") }}</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-primary-50 text-primary-600 flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <div class="ml-4 flex-1">
                                    <p class="text-gray-900 font-medium">{{ __("Contact") }}</p>
                                    <p class="mt-1 text-gray-600">{{ __("Tel : ") }}{{ config('hit.phone') }}</p>
                                    <p class="text-gray-600">{{ __("Email : ") }}{{ config('hit.email') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Plus de validation côté client pour les espaces - on laisse Laravel gérer
        console.log('Formulaire de réservation initialisé');
    });
    </script>
    @endpush

    @push('styles')
    <style>
        /* Custom orange checkboxes */
        .checkbox-orange {
            accent-color: #FF6B00 !important;
        }
        
        .checkbox-orange:checked {
            background-color: #FF6B00 !important;
            border-color: #FF6B00 !important;
        }
        
        .checkbox-orange:focus {
            box-shadow: 0 0 0 2px rgba(255, 107, 0, 0.2) !important;
        }
    </style>
    @endpush
</section>
