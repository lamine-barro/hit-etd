<!-- Section Newsletter -->
<section class="relative py-24 overflow-hidden bg-cover bg-center bg-fixed" style="background-image: url('{{ asset('images/newsletter_bg.jpg') }}')">
    <!-- Overlay clair -->
    <div class="absolute inset-0 bg-white/80"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- En-tête -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-primary-600 text-white shadow-lg transform transition hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                Newsletter
            </span>
            <h2 class="mt-8 text-4xl font-bold text-gray-900 sm:text-5xl lg:text-6xl tracking-tight">
                Restez Connectés !
            </h2>
            <p class="mt-6 text-xl text-gray-600 leading-relaxed">
                Recevez nos conseils, nos actualités et nos opportunités directement dans votre boîte mail ou via WhatsApp.
            </p>
        </div>

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
                            <p class="text-sm font-medium">{{ session('notification')['message'] }}</p>
                        </div>
                    </div>
                </div>
            @endif
            <form action="{{ route('newsletter.subscribe') }}" method="POST" class="space-y-8 bg-white rounded-2xl shadow-xl p-8" id="newsletter-form">
                @csrf
                
                <!-- Options d'abonnement -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="relative">
                        <label for="newsletter_name" class="block text-sm font-medium text-gray-700 mb-2">Nom complet</label>
                        <input type="text" name="newsletter_name" id="newsletter_name" class="block w-full px-4 py-3.5 rounded-xl border-gray-300 bg-gray-50 focus:bg-white focus:ring-primary-500 focus:border-primary-500 focus:outline-none transition duration-200 placeholder-gray-400" placeholder="Votre nom">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400 mt-6">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>

                    <div class="relative">
                        <label for="newsletter_email_input" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" name="newsletter_email_input" id="newsletter_email_input" class="block w-full px-4 py-3.5 rounded-xl border-gray-300 bg-gray-50 focus:bg-white focus:ring-primary-500 focus:border-primary-500 focus:outline-none transition duration-200 placeholder-gray-400" placeholder="votre@email.com">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400 mt-6">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Champ WhatsApp -->
                <div class="relative newsletter-whatsapp-field hidden">
                    <label for="newsletter_whatsapp_input" class="block text-sm font-medium text-gray-700 mb-2">Numéro WhatsApp</label>
                    <input type="tel" name="newsletter_whatsapp_input" id="newsletter_whatsapp_input" class="block w-full px-4 py-3.5 rounded-xl border-gray-300 bg-gray-50 focus:bg-white focus:ring-primary-500 focus:border-primary-500 focus:outline-none transition duration-200 placeholder-gray-400" placeholder="+225 XX XX XX XX XX">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400 mt-6">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                    </div>
                </div>

                <!-- Options de notification -->
                <div class="space-y-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Options de notification</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="relative flex p-4 bg-white border-2 border-primary-500/20 rounded-xl hover:border-primary-500 transition-colors duration-200 group">
                            <div class="flex items-center h-5">
                                <input id="newsletter_email" name="newsletter_email" type="checkbox" checked class="h-5 w-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500 focus:border-primary-500 focus:outline-none transition duration-200">
                            </div>
                            <div class="ml-4">
                                <label for="newsletter_email" class="font-semibold text-gray-900 group-hover:text-primary-600 transition-colors duration-200">Newsletter Email</label>
                                <p class="text-gray-600 text-sm mt-1">Actualités hebdomadaires et opportunités</p>
                            </div>
                        </div>

                        <div class="relative flex p-4 bg-white border-2 border-primary-500/20 rounded-xl hover:border-primary-500 transition-colors duration-200 group">
                            <div class="flex items-center h-5">
                                <input id="newsletter_whatsapp" name="newsletter_whatsapp" type="checkbox" class="h-5 w-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500 focus:border-primary-500 focus:outline-none transition duration-200">
                            </div>
                            <div class="ml-4">
                                <label for="newsletter_whatsapp" class="font-semibold text-gray-900 group-hover:text-primary-600 transition-colors duration-200">Alertes WhatsApp</label>
                                <p class="text-gray-600 text-sm mt-1">Notifications d'événements et rappels</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Centres d'intérêt -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Centres d'intérêt</h3>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        <label class="relative flex flex-col items-center p-4 bg-white border-2 border-primary-500/20 rounded-xl cursor-pointer hover:border-primary-500 transition-colors duration-200 group">
                            <input type="checkbox" name="interests[]" value="startups" class="sr-only peer">
                            <div class="w-12 h-12 mb-3 flex items-center justify-center bg-white rounded-lg shadow-sm group-hover:shadow text-primary-600 peer-checked:text-white peer-checked:bg-primary-600 transition-all duration-200">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <span class="font-medium text-gray-900 text-center group-hover:text-primary-600 transition-colors duration-200">Startups</span>
                        </label>

                        <label class="relative flex flex-col items-center p-4 bg-white border-2 border-primary-500/20 rounded-xl cursor-pointer hover:border-primary-500 transition-colors duration-200 group">
                            <input type="checkbox" name="interests[]" value="tech" class="sr-only peer">
                            <div class="w-12 h-12 mb-3 flex items-center justify-center bg-white rounded-lg shadow-sm group-hover:shadow text-primary-600 peer-checked:text-white peer-checked:bg-primary-600 transition-all duration-200">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <span class="font-medium text-gray-900 text-center group-hover:text-primary-600 transition-colors duration-200">Tech</span>
                        </label>

                        <label class="relative flex flex-col items-center p-4 bg-white border-2 border-primary-500/20 rounded-xl cursor-pointer hover:border-primary-500 transition-colors duration-200 group">
                            <input type="checkbox" name="interests[]" value="events" class="sr-only peer">
                            <div class="w-12 h-12 mb-3 flex items-center justify-center bg-white rounded-lg shadow-sm group-hover:shadow text-primary-600 peer-checked:text-white peer-checked:bg-primary-600 transition-all duration-200">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <span class="font-medium text-gray-900 text-center group-hover:text-primary-600 transition-colors duration-200">Événements</span>
                        </label>

                        <label class="relative flex flex-col items-center p-4 bg-white border-2 border-primary-500/20 rounded-xl cursor-pointer hover:border-primary-500 transition-colors duration-200 group">
                            <input type="checkbox" name="interests[]" value="formation" class="sr-only peer">
                            <div class="w-12 h-12 mb-3 flex items-center justify-center bg-white rounded-lg shadow-sm group-hover:shadow text-primary-600 peer-checked:text-white peer-checked:bg-primary-600 transition-all duration-200">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <span class="font-medium text-gray-900 text-center group-hover:text-primary-600 transition-colors duration-200">Formation</span>
                        </label>
                    </div>
                </div>

                <!-- Bouton de soumission -->
                <div class="text-center">
                    <button type="submit" class="inline-flex items-center px-8 py-4 text-lg font-semibold rounded-xl text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-4 focus:ring-primary-500/50 transition-all duration-300 transform hover:-translate-y-0.5 hover:shadow-lg shadow-sm">
                        S'inscrire
                        <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <!-- Note de confidentialité -->
        <div class="mt-8 text-center">
            <p class="text-sm text-gray-600">En vous inscrivant, vous acceptez de recevoir nos communications. <br class="hidden sm:inline">Vous pourrez vous désinscrire à tout moment.</p>
        </div>
    </div>
</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('newsletter-form');
        const whatsappCheckbox = document.getElementById('newsletter_whatsapp');
        const whatsappField = document.querySelector('.newsletter-whatsapp-field');

        // Gestion de l'affichage du champ WhatsApp
        whatsappCheckbox.addEventListener('change', function() {
            whatsappField.classList.toggle('hidden', !this.checked);
        });

        // Gestion de la soumission du formulaire
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitButton = form.querySelector('button[type="submit"]');
            const buttonText = submitButton.textContent;
            
            // Disable submit button and show loading state
            submitButton.disabled = true;
            submitButton.textContent = 'Envoi en cours...';
            
            fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    Toastify({
                        text: data.message,
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        style: {
                            background: "#059669",
                        },
                        close: true
                    }).showToast();
                    
                    // Reset form
                    form.reset();
                    whatsappField.classList.add('hidden');
                } else {
                    throw new Error(data.message || 'Une erreur est survenue');
                }
            })
            .catch(error => {
                Toastify({
                    text: error.message,
                    duration: 5000,
                    gravity: "top",
                    position: "right",
                    style: {
                        background: "#DC2626",
                    },
                    close: true
                }).showToast();
            })
            .finally(() => {
                // Reset button state
                submitButton.disabled = false;
                submitButton.textContent = buttonText;
            });
        });
    });
</script>
@endpush