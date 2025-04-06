<!-- Section Newsletter -->
<section class="relative py-24 overflow-hidden bg-gradient-to-br from-gray-50 to-gray-100 border-t border-gray-200">
    <!-- Éléments décoratifs -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden opacity-10 pointer-events-none">
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-primary-300 rounded-full filter blur-3xl"></div>
        <div class="absolute top-1/3 right-0 w-80 h-80 bg-primary-400 rounded-full filter blur-3xl"></div>
        <div class="absolute bottom-0 left-1/4 w-64 h-64 bg-secondary-300 rounded-full filter blur-3xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- En-tête -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="inline-block px-4 py-1.5 mb-6 text-sm font-semibold text-primary-700 bg-primary-100 rounded-full">Newsletter</span>
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Restez Connectés avec HIT !
            </h2>
            <p class="mt-4 text-xl text-gray-600 leading-relaxed">
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
            <form action="{{ route('newsletter.subscribe') }}" method="POST" class="space-y-8 bg-white rounded-2xl shadow-xl p-8 border border-gray-100 backdrop-blur-sm bg-white/90" id="newsletter-form">
                @csrf
                
                <!-- Options d'abonnement -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="relative group">
                        <label for="newsletter_name" class="block text-sm font-medium text-gray-700 mb-2">Nom complet</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-primary-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <input type="text" name="newsletter_name" id="newsletter_name" class="block w-full pl-11 pr-4 py-3.5 rounded-xl border border-gray-300 bg-white focus:ring-primary-500 focus:border-primary-500 focus:outline-none transition duration-200 placeholder-gray-400 shadow-sm" placeholder="Votre nom">
                        </div>
                    </div>

                    <div class="relative group">
                        <label for="newsletter_email_input" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-primary-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <input type="email" name="newsletter_email_input" id="newsletter_email_input" class="block w-full pl-11 pr-4 py-3.5 rounded-xl border border-gray-300 bg-white focus:ring-primary-500 focus:border-primary-500 focus:outline-none transition duration-200 placeholder-gray-400 shadow-sm" placeholder="votre@email.com">
                        </div>
                    </div>
                </div>

                <!-- Champ WhatsApp -->
                <div class="relative newsletter-whatsapp-field hidden group">
                    <label for="newsletter_whatsapp_input" class="block text-sm font-medium text-gray-700 mb-2">Numéro WhatsApp</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-green-500">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                        </div>
                        <input type="tel" name="newsletter_whatsapp_input" id="newsletter_whatsapp_input" class="block w-full pl-11 pr-4 py-3.5 rounded-xl border border-gray-300 bg-white focus:ring-green-500 focus:border-green-500 focus:outline-none transition duration-200 placeholder-gray-400 shadow-sm " placeholder="+225 XX XX XX XX XX">
                    </div>
                </div>

                <!-- Options de notification -->
                <div class="space-y-6">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        Options de notification
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="relative p-5 bg-white border border-gray-300 rounded-xl transition-all duration-200 group cursor-pointer">
                            <div class="flex justify-between items-center mb-2">
                                <label for="newsletter_email" class="font-semibold text-gray-900 group-hover:text-primary-600 transition-colors duration-200 cursor-pointer">Newsletter Email</label>
                                <div class="relative inline-flex h-6 w-11 items-center rounded-full bg-gray-200 p-1 transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                                    <input type="checkbox" id="newsletter_email" name="newsletter_email" checked class="sr-only" />
                                    <span aria-hidden="true" class="pointer-events-none h-4 w-4 transform rounded-full bg-white shadow-md ring-0 transition duration-300 ease-in-out peer-checked:translate-x-5 translate-x-0"></span>
                                    <span class="absolute inset-0 cursor-pointer"></span>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm">Actualités hebdomadaires et opportunités</p>
                        </div>

                        <div class="relative p-5 bg-white border rounded-2 transition-all duration-200 group cursor-pointer">
                            <div class="flex justify-between items-center mb-2">
                                <label for="newsletter_whatsapp" class="font-semibold text-gray-900 group-hover:text-green-600 transition-colors duration-200 cursor-pointer">Alertes WhatsApp</label>
                                <div class="relative inline-flex h-6 w-11 items-center rounded-full bg-gray-200 p-1 transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                    <input type="checkbox" id="newsletter_whatsapp" name="newsletter_whatsapp" class="sr-only" />
                                    <span aria-hidden="true" class="pointer-events-none h-4 w-4 transform rounded-full bg-white shadow-md ring-0 transition duration-300 ease-in-out peer-checked:translate-x-5 translate-x-0"></span>
                                    <span class="absolute inset-0 cursor-pointer" id="whatsapp-toggle-button"></span>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm">Notifications d'événements et rappels</p>
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
                                // Inverser l'état du checkbox
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
                            
                            // Gestion du changement direct du checkbox
                            whatsappToggle.addEventListener('change', toggleWhatsappField);
                            
                            // Initialisation de l'état au chargement de la page
                            toggleWhatsappField();
                            
                            // Gestion du toggle Email (inchangé)
                            const emailToggle = document.querySelector('#newsletter_email');
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
                        Centres d'intérêt
                    </h3>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        @php
                            use App\Enums\AudienceType;
                            $audienceTypes = AudienceType::cases();
                        @endphp
                        
                        @foreach($audienceTypes as $type)
                        <label class="relative flex flex-col items-center p-4 bg-white border-2 border-primary-500/20 rounded-xl cursor-pointer hover:border-primary-500 hover:shadow-md transition-all duration-200 group">
                            <input type="checkbox" name="interests[]" value="{{ $type->value }}" class="sr-only peer">
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
                <button type="submit" class="px-6 py-3 bg-primary-500 text-white font-semibold rounded-xl hover:bg-primary-600 transition duration-200 shadow-md hover:shadow-lg">S'abonner</button>
            </form>
        </div>

        <!-- Note de confidentialité -->
        <div class="mt-8 text-center">
            <p class="text-sm text-gray-600 max-w-xl mx-auto">En vous inscrivant, vous acceptez de recevoir nos communications selon vos préférences. <br class="hidden sm:inline">Vous pourrez vous désinscrire à tout moment en cliquant sur le lien présent dans nos emails.</p>
            <div class="flex items-center justify-center mt-4 space-x-4">
                <span class="flex items-center text-gray-500 text-sm">
                    <svg class="w-4 h-4 mr-1 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    Données sécurisées
                </span>
                <span class="flex items-center text-gray-500 text-sm">
                    <svg class="w-4 h-4 mr-1 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    Confidentialité respectée
                </span>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('newsletter-form');
        const whatsappToggle = document.getElementById('newsletter_whatsapp');
        const whatsappField = document.querySelector('.newsletter-whatsapp-field');
        const whatsappToggleBtn = document.getElementById('whatsapp-toggle-button');
        
        // Fonction pour gérer l'affichage du champ WhatsApp
        function toggleWhatsappField() {
            const isChecked = whatsappToggle.checked;
            const toggleCircle = whatsappToggleBtn.previousElementSibling;
            const toggleBg = whatsappToggleBtn.parentElement;
            
            // Mettre à jour l'état visuel du toggle
            if (isChecked) {
                toggleCircle.classList.add('translate-x-5');
                toggleBg.classList.add('bg-green-500');
                toggleBg.classList.remove('bg-gray-200');
                whatsappField.classList.remove('hidden');
            } else {
                toggleCircle.classList.remove('translate-x-5');
                toggleBg.classList.remove('bg-green-500');
                toggleBg.classList.add('bg-gray-200');
                whatsappField.classList.add('hidden');
            }
        }
        
        // Initialiser l'état du champ WhatsApp au chargement
        toggleWhatsappField();
        
        // Ajouter l'écouteur d'événement pour le toggle WhatsApp
        whatsappToggleBtn.addEventListener('click', function() {
            whatsappToggle.checked = !whatsappToggle.checked;
            toggleWhatsappField();
        });
        
        // Écouter également les changements directs sur la checkbox
        whatsappToggle.addEventListener('change', toggleWhatsappField);
        
        // Gestion du toggle Email
        const emailToggle = document.getElementById('newsletter_email');
        const emailToggleBtn = emailToggle.nextElementSibling.nextElementSibling;
        
        emailToggleBtn.addEventListener('click', function() {
            emailToggle.checked = !emailToggle.checked;
            const toggleCircle = emailToggleBtn.previousElementSibling;
            const toggleBg = emailToggleBtn.parentElement;
            
            if (emailToggle.checked) {
                toggleCircle.classList.add('translate-x-5');
                toggleBg.classList.add('bg-primary-500');
                toggleBg.classList.remove('bg-gray-200');
            } else {
                toggleCircle.classList.remove('translate-x-5');
                toggleBg.classList.remove('bg-primary-500');
                toggleBg.classList.add('bg-gray-200');
            }
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