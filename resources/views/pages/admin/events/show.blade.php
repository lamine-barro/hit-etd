@extends('pages.admin.layouts.app')

@section('title', $event->getTranslatedAttribute('title'))
@section('page-title', 'Détails de l\'événement')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- En-tête -->
    <div class="mb-8">
        <div class="flex items-center space-x-3 text-sm text-gray-500 mb-4">
            <a href="{{ route('admin.events.index') }}" class="hover:text-primary transition-colors">Événements</a>
            <i data-lucide="chevron-right" class="h-4 w-4"></i>
            <span class="text-gray-900">{{ Str::limit($event->getTranslatedAttribute('title'), 50) }}</span>
        </div>
        
        <div class="flex items-start justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900 font-poppins">{{ $event->getTranslatedAttribute('title') }}</h1>
                <div class="mt-2 flex items-center gap-x-4 text-sm text-gray-500">
                    <div class="flex items-center gap-x-1">
                        <i data-lucide="calendar" class="h-4 w-4"></i>
                        <span>Du {{ $event->start_date->format('d/m/Y à H:i') }} au {{ $event->end_date->format('d/m/Y à H:i') }}</span>
                    </div>
                    <div class="flex items-center gap-x-1">
                        <i data-lucide="map-pin" class="h-4 w-4"></i>
                        <span>{{ $event->getTranslatedAttribute('location') }}{{ $event->is_remote ? ' (En ligne)' : '' }}</span>
                    </div>
                    <div class="flex items-center gap-x-1">
                        <i data-lucide="users" class="h-4 w-4"></i>
                        <span>{{ $event->registrations->count() }} participant{{ $event->registrations->count() > 1 ? 's' : '' }}</span>
                    </div>
                </div>
            </div>
            
            <div class="flex items-center gap-x-3">
                <a href="{{ route('admin.events.edit', $event) }}" 
                   class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 transition-colors font-poppins">
                    <i data-lucide="edit" class="h-4 w-4 mr-2"></i>
                    Modifier
                </a>
                <button type="button" 
                        onclick="openConfirmModal('{{ route('admin.events.destroy', $event) }}', 'Êtes-vous sûr de vouloir supprimer cet événement ?', 'delete', 'DELETE')"
                        class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-red-50 hover:text-red-700 hover:ring-red-300 transition-colors font-poppins">
                    <i data-lucide="trash-2" class="h-4 w-4 mr-2"></i>
                    Supprimer
                </button>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- Contenu principal -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Image d'illustration -->
            @if($event->illustration)
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl overflow-hidden">
                <img src="{{ asset('storage/' . $event->illustration) }}" 
                     alt="{{ $event->getTranslatedAttribute('title') }}" 
                     class="w-full h-auto">
            </div>
            @endif

            <!-- Description de l'événement -->
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
                <div class="px-4 py-6 sm:p-8">
                    <div class="mb-6">
                        <h2 class="text-lg font-semibold text-gray-900 font-poppins mb-3">Description</h2>
                        <div class="prose max-w-none text-gray-700">
                            {!! nl2br(e($event->getTranslatedAttribute('description'))) !!}
                        </div>
                    </div>
                    
                    @if($event->getTranslatedAttribute('agenda'))
                    <div class="border-t border-gray-200 pt-6">
                        <h2 class="text-lg font-semibold text-gray-900 font-poppins mb-3">Programme</h2>
                        <div class="prose max-w-none text-gray-700">
                            {!! nl2br(e($event->getTranslatedAttribute('agenda'))) !!}
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Liste des participants -->
            @if($event->registrations->count() > 0)
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
                <div class="px-4 py-6 sm:p-8">
                    <h2 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Participants inscrits ({{ $event->registrations->count() }})</h2>
                    <div class="grid grid-cols-1 gap-4">
                        @foreach($event->registrations->take(12) as $registration)
                        <div class="flex items-center justify-between p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors cursor-pointer" onclick="openRegistrationModal({{ $registration->id }})">
                            <div class="flex items-center space-x-3">
                                <div class="h-8 w-8 rounded-full bg-primary text-white flex items-center justify-center text-sm font-semibold">
                                    @if($registration->user)
                                        {{ strtoupper(substr($registration->user->name, 0, 1)) }}
                                    @else
                                        {{ strtoupper(substr($registration->name, 0, 1)) }}
                                    @endif
                                </div>
                                <div>
                                    @if($registration->user)
                                        <p class="text-sm font-medium text-gray-900">{{ $registration->user->name }}</p>
                                    @else
                                        <p class="text-sm font-medium text-gray-900">{{ $registration->name }}</p>
                                    @endif
                                    <p class="text-xs text-gray-500">{{ $registration->created_at->format('d/m/Y') }}</p>
                                </div>
                            </div>
                            <button type="button" onclick="event.stopPropagation(); deleteRegistration({{ $registration->id }})" class="inline-flex items-center p-1.5 text-gray-400 hover:text-red-600 rounded-md hover:bg-red-50 transition-colors" title="Supprimer l'inscription">
                                <i data-lucide="trash-2" class="h-4 w-4"></i>
                            </button>
                        </div>
                        @endforeach
                        
                        @if($event->registrations->count() > 12)
                        <div class="text-sm text-gray-500">
                            et {{ $event->registrations->count() - 12 }} autre{{ $event->registrations->count() - 12 > 1 ? 's' : '' }}...
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            
            <!-- Informations -->
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
                <div class="px-4 py-6 sm:p-6">
                    <h3 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Informations</h3>
                    
                    <dl class="space-y-4">
                        <!-- Statut -->
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Statut</dt>
                            <dd class="mt-1">
                                @switch($event->status?->value)
                                    @case('draft')
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                            Brouillon
                                        </span>
                                        @break
                                    @case('published')
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            Publié
                                        </span>
                                        @break
                                    @case('cancelled')
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                            Annulé
                                        </span>
                                        @break
                                    @default
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                            {{ $event->status?->value ?? 'Non défini' }}
                                        </span>
                                @endswitch
                            </dd>
                        </div>

                        <!-- Type -->
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Type d'événement</dt>
                            <dd class="mt-1">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                    {{ ucfirst($event->type) }}
                                </span>
                            </dd>
                        </div>

                        <!-- Prix -->
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Tarification</dt>
                            <dd class="mt-1">
                                @if($event->is_paid)
                                    <div>
                                        <span class="text-lg font-semibold text-gray-900">{{ number_format($event->getCurrentPrice(), 0, ',', ' ') }} {{ $event->currency ?? 'FCFA' }}</span>
                                        @if($event->early_bird_price && $event->early_bird_end_date)
                                        <div class="text-xs text-gray-500 mt-1">
                                            Early bird: {{ number_format($event->early_bird_price, 0, ',', ' ') }} {{ $event->currency ?? 'FCFA' }}
                                            (jusqu'au {{ $event->early_bird_end_date->format('d/m/Y') }})
                                        </div>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-green-600 font-medium">Gratuit</span>
                                @endif
                            </dd>
                        </div>

                        <!-- Capacité -->
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Participants</dt>
                            <dd class="mt-1">
                                @if($event->max_participants)
                                    <span class="text-sm text-gray-900">
                                        {{ $event->registrations->count() }} / {{ $event->max_participants }}
                                        @if($event->isFull())
                                            <span class="text-red-600 font-medium">Complet</span>
                                        @endif
                                    </span>
                                @else
                                    <span class="text-sm text-gray-900">{{ $event->registrations->count() }} / Illimité</span>
                                @endif
                            </dd>
                        </div>

                        <!-- Date de création -->
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Créé le</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ $event->created_at->format('d/m/Y à H:i') }}
                            </dd>
                        </div>

                        <!-- Dernière modification -->
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Modifié le</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ $event->updated_at->format('d/m/Y à H:i') }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Tags -->
            @if($event->tags && count($event->tags) > 0)
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
                <div class="px-4 py-6 sm:p-6">
                    <h3 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Tags</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($event->tags as $tag)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                {{ $tag }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Actions rapides -->
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
                <div class="px-4 py-6 sm:p-6">
                    <h3 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Actions rapides</h3>
                    <div class="space-y-3">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Inclure le modal de suppression -->
@include('pages.admin.components.delete-modal')

<!-- Modal des détails de l'inscription -->
<div id="registrationModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 text-center">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" onclick="closeRegistrationModal()"></div>
        
        <div class="relative inline-block w-full max-w-md p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-xl">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium leading-6 text-gray-900 font-poppins">Détails de l'inscription</h3>
                <button type="button" class="text-gray-400 hover:text-gray-600" onclick="closeRegistrationModal()">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            
            <div id="registrationDetails" class="space-y-3">
                <!-- Les détails seront chargés ici -->
            </div>
        </div>
    </div>
</div>

<script>
// Données des inscriptions pour éviter les requêtes AJAX
const registrations = {
    @foreach($event->registrations as $registration)
    {{ $registration->id }}: {
        id: {{ $registration->id }},
        name: "{{ $registration->name }}",
        email: "{{ $registration->email }}",
        whatsapp: "{{ $registration->whatsapp ?? '' }}",
        position: "{{ $registration->position ?? '' }}",
        organization: "{{ $registration->organization ?? '' }}",
        country: "{{ $registration->country ?? '' }}",
        actor_type: "{{ $registration->actor_type ?? '' }}",
        status: "{{ $registration->status }}",
        payment_status: "{{ $registration->payment_status ?? '' }}",
        amount_paid: "{{ $registration->amount_paid ?? 0 }}",
        created_at: "{{ $registration->created_at->format('d/m/Y H:i') }}"
    },
    @endforeach
};

function openRegistrationModal(registrationId) {
    const registration = registrations[registrationId];
    if (!registration) return;
    
    const detailsHtml = `
        <div class="grid grid-cols-2 gap-3 text-sm">
            <div class="font-medium text-gray-900">Nom:</div>
            <div class="text-gray-600">${registration.name}</div>
            
            <div class="font-medium text-gray-900">Email:</div>
            <div class="text-gray-600">${registration.email}</div>
            
            ${registration.whatsapp ? `
                <div class="font-medium text-gray-900">WhatsApp:</div>
                <div class="text-gray-600">${registration.whatsapp}</div>
            ` : ''}
            
            ${registration.position ? `
                <div class="font-medium text-gray-900">Position:</div>
                <div class="text-gray-600">${registration.position}</div>
            ` : ''}
            
            ${registration.organization ? `
                <div class="font-medium text-gray-900">Organisation:</div>
                <div class="text-gray-600">${registration.organization}</div>
            ` : ''}
            
            ${registration.country ? `
                <div class="font-medium text-gray-900">Pays:</div>
                <div class="text-gray-600">${registration.country}</div>
            ` : ''}
            
            ${registration.actor_type ? `
                <div class="font-medium text-gray-900">Type d'acteur:</div>
                <div class="text-gray-600">${registration.actor_type}</div>
            ` : ''}
            
            <div class="font-medium text-gray-900">Statut:</div>
            <div class="text-gray-600">${registration.status}</div>
            
            ${registration.payment_status ? `
                <div class="font-medium text-gray-900">Paiement:</div>
                <div class="text-gray-600">${registration.payment_status} (${registration.amount_paid}€)</div>
            ` : ''}
            
            <div class="font-medium text-gray-900">Inscrit le:</div>
            <div class="text-gray-600">${registration.created_at}</div>
        </div>
    `;
    
    document.getElementById('registrationDetails').innerHTML = detailsHtml;
    document.getElementById('registrationModal').classList.remove('hidden');
}

function closeRegistrationModal() {
    document.getElementById('registrationModal').classList.add('hidden');
}

function deleteRegistration(registrationId) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette inscription ?')) {
        // Créer un formulaire pour supprimer l'inscription
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/event-registrations/${registrationId}`;
        
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        
        form.appendChild(csrfInput);
        form.appendChild(methodInput);
        document.body.appendChild(form);
        form.submit();
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Initialiser les icônes Lucide
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
});
</script>
@endsection