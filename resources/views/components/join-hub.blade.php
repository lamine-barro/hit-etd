<section class="relative py-24 bg-gradient-to-b from-gray-50/50 to-white overflow-hidden" id="campus">
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h1 class="text-5xl sm:text-6xl font-extrabold text-gray-900 mb-6 tracking-tight drop-shadow-lg">{{ __("Rejoindre le Hub") }}</h1>
            <p class="text-xl sm:text-2xl text-gray-600 max-w-3xl mx-auto">{{ __("Planifiez une visite de notre campus (sur rendez-vous uniquement)") }} {{ config('hit.name') }}</p>
        </div>
    </div>

    <div class="mb-16 flex justify-center">
        <nav class="inline-flex rounded-2xl shadow-2xl bg-white/90 border border-gray-200 overflow-hidden relative backdrop-blur-xl" x-data="{ tab: window.location.hash === '#resident-join' ? 'resident' : 'expert' }">
            <template x-for="(item, idx) in [{label: 'Devenir Expert', icon: 'user-plus', value: 'expert'}, {label: 'Devenir Résident', icon: 'users', value: 'resident'}]" :key="item.value">
                <button type="button"
                    @click="tab = item.value; window.location.hash = item.value === 'expert' ? '#export-join' : '#resident-join'"
                    :class="tab === item.value ? 'bg-gradient-to-r from-orange-500 to-primary-500 text-white shadow-lg scale-105 z-10' : 'bg-white text-gray-700 hover:bg-gray-50 focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 focus:outline-none'"
                    class="relative px-8 py-4 font-semibold transition-all duration-300 flex items-center justify-center gap-2 text-lg sm:text-xl min-w-[160px]">
                    <template x-if="item.icon === 'user-plus'">
                        <svg x-show="item.icon === 'user-plus'" class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 21v-2a4 4 0 00-3-3.87M12 7a4 4 0 110-8 4 4 0 010 8zm6 8v-2a4 4 0 00-3-3.87M6 21v-2a4 4 0 013-3.87" /></svg>
                    </template>
                    <template x-if="item.icon === 'users'">
                        <svg x-show="item.icon === 'users'" class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    </template>
                    <span x-text="item.label"></span>
                </button>
            </template>
            <div class="absolute bottom-0 left-0 w-1/2 h-1 bg-gradient-to-r from-orange-500 to-primary-500 transition-all duration-300" :style="tab === 'resident' ? 'transform: translateX(100%);' : 'transform: translateX(0);'"></div>
        </nav>
    </div>
</section>

<div x-data="{ tab: window.location.hash === '#resident-join' ? 'resident' : 'expert' }"
     x-init="$watch('tab', t => { if(t === 'expert'){ document.getElementById('campus').scrollIntoView({behavior: 'smooth'}); } else { document.getElementById('resident-join').scrollIntoView({behavior: 'smooth'}); } })">
    <div x-show="tab === 'expert'" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
        <section id="export-join" class="relative">
            <div class="absolute inset-0 pointer-events-none">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(0,0,0,0.02)_0%,rgba(0,0,0,0)_100%)]"></div>
            </div>
            <div class="max-w-4xl mx-auto bg-white/95 backdrop-blur-2xl rounded-3xl shadow-2xl border border-gray-100/70 mt-20 overflow-hidden relative">
                <div class="p-6 sm:p-12 md:p-16">
                    <div class="text-center mb-12">
                        <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 mb-4 tracking-tight">Devenir Expert</h1>
                        <p class="text-xl text-gray-600">Rejoignez notre communauté de résidents et accédez à nos espaces, services et opportunités.</p>
                    </div>
                    <div class="space-y-6 relative">
                        @include('components.forms.expert-form')
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div x-show="tab === 'resident'" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
        <section id="resident-join" class="relative">
            <div class="absolute inset-0 pointer-events-none">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(0,0,0,0.02)_0%,rgba(0,0,0,0)_100%)]"></div>
            </div>
            <div class="max-w-4xl mx-auto bg-white/95 backdrop-blur-2xl rounded-3xl shadow-2xl border border-gray-100/70 mt-20 overflow-hidden relative">
                <div class="p-6 sm:p-12 md:p-16">
                    <div class="text-center mb-12">
                        <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 mb-4 tracking-tight">Devenir Résident</h1>
                        <p class="text-xl text-gray-600">Rejoignez notre communauté de résidents et accédez à nos espaces, services et opportunités.</p>
                    </div>
                    <div class="space-y-6 relative">
                        <div class="max-w-2xl mx-auto">
                            @include('components.forms.resident-form')
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // AJAX for expert form
    const expertForm = document.getElementById('expert-form');
    if (expertForm) {
        expertForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(expertForm);
            const submitButton = expertForm.querySelector('button[type="submit"]');
            const originalContent = submitButton.innerHTML;

            // Create loading state
            submitButton.disabled = true;
            submitButton.innerHTML = `
                <div class=\"flex items-center gap-2\">
                    <svg class=\"animate-spin h-5 w-5 text-primary-500\" xmlns=\"http://www.w3.org/2000/svg\" fill=\"none\" viewBox=\"0 0 24 24\">
                        <circle class=\"opacity-25\" cx=\"12\" cy=\"12\" r=\"10\" stroke=\"currentColor\" stroke-width=\"4\"></circle>
                        <path class=\"opacity-75\" fill=\"currentColor\" d=\"M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z\"></path>
                    </svg>
                    Envoi en cours...
                </div>
            `;

            // Add loading overlay
            let loadingOverlay = expertForm.closest('.space-y-6').querySelector('.form-loading-overlay');
            if (!loadingOverlay) {
                loadingOverlay = document.createElement('div');
                loadingOverlay.className = 'form-loading-overlay absolute inset-0 bg-gray-900/40 z-20 flex items-center justify-center rounded-2xl animate-fade-in';
                expertForm.closest('.space-y-6').appendChild(loadingOverlay);
            }

            fetch(expertForm.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                loadingOverlay.remove();

                // Remove any previous messages
                expertForm.parentNode.querySelectorAll('.form-feedback-message').forEach(el => el.remove());

                if (data.success) {
                    const successMessage = document.createElement('div');
                    successMessage.className = 'form-feedback-message p-4 mb-4 text-base text-green-800 bg-green-100 rounded-xl shadow transition-all duration-500 animate-fade-in';
                    successMessage.innerHTML = `<div class='flex items-center gap-2'><svg class='w-6 h-6 text-green-500' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 13l4 4L19 7' /></svg> <span>Votre demande a été envoyée avec succès !</span></div>`;
                    expertForm.parentNode.insertBefore(successMessage, expertForm);
                    setTimeout(() => {
                        successMessage.classList.add('opacity-0', 'translate-y-4');
                        setTimeout(() => successMessage.remove(), 500);
                    }, 5000);
                    expertForm.reset();
                } else {
                    const errorMessage = document.createElement('div');
                    errorMessage.className = 'form-feedback-message p-4 mb-4 text-base text-red-800 bg-red-100 rounded-xl shadow transition-all duration-500 animate-fade-in';
                    errorMessage.innerHTML = `<div class='flex items-center gap-2'><svg class='w-6 h-6 text-red-500' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M6 18L18 6M6 6l12 12' /></svg> <span>${data.message || 'Une erreur est survenue. Veuillez réessayer.'}</span></div>`;
                    expertForm.parentNode.insertBefore(errorMessage, expertForm);
                    setTimeout(() => {
                        errorMessage.classList.add('opacity-0', 'translate-y-4');
                        setTimeout(() => errorMessage.remove(), 500);
                    }, 5000);
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                loadingOverlay.remove();
                expertForm.parentNode.querySelectorAll('.form-feedback-message').forEach(el => el.remove());
                const errorMessage = document.createElement('div');
                errorMessage.className = 'form-feedback-message p-4 mb-4 text-base text-red-800 bg-red-100 rounded-xl shadow transition-all duration-500 animate-fade-in';
                errorMessage.innerHTML = `<div class='flex items-center gap-2'><svg class='w-6 h-6 text-red-500' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M6 18L18 6M6 6l12 12' /></svg> <span>Une erreur est survenue. Veuillez réessayer.</span></div>`;
                expertForm.parentNode.insertBefore(errorMessage, expertForm);
                setTimeout(() => {
                    errorMessage.classList.add('opacity-0', 'translate-y-4');
                    setTimeout(() => errorMessage.remove(), 500);
                }, 5000);
            })
            .finally(() => {
                submitButton.disabled = false;
                submitButton.innerHTML = originalContent;
            });
        });
    }
});
</script>

<style>
@media (max-width: 640px) {
    nav.inline-flex > button {
        min-width: 120px !important;
        font-size: 1rem !important;
        padding-left: 1.25rem !important;
        padding-right: 1.25rem !important;
        padding-top: 0.75rem !important;
        padding-bottom: 0.75rem !important;
    }
}
@keyframes fade-in {
    from { opacity: 0; transform: translateY(16px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in {
    animation: fade-in 0.5s cubic-bezier(0.4,0,0.2,1) both;
}
</style>
