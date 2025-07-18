<x-layouts.main>
    <x-slot:title>{{ __("Inscription à") }} {{ $event->getTranslatedAttribute('title') }} - {{ config('app.name') }}</x-slot:title>
    <x-slot:metaDescription>{{ __("Inscrivez-vous à l'événement") }} {{ $event->getTranslatedAttribute('title') }}</x-slot:metaDescription>

    <div class="min-h-screen bg-gray-50 py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- En-tête -->
            <div class="text-center mb-8">
                <div class="mb-4">
                    <a href="{{ route('events.show', ['slug' => $event->getSlug()]) }}" 
                       class="inline-flex items-center text-primary-600 hover:text-primary-500 text-sm font-medium">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        {{ __("Retour à l'événement") }}
                    </a>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ __("Rejoignez-nous !") }}</h1>
                <p class="text-xl text-gray-600">{{ $event->getTranslatedAttribute('title') }}</p>
                <div class="flex items-center justify-center space-x-4 mt-4 text-gray-500">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ $event->start_date->format('d F Y à H:i') }}
                    </div>
                    @if($event->location)
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ $event->location }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Messages de feedback -->
            @if(session('success'))
                <div class="mb-8 bg-green-50 border border-green-200 rounded-lg p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-green-800">{{ session('success') }}</h3>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-8 bg-red-50 border border-red-200 rounded-lg p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">{{ session('error') }}</h3>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Formulaire d'inscription -->
            <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                <div class="px-8 py-6 bg-primary-50 border-b border-primary-100">
                    <h2 class="text-xl font-semibold text-primary-900">{{ __("Informations de contact") }}</h2>
                    <p class="text-primary-700 mt-1">{{ __("Merci de remplir tous les champs obligatoires pour finaliser votre inscription.") }}</p>
                </div>
                
                <div class="px-8 py-8">
                    @if($event->isRegistrationOpen())
                        <form action="{{ route('events.register', ['slug' => $event->getSlug()]) }}" method="POST" class="space-y-6">
                            @csrf
                            
                            <!-- Informations personnelles -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ __("Nom complet") }} <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="name" id="name" required 
                                           value="{{ old('name', auth()->check() ? auth()->user()->name : '') }}"
                                           class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('name') border-red-300 @enderror"
                                           placeholder="{{ __('Jean Dupont') }}">
                                    @error('name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                                </div>
                                
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ __("Adresse e-mail") }} <span class="text-red-500">*</span>
                                    </label>
                                    <input type="email" name="email" id="email" required 
                                           value="{{ old('email', auth()->check() ? auth()->user()->email : '') }}"
                                           class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('email') border-red-300 @enderror"
                                           placeholder="{{ __('jean.dupont@example.com') }}">
                                    @error('email')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="whatsapp" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ __("Numéro WhatsApp") }}
                                        <span class="text-gray-400 text-xs">({{ __("optionnel") }})</span>
                                    </label>
                                    <input type="tel" name="whatsapp" id="whatsapp" 
                                           value="{{ old('whatsapp', auth()->check() ? auth()->user()->whatsapp : '') }}"
                                           class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('whatsapp') border-red-300 @enderror"
                                           placeholder="{{ __('+225 07 00 00 00 00') }}">
                                    @error('whatsapp')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                                </div>
                                
                                <div>
                                    <label for="position" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ __("Poste/Fonction") }} <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="position" id="position" required 
                                           value="{{ old('position', auth()->check() ? auth()->user()->position : '') }}"
                                           class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('position') border-red-300 @enderror"
                                           placeholder="{{ __('Développeur, CEO, Étudiant...') }}">
                                    @error('position')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="organization" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ __("Organisation/Entreprise") }} <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="organization" id="organization" required 
                                           value="{{ old('organization', auth()->check() ? auth()->user()->organization : '') }}"
                                           class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('organization') border-red-300 @enderror"
                                           placeholder="{{ __('Nom de votre entreprise ou école') }}">
                                    @error('organization')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                                </div>
                                
                                <div>
                                    <label for="country" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ __("Pays de résidence") }} <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="country" id="country" required 
                                           value="{{ old('country', auth()->check() ? auth()->user()->country : '') }}"
                                           class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('country') border-red-300 @enderror"
                                           placeholder="{{ __('Côte d\'Ivoire') }}">
                                    @error('country')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <div>
                                <label for="actor_type" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __("Vous êtes") }} <span class="text-red-500">*</span>
                                </label>
                                <select name="actor_type" id="actor_type" required
                                        class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('actor_type') border-red-300 @enderror">
                                    <option value="">{{ __("Choisissez votre profil...") }}</option>
                                    <option value="startup" @selected(old('actor_type') == 'startup')>{{ __("Startup / Entrepreneur") }}</option>
                                    <option value="etudiant" @selected(old('actor_type') == 'etudiant')>{{ __("Étudiant") }}</option>
                                    <option value="chercheur" @selected(old('actor_type') == 'chercheur')>{{ __("Chercheur / Académique") }}</option>
                                    <option value="investisseur" @selected(old('actor_type') == 'investisseur')>{{ __("Investisseur") }}</option>
                                    <option value="media" @selected(old('actor_type') == 'media')>{{ __("Média / Journaliste") }}</option>
                                    <option value="corporate" @selected(old('actor_type') == 'corporate')>{{ __("Corporate / Grande entreprise") }}</option>
                                    <option value="service_public" @selected(old('actor_type') == 'service_public')>{{ __("Service Public") }}</option>
                                    <option value="structure_accompagnement" @selected(old('actor_type') == 'structure_accompagnement')>{{ __("Structure d'accompagnement") }}</option>
                                    <option value="autre" @selected(old('actor_type') == 'autre')>{{ __("Autre") }}</option>
                                </select>
                                @error('actor_type')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                            </div>

                            <!-- Prix et conditions -->
                            @if($event->is_paid)
                                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-sm font-medium text-yellow-800">{{ __("Événement payant") }}</h3>
                                            <div class="mt-2 text-sm text-yellow-700">
                                                <p>{{ __("Le montant de") }} <strong>{{ number_format($event->getCurrentPrice(), 0, ',', ' ') }} {{ $event->currency }}</strong> {{ __("sera à régler après validation de votre inscription.") }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Bouton de soumission -->
                            <div class="pt-6 border-t border-gray-200">
                                <button type="submit"
                                        class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-base font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors">
                                    {{ $event->is_paid ? __("Confirmer et procéder au paiement") : __("Confirmer mon inscription") }}
                                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </button>
                                <p class="text-center text-xs text-gray-500 mt-3">
                                    {{ __("En soumettant ce formulaire, vous acceptez de recevoir des communications relatives à cet événement.") }}
                                </p>
                            </div>
                        </form>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z" />
                            </svg>
                            <h3 class="mt-2 text-lg font-medium text-gray-900">{{ __("Inscriptions fermées") }}</h3>
                            <p class="mt-1 text-gray-500">{{ __("Malheureusement, les inscriptions pour cet événement ne sont plus ouvertes.") }}</p>
                            <div class="mt-6">
                                <a href="{{ route('events.show', ['slug' => $event->getSlug()]) }}" 
                                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-primary-700 bg-primary-100 hover:bg-primary-200">
                                    {{ __("Retour à l'événement") }}
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar avec informations -->
            @if($event->max_participants)
                <div class="mt-8 bg-white rounded-lg border border-gray-200 p-6">
                    @php
                        $registrations = $event->registrations()->where('status', 'confirmed')->count();
                        $remaining = $event->max_participants - $registrations;
                    @endphp
                    <div class="text-center">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">{{ __("Places disponibles") }}</h3>
                        <div class="text-3xl font-bold text-primary-600 mb-2">{{ $remaining }}</div>
                        <p class="text-sm text-gray-500">{{ __("sur") }} {{ $event->max_participants }} {{ __("places") }}</p>
                        <div class="mt-4 w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-primary-600 h-2 rounded-full transition-all duration-300" style="width: {{ ($registrations / ($event->max_participants > 0 ? $event->max_participants : 1)) * 100 }}%"></div>
                        </div>
                        @if($remaining <= 5 && $remaining > 0)
                            <p class="text-sm text-amber-600 mt-2 font-medium">{{ __("Attention : Plus que") }} {{ $remaining }} {{ __("places !") }}</p>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-layouts.main> 