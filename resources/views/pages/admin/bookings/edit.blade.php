@extends('pages.admin.layouts.app')

@section('title', 'Modifier la demande de visite')
@section('page-title', 'Modifier la demande de visite')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- En-tête -->
    <div class="mb-8">
        <div class="flex items-center space-x-3 text-sm text-gray-500 mb-4">
            <a href="{{ route('admin.bookings.index') }}" class="hover:text-primary transition-colors">Demandes de visite</a>
            <i data-lucide="chevron-right" class="h-4 w-4"></i>
            <a href="{{ route('admin.bookings.show', $booking) }}" class="hover:text-primary transition-colors">{{ Str::limit($booking->full_name, 30) }}</a>
            <i data-lucide="chevron-right" class="h-4 w-4"></i>
            <span class="text-gray-900">Modifier</span>
        </div>
        <h1 class="text-2xl font-semibold text-gray-900 font-poppins">Modifier la demande de visite</h1>
        <p class="mt-2 text-sm text-gray-600">Modifiez les informations de la demande de visite ci-dessous.</p>
    </div>

    <!-- Formulaire -->
    <form action="{{ route('admin.bookings.update', $booking) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        
        <!-- Card principale -->
        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
            <div class="px-4 py-6 sm:p-8">
                <div class="grid grid-cols-1 gap-6">
                    
                    <!-- Informations du visiteur -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Informations du visiteur</h3>
                        
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <!-- Nom complet -->
                            <div>
                                <label for="full_name" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                    Nom complet <span class="text-red-500">*</span>
                                </label>
                                <div class="mt-2">
                                    <input type="text" 
                                           name="full_name" 
                                           id="full_name" 
                                           required
                                           class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('full_name') ring-red-500 @enderror"
                                           value="{{ old('full_name', $booking->full_name) }}"
                                           placeholder="Ex: Jean Dupont">
                                    @error('full_name')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <div class="mt-2">
                                    <input type="email" 
                                           name="email" 
                                           id="email" 
                                           required
                                           class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('email') ring-red-500 @enderror"
                                           value="{{ old('email', $booking->email) }}"
                                           placeholder="jean.dupont@email.com">
                                    @error('email')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Téléphone -->
                            <div>
                                <label for="phone" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                    Téléphone <span class="text-red-500">*</span>
                                </label>
                                <div class="mt-2">
                                    <input type="tel" 
                                           name="phone" 
                                           id="phone" 
                                           required
                                           class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('phone') ring-red-500 @enderror"
                                           value="{{ old('phone', $booking->phone) }}"
                                           placeholder="+225 XX XX XX XX XX">
                                    @error('phone')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Organisation -->
                            <div>
                                <label for="organization" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                    Organisation
                                </label>
                                <div class="mt-2">
                                    <input type="text" 
                                           name="organization" 
                                           id="organization" 
                                           class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('organization') ring-red-500 @enderror"
                                           value="{{ old('organization', $booking->organization) }}"
                                           placeholder="Nom de l'entreprise ou organisation">
                                    @error('organization')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Détails de la visite -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Détails de la visite</h3>
                        
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <!-- Date de visite -->
                            <div>
                                <label for="date" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                    Date de visite <span class="text-red-500">*</span>
                                </label>
                                <div class="mt-2">
                                    <input type="date" 
                                           name="date" 
                                           id="date" 
                                           required
                                           min="{{ now()->format('Y-m-d') }}"
                                           class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('date') ring-red-500 @enderror"
                                           value="{{ old('date', $booking->date ? $booking->date->format('Y-m-d') : '') }}">
                                    @error('date')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Heure de visite -->
                            <div>
                                <label for="time" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                    Heure préférée <span class="text-red-500">*</span>
                                </label>
                                <div class="mt-2">
                                    <select name="time" 
                                            id="time" 
                                            required
                                            class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('time') ring-red-500 @enderror">
                                        <option value="">Sélectionnez une heure</option>
                                        <option value="09:00" {{ old('time', $booking->time) == '09:00' ? 'selected' : '' }}>09:00</option>
                                        <option value="10:00" {{ old('time', $booking->time) == '10:00' ? 'selected' : '' }}>10:00</option>
                                        <option value="11:00" {{ old('time', $booking->time) == '11:00' ? 'selected' : '' }}>11:00</option>
                                        <option value="14:00" {{ old('time', $booking->time) == '14:00' ? 'selected' : '' }}>14:00</option>
                                        <option value="15:00" {{ old('time', $booking->time) == '15:00' ? 'selected' : '' }}>15:00</option>
                                        <option value="16:00" {{ old('time', $booking->time) == '16:00' ? 'selected' : '' }}>16:00</option>
                                    </select>
                                    @error('time')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Nombre de visiteurs -->
                            <div>
                                <label for="visitors_count" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                    Nombre de visiteurs
                                </label>
                                <div class="mt-2">
                                    <input type="number" 
                                           name="visitors_count" 
                                           id="visitors_count" 
                                           min="1"
                                           max="20"
                                           class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('visitors_count') ring-red-500 @enderror"
                                           value="{{ old('visitors_count', $booking->visitors_count ?? 1) }}"
                                           placeholder="1">
                                    @error('visitors_count')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Type de visite -->
                            <div>
                                <label for="visit_type" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                    Type de visite
                                </label>
                                <div class="mt-2">
                                    <select name="visit_type" 
                                            id="visit_type" 
                                            class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('visit_type') ring-red-500 @enderror">
                                        <option value="">Sélectionnez un type</option>
                                        <option value="discovery" {{ old('visit_type', $booking->visit_type) == 'discovery' ? 'selected' : '' }}>Visite découverte</option>
                                        <option value="business" {{ old('visit_type', $booking->visit_type) == 'business' ? 'selected' : '' }}>Visite d'affaires</option>
                                        <option value="partnership" {{ old('visit_type', $booking->visit_type) == 'partnership' ? 'selected' : '' }}>Partenariat</option>
                                        <option value="investment" {{ old('visit_type', $booking->visit_type) == 'investment' ? 'selected' : '' }}>Investissement</option>
                                        <option value="other" {{ old('visit_type', $booking->visit_type) == 'other' ? 'selected' : '' }}>Autre</option>
                                    </select>
                                    @error('visit_type')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Espaces d'intérêt -->
                    <div class="border-b border-gray-200 pb-6">
                        <label class="block text-sm font-medium leading-6 text-gray-900 font-poppins mb-4">
                            Espaces d'intérêt
                        </label>
                        @php
                            $spaces_options = [
                                'Espace coworking',
                                'Salle de réunion',
                                'Salle de formation',
                                'Bureau privé',
                                'Salle de conférence',
                                'Espace événementiel',
                                'Laboratoire',
                                'Studio',
                            ];
                            
                            $current_spaces = $booking->spaces;
                            if (is_string($current_spaces)) {
                                $current_spaces = json_decode($current_spaces, true) ?: [];
                            }
                            if (!is_array($current_spaces)) {
                                $current_spaces = [];
                            }
                        @endphp
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                            @foreach($spaces_options as $space)
                                <div class="flex items-center">
                                    <input type="checkbox" 
                                           name="spaces[]" 
                                           id="space_{{ Str::slug($space) }}" 
                                           value="{{ $space }}"
                                           {{ (is_array(old('spaces')) && in_array($space, old('spaces'))) || (!old('spaces') && in_array($space, $current_spaces)) ? 'checked' : '' }}
                                           class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary">
                                    <label for="space_{{ Str::slug($space) }}" class="ml-3 text-sm font-medium text-gray-700 font-poppins">
                                        {{ $space }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('spaces')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Objectif et message -->
                    <div>
                        <!-- Objectif -->
                        <div class="mb-6">
                            <label for="purpose" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                Objectif de la visite <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-2">
                                <select name="purpose" 
                                        id="purpose" 
                                        required
                                        class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('purpose') ring-red-500 @enderror">
                                    <option value="">Sélectionnez un objectif</option>
                                    <option value="Découvrir l'écosystème" {{ old('purpose', $booking->purpose) == "Découvrir l'écosystème" ? 'selected' : '' }}>Découvrir l'écosystème</option>
                                    <option value="Explorer les espaces disponibles" {{ old('purpose', $booking->purpose) == "Explorer les espaces disponibles" ? 'selected' : '' }}>Explorer les espaces disponibles</option>
                                    <option value="Rencontrer des startups" {{ old('purpose', $booking->purpose) == "Rencontrer des startups" ? 'selected' : '' }}>Rencontrer des startups</option>
                                    <option value="Évaluer les opportunités de partenariat" {{ old('purpose', $booking->purpose) == "Évaluer les opportunités de partenariat" ? 'selected' : '' }}>Évaluer les opportunités de partenariat</option>
                                    <option value="Considérer un investissement" {{ old('purpose', $booking->purpose) == "Considérer un investissement" ? 'selected' : '' }}>Considérer un investissement</option>
                                    <option value="Autre" {{ old('purpose', $booking->purpose) == "Autre" ? 'selected' : '' }}>Autre</option>
                                </select>
                                @error('purpose')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Message -->
                        <div class="mb-6">
                            <label for="message" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                Message ou demandes spéciales
                            </label>
                            <div class="mt-2">
                                <textarea name="message" 
                                          id="message" 
                                          rows="4" 
                                          class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('message') ring-red-500 @enderror"
                                          placeholder="Informations supplémentaires ou demandes spéciales...">{{ old('message', $booking->message) }}</textarea>
                                @error('message')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Statut -->
                        <div>
                            <label for="status" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                Statut <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-2">
                                <select name="status" 
                                        id="status" 
                                        required
                                        class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('status') ring-red-500 @enderror">
                                    <option value="pending" {{ old('status', $booking->status?->value) == 'pending' ? 'selected' : '' }}>En attente</option>
                                    <option value="confirmed" {{ old('status', $booking->status?->value) == 'confirmed' ? 'selected' : '' }}>Confirmé</option>
                                    <option value="cancelled" {{ old('status', $booking->status?->value) == 'cancelled' ? 'selected' : '' }}>Annulé</option>
                                </select>
                                @error('status')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between border-t border-gray-900/10 px-4 py-4 sm:px-8">
                <button type="button" 
                        onclick="openConfirmModal('{{ route('admin.bookings.destroy', $booking) }}', 'Êtes-vous sûr de vouloir supprimer cette demande de visite ?', 'delete', 'DELETE')"
                        class="inline-flex items-center text-sm font-semibold text-gray-600 hover:text-red-700 font-poppins transition-colors">
                    <i data-lucide="trash-2" class="h-4 w-4 mr-2"></i>
                    Supprimer la demande
                </button>
                
                <div class="flex items-center gap-x-3">
                    <a href="{{ route('admin.bookings.show', $booking) }}" 
                       class="text-sm font-semibold leading-6 text-gray-900 hover:text-gray-700 font-poppins transition-colors">
                        Annuler
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center rounded-md bg-primary px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-orange-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary transition-colors font-poppins">
                        <i data-lucide="save" class="h-4 w-4 mr-2"></i>
                        Enregistrer les modifications
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Inclure le modal de suppression -->
@include('pages.admin.components.delete-modal')

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialiser les icônes Lucide
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
});
</script>
@endsection