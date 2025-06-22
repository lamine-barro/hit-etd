<section class="relative py-20 bg-gradient-to-b from-gray-50/50 to-white overflow-hidden" id="campus">
    <!-- Décoration de fond -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(0,0,0,0.02)_0%,rgba(0,0,0,0)_100%)]"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- En-tête -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ __("Rejoindre le Hub") }}</h1>
            <p class="text-lg text-gray-600">{{ __("Planifiez une visite de notre campus (sur rendez-vous uniquement)") }} {{ config('hit.name') }}</p>
        </div>

        <div class="lg:grid lg:grid-cols-2 lg:gap-12">
            <!-- Formulaire de réservation -->

            <!-- Formulaire d'inscription -->
            <div class="max-w-2xl mx-auto">
                @if(session('notification'))
                    <div class="mb-6 p-4 rounded-xl {{ session('notification')['type'] === 'success' ? 'bg-green-50 text-green-800' : 'bg-red-50 text-red-800' }}">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                @if(session('notification')['type'] === 'success')
                                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
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
                <form action="{{ route('newsletter.subscribe') }}" method="POST" class="space-y-8 bg-white rounded-2xl shadow-xl p-8 border border-gray-100 backdrop-blur-sm bg-white/90" id="newsletter-form">
                    @csrf

                    <!-- Options d'abonnement -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="relative group">
                            <label for="newsletter_name" class="block text-sm font-medium text-gray-700 mb-2">{{ __("Nom complet") }}</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-primary-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <input type="text" name="newsletter_name" id="newsletter_name" class="block w-full pl-11 pr-4 py-3.5 rounded-xl border border-gray-300 bg-white focus:ring-primary-500 focus:border-primary-500 focus:outline-none transition duration-200 placeholder-gray-400 shadow-sm" placeholder={{ __("Votre nom") }}>
                            </div>
                        </div>

                        <div class="relative group">
                            <label for="resident_type_input" class="block text-sm font-medium text-gray-700 mb-2">{{ __("Email") }}</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-primary-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <input type="email" name="resident_type_input" id="resident_type_input" class="block w-full pl-11 pr-4 py-3.5 rounded-xl border border-gray-300 bg-white focus:ring-primary-500 focus:border-primary-500 focus:outline-none transition duration-200 placeholder-gray-400 shadow-sm" placeholder={{ __("votre@email.com") }}>
                            </div>
                        </div>
                    </div>

                    <!-- Champ WhatsApp -->
                    <div class="relative newsletter-whatsapp-field hidden group">
                        <label for="newsletter_whatsapp_input" class="block text-sm font-medium text-gray-700 mb-2">{{ __("Numéro WhatsApp") }}</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-green-500">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                </svg>
                            </div>
                            <input type="tel" name="newsletter_whatsapp_input" id="newsletter_whatsapp_input" class="block w-full pl-11 pr-4 py-3.5 rounded-xl border border-gray-300 bg-white focus:ring-green-500 focus:border-green-500 focus:outline-none transition duration-200 placeholder-gray-400 shadow-sm " placeholder={{ __("(+225 XX XX XX XX XX") }}>
                        </div>
                    </div>

                    <!-- Options de notification -->
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="relative p-5 bg-white border border-gray-300 rounded-xl transition-all duration-200 group cursor-pointer">
                                <div class="flex justify-between items-center mb-2">
                                    <label for="resident_type" class="font-semibold text-gray-900 group-hover:text-primary-600 transition-colors duration-200 cursor-pointer">{{ __("Devenir Opérateur Résident") }}</label>
                                    <div class="relative inline-flex h-6 w-11 items-center rounded-full bg-gray-200 p-1 transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                                        <input type="radio" id="resident_type" name="resident_type" checked class="sr-only" />
                                        <span aria-hidden="true" class="pointer-events-none h-4 w-4 transform rounded-full bg-white shadow-md ring-0 transition duration-300 ease-in-out peer-checked:translate-x-5 translate-x-0"></span>
                                        <span class="absolute inset-0 cursor-pointer"></span>
                                    </div>
                                </div>
                                <p class="text-gray-600 text-sm">{{ __("Actualités hebdomadaires et opportunités") }}</p>
                            </div>

                            <div class="relative p-5 bg-white border border-gray-300 rounded-xl transition-all duration-200 group cursor-pointer">
                                <div class="flex justify-between items-center mb-2">
                                    <label for="resident_type" class="font-semibold text-gray-900 group-hover:text-green-600 transition-colors duration-200 cursor-pointer">{{ __("Devenir Expert") }}</label>
                                    <div class="relative inline-flex h-6 w-11 items-center rounded-full bg-gray-200 p-1 transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                        <input type="radio" id="resident_type" name="resident_type" class="sr-only" />
                                        <span aria-hidden="true" class="pointer-events-none h-4 w-4 transform rounded-full bg-white shadow-md ring-0 transition duration-300 ease-in-out peer-checked:translate-x-5 translate-x-0"></span>
                                        <span class="absolute inset-0 cursor-pointer" id="whatsapp-toggle-button"></span>
                                    </div>
                                </div>
                                <p class="text-gray-600 text-sm">{{ __("Notifications d'événements et rappels") }}</p>
                            </div>
                        </div>

                        <script>
                            // Initialisation des toggles et du champ WhatsApp
                            document.addEventListener('DOMContentLoaded', function() {
                                const whatsappField = document.querySelector('.newsletter-whatsapp-field');
                                const whatsappToggle = document.querySelector('#newsletter_whatsapp');
                                const whatsappToggleContainer = whatsappToggle.closest('.relative.inline-flex');
                                const whatsappToggleCircle = whatsappToggleContainer.querySelector('span[aria-hidden="true"]');
                                const whatsappToggleClickable = whatsappToggleContainer.querySelector('span.absolute.inset-0');

                                // Fonction pour afficher/masquer le champ WhatsApp
                                function toggleWhatsappField() {
                                    if (whatsappToggle.checked) {
                                        whatsappField.classList.remove('hidden');
                                    } else {
                                        whatsappField.classList.add('hidden');
                                    }
                                }

                                // Gestion du clic sur le toggle WhatsApp
                                whatsappToggleClickable.addEventListener('click', function() {
                                    // Inverser l'état du radio
                                    whatsappToggle.checked = !whatsappToggle.checked;

                                    // Mettre à jour l'apparence du toggle
                                    if (whatsappToggle.checked) {
                                        whatsappToggleCircle.classList.add('translate-x-5');
                                        whatsappToggleContainer.classList.add('bg-green-500');
                                        whatsappToggleContainer.classList.remove('bg-gray-200');
                                    } else {
                                        whatsappToggleCircle.classList.remove('translate-x-5');
                                        whatsappToggleContainer.classList.remove('bg-green-500');
                                        whatsappToggleContainer.classList.add('bg-gray-200');
                                    }

                                    // Afficher/masquer le champ WhatsApp
                                    toggleWhatsappField();
                                });

                                // Gestion du changement direct du radio
                                whatsappToggle.addEventListener('change', toggleWhatsappField);

                                // Initialisation de l'état au chargement de la page
                                toggleWhatsappField();

                                // Gestion du toggle Email (inchangé)
                                const emailToggle = document.querySelector('#resident_type');
                                const emailToggleContainer = emailToggle.closest('.relative.inline-flex');
                                const emailToggleCircle = emailToggleContainer.querySelector('span[aria-hidden="true"]');

                                emailToggleContainer.querySelector('span.absolute.inset-0').addEventListener('click', function() {
                                    emailToggle.checked = !emailToggle.checked;

                                    if (emailToggle.checked) {
                                        emailToggleCircle.classList.add('translate-x-5');
                                        emailToggleContainer.classList.add('bg-primary-500');
                                        emailToggleContainer.classList.remove('bg-gray-200');
                                    } else {
                                        emailToggleCircle.classList.remove('translate-x-5');
                                        emailToggleContainer.classList.remove('bg-primary-500');
                                        emailToggleContainer.classList.add('bg-gray-200');
                                    }
                                });

                                // Initialisation de l'état du toggle Email
                                if (emailToggle.checked) {
                                    emailToggleCircle.classList.add('translate-x-5');
                                    emailToggleContainer.classList.add('bg-primary-500');
                                    emailToggleContainer.classList.remove('bg-gray-200');
                                }
                            });
                        </script>
                    </div>

                    <!-- Centres d'intérêt -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        {{ __("Centres d'intérêt") }}
                        </h3>
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                            @php
                                use App\Enums\AudienceType;
                                $audienceTypes = AudienceType::cases();
                            @endphp

                            @foreach($audienceTypes as $type)
                            <label class="relative flex flex-col items-center p-4 bg-white border-2 border-primary-500/20 rounded-xl cursor-pointer hover:border-primary-500 hover:shadow-md transition-all duration-200 group">
                                <input type="radio" name="interests[]" value="{{ $type->value }}" class="sr-only peer">
                                <div class="w-14 h-14 mb-3 flex items-center justify-center bg-white rounded-full shadow-sm group-hover:shadow text-primary-600 peer-checked:text-white peer-checked:bg-primary-600 transition-all duration-200 transform group-hover:scale-105">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        {!! $type->icon() !!}
                                    </svg>
                                </div>
                                <span class="font-medium text-gray-900 text-center group-hover:text-primary-600 transition-colors duration-200">{{ $type->label() }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Bouton de soumission -->
                    <div class="mt-8 flex justify-center">
                        <button type="submit" class="px-6 py-3 bg-primary-500 text-white font-semibold rounded-xl hover:bg-primary-600 transition duration-200 shadow-md hover:shadow-lg">{{ __("S'abonner") }}</button>
                    </div>
                </form>
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

    <!-- Suppression des scripts et styles OpenStreetMap -->
    @push('styles')
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
                            </svg>
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
