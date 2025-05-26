<section class="relative py-20 bg-gradient-to-b from-gray-50/50 to-white overflow-hidden" id="campus">
    <!-- Décoration de fond -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(0,0,0,0.02)_0%,rgba(0,0,0,0)_100%)]"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- En-tête -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ __("Visitez notre campus !") }}</h1>
            <p class="text-lg text-gray-600">{{ __("Réservez dès maintenant votre visite guidée et plongez dans l'univers stimulant du") }} {{ config('hit.name') }}</p>
        </div>

        <div class="lg:grid lg:grid-cols-2 lg:gap-12">
            <!-- Formulaire de réservation -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 h-[850px]">
                <div class="px-8 py-2 h-full overflow-y-auto">
                    <form action="{{ route('campus.book-visit') }}" method="POST" class="space-y-8" id="booking-form">
                        @csrf

                        <!-- Nom et Prénom -->
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div class="relative">
                                <label for="firstname" class="block text-sm font-medium text-gray-700 mb-2">{{ __("Prénom") }}</label>
                                <input type="text" name="firstname" id="firstname" class="block w-full px-4 py-3.5 rounded-xl border-gray-300 bg-gray-50 focus:bg-white focus:ring-primary-500 focus:border-primary-500 focus:outline-none transition duration-200 placeholder-gray-400" placeholder="{{ __("Votre prénom") }}">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400 mt-6">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="relative">
                                <label for="lastname" class="block text-sm font-medium text-gray-700 mb-2">{{ __("Nom") }}</label>
                                <input type="text" name="lastname" id="lastname" class="block w-full px-4 py-3.5 rounded-xl border-gray-300 bg-gray-50 focus:bg-white focus:ring-primary-500 focus:border-primary-500 focus:outline-none transition duration-200 placeholder-gray-400" placeholder="{{ __("Votre nom") }}">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400 mt-6">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Email et Téléphone -->
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div class="relative">
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">{{ __("Email") }}</label>
                                <input type="email" name="email" id="email" class="block w-full px-4 py-3.5 rounded-xl border-gray-300 bg-gray-50 focus:bg-white focus:ring-primary-500 focus:border-primary-500 focus:outline-none transition duration-200 placeholder-gray-400" placeholder="{{ __("vous@exemple.com") }}">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400 mt-6">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="relative">
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">{{ __("Téléphone") }}</label>
                                <input type="tel" name="phone" id="phone" class="block w-full px-4 py-3.5 rounded-xl border-gray-300 bg-gray-50 focus:bg-white focus:ring-primary-500 focus:border-primary-500 focus:outline-none transition duration-200 placeholder-gray-400" placeholder="{{ __("+225 XX XX XX XX XX") }}">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400 mt-6">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Date et Heure -->
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div class="relative">
                                <label for="date" class="block text-sm font-medium text-gray-700 mb-2">{{ __("Date souhaitée") }}</label>
                                <input type="date" name="date" id="date" class="block w-full px-4 py-3.5 rounded-xl border-gray-300 bg-gray-50 focus:bg-white focus:ring-primary-500 focus:border-primary-500 focus:outline-none transition duration-200">
                            </div>
                            <div class="relative">
                                <label for="time" class="block text-sm font-medium text-gray-700 mb-2">{{ __("Heure souhaitée") }}</label>
                                <select name="time" id="time" class="block w-full px-4 py-3.5 rounded-xl border-gray-300 bg-gray-50 focus:bg-white focus:ring-primary-500 focus:border-primary-500 focus:outline-none transition duration-200">
                                    <option value="">{{ __("Sélectionnez une heure") }}</option>
                                    <option value="09:00">{{ __("09:00") }}</option>
                                    <option value="10:00">{{ __("10:00") }}</option>
                                    <option value="11:00">{{ __("11:00") }}</option>
                                    <option value="14:00">{{ __("14:00") }}</option>
                                    <option value="15:00">{{ __("15:00") }}</option>
                                    <option value="16:00">{{ __("16:00") }}</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400 mt-6">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Objet de la visite -->
                        <div class="relative">
                            <label for="purpose" class="block text-sm font-medium text-gray-700 mb-2">{{ __("Objet de la visite") }}</label>
                            <select name="purpose" id="purpose" class="block w-full px-4 py-3.5 rounded-xl border-gray-300 bg-gray-50 focus:bg-white focus:ring-primary-500 focus:border-primary-500 focus:outline-none transition duration-200">
                                <option value="">{{ __("Sélectionnez l'objet de votre visite") }}</option>
                                <option value="decouverte">{{ __("Découverte du Hub") }}</option>
                                <option value="incubation">{{ __("Programme d'incubation") }}</option>
                                <option value="coworking">{{ __("Espace de coworking") }}</option>
                                <option value="evenement">{{ __("Organisation d'événement") }}</option>
                                <option value="partenariat">{{ __("Partenariat") }}</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400 mt-6">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                        </div>

                        <!-- Espaces à visiter -->
                        <div class="space-y-4">
                            <label class="block text-sm font-medium text-gray-700">{{ __("Espaces à visiter") }}</label>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <!-- Espace de Coworking -->
                                <div class="relative">
                                    <input type="checkbox" name="spaces[]" value="coworking" id="space-coworking" class="absolute opacity-0 w-0 h-0 peer">
                                    <label for="space-coworking" class="block h-[160px] p-4 bg-gray-50 border-2 rounded-xl cursor-pointer transition-all duration-200 peer-checked:border-primary-500 peer-checked:bg-primary-50 hover:bg-gray-100">
                                        <div class="font-medium text-gray-900">{{ __("Espace de Coworking") }}</div>
                                        <div class="mt-1 text-sm text-gray-500">{{ __("Espace moderne et collaboratif de 500m²") }}</div>
                                        <div class="absolute top-4 right-4 w-5 h-5 rounded-full border-2 peer-checked:border-primary-500 peer-checked:bg-primary-500 transition-all duration-200">
                                            <svg class="w-5 h-5 text-white scale-0 peer-checked:scale-100 transition-transform duration-200" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                            </svg>
                                        </div>
                                    </label>
                                </div>

                                <!-- Salles de Réunion -->
                                <div class="relative">
                                    <input type="checkbox" name="spaces[]" value="meeting" id="space-meeting" class="absolute opacity-0 w-0 h-0 peer">
                                    <label for="space-meeting" class="block h-[160px] p-4 bg-gray-50 border-2 rounded-xl cursor-pointer transition-all duration-200 peer-checked:border-primary-500 peer-checked:bg-primary-50 hover:bg-gray-100">
                                        <div class="font-medium text-gray-900">{{ __("Salles de Réunion") }}</div>
                                        <div class="mt-1 text-sm text-gray-500">{{ __("6 salles équipées de 4 à 20 personnes") }}</div>
                                        <div class="absolute top-4 right-4 w-5 h-5 rounded-full border-2 peer-checked:border-primary-500 peer-checked:bg-primary-500 transition-all duration-200">
                                            <svg class="w-5 h-5 text-white scale-0 peer-checked:scale-100 transition-transform duration-200" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                            </svg>
                                        </div>
                                    </label>
                                </div>

                                <!-- Auditorium -->
                                <div class="relative">
                                    <input type="checkbox" name="spaces[]" value="auditorium" id="space-auditorium" class="absolute opacity-0 w-0 h-0 peer">
                                    <label for="space-auditorium" class="block h-[160px] p-4 bg-gray-50 border-2 rounded-xl cursor-pointer transition-all duration-200 peer-checked:border-primary-500 peer-checked:bg-primary-50 hover:bg-gray-100">
                                        <div class="font-medium text-gray-900">{{ __("Auditorium") }}</div>
                                        <div class="mt-1 text-sm text-gray-500">{{ __("Une salle de conférence de 138 places") }}</div>
                                        <div class="absolute top-4 right-4 w-5 h-5 rounded-full border-2 peer-checked:border-primary-500 peer-checked:bg-primary-500 transition-all duration-200">
                                            <svg class="w-5 h-5 text-white scale-0 peer-checked:scale-100 transition-transform duration-200" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                            </svg>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Message -->
                        <div class="relative">
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">{{ __("Message (optionnel)") }}</label>
                            <textarea name="message" id="message" rows="3" class="block w-full px-4 py-3.5 rounded-xl border-gray-300 bg-gray-50 focus:bg-white focus:ring-primary-500 focus:border-primary-500 focus:outline-none transition duration-200 placeholder-gray-400" placeholder="{{ __("Informations complémentaires...") }}"></textarea>
                        </div>

                        <!-- Bouton de soumission -->
                        <div class="pt-4">
                            <button type="submit" class="w-full inline-flex items-center justify-center px-8 py-4 text-base font-medium rounded-xl text-white bg-gradient-to-r from-orange-600 to-orange-500 hover:from-orange-700 hover:to-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                                <span>{{ __("Réserver ma visite") }}</span>
                                <svg class="ml-3 w-5 h-5 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
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

    <!-- Suppression des scripts et styles OpenStreetMap -->
    @push('styles')
    @endpush

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('🚀 Initialisation du formulaire de réservation...');

        document.getElementById('booking-form').addEventListener('submit', function·e {
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
