@extends('pages.admin.layouts.app')

@section('title', 'Créer un événement')
@section('page-title', 'Créer un événement')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- En-tête -->
    <div class="mb-8">
        <div class="flex items-center space-x-3 text-sm text-gray-500 mb-4">
            <a href="{{ route('admin.events.index') }}" class="hover:text-primary transition-colors">Événements</a>
            <i data-lucide="chevron-right" class="h-4 w-4"></i>
            <span class="text-gray-900">Nouvel événement</span>
        </div>
        <h1 class="text-2xl font-semibold text-gray-900 font-poppins">Créer un nouvel événement</h1>
        <p class="mt-2 text-sm text-gray-600">Remplissez les informations ci-dessous pour créer un nouvel événement.</p>
    </div>

    <!-- Formulaire -->
    <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <!-- Card principale -->
        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
            <div class="px-4 py-6 sm:p-8">
                <div class="grid grid-cols-1 gap-6">
                    
                    <!-- Titre français -->
                    <div>
                        <label for="title_fr" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                            Titre de l'événement (Français) <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-2">
                            <input type="text" 
                                   name="title_fr" 
                                   id="title_fr" 
                                   required
                                   class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('title_fr') ring-red-500 @enderror"
                                   value="{{ old('title_fr') }}"
                                   placeholder="Entrez le titre en français">
                            @error('title_fr')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Slug français -->
                    <div>
                        <label for="slug_fr" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                            Slug (Français) <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-2">
                            <input type="text" 
                                   name="slug_fr" 
                                   id="slug_fr" 
                                   required
                                   class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('slug_fr') ring-red-500 @enderror"
                                   value="{{ old('slug_fr') }}"
                                   placeholder="URL-friendly version du titre">
                            @error('slug_fr')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Titre anglais -->
                    <div>
                        <label for="title_en" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                            Titre de l'événement (Anglais)
                        </label>
                        <div class="mt-2">
                            <input type="text" 
                                   name="title_en" 
                                   id="title_en" 
                                   class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('title_en') ring-red-500 @enderror"
                                   value="{{ old('title_en') }}"
                                   placeholder="Entrez le titre en anglais">
                            @error('title_en')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Slug anglais -->
                    <div>
                        <label for="slug_en" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                            Slug (Anglais)
                        </label>
                        <div class="mt-2">
                            <input type="text" 
                                   name="slug_en" 
                                   id="slug_en" 
                                   class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('slug_en') ring-red-500 @enderror"
                                   value="{{ old('slug_en') }}"
                                   placeholder="URL-friendly version du titre anglais">
                            @error('slug_en')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Description française -->
                    <div>
                        <label for="description_fr" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                            Description (Français) <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-2">
                            <textarea name="description_fr" 
                                      id="description_fr" 
                                      rows="4" 
                                      required
                                      class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('description_fr') ring-red-500 @enderror"
                                      placeholder="Description détaillée de l'événement en français">{{ old('description_fr') }}</textarea>
                            @error('description_fr')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Description anglaise -->
                    <div>
                        <label for="description_en" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                            Description (Anglais)
                        </label>
                        <div class="mt-2">
                            <textarea name="description_en" 
                                      id="description_en" 
                                      rows="4" 
                                      class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('description_en') ring-red-500 @enderror"
                                      placeholder="Description détaillée de l'événement en anglais">{{ old('description_en') }}</textarea>
                            @error('description_en')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <!-- Date de début -->
                        <div>
                            <label for="start_date" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                Date et heure de début <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-2">
                                <input type="datetime-local" 
                                       name="start_date" 
                                       id="start_date" 
                                       required
                                       class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('start_date') ring-red-500 @enderror"
                                       value="{{ old('start_date') }}">
                                @error('start_date')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Date de fin -->
                        <div>
                            <label for="end_date" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                Date et heure de fin <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-2">
                                <input type="datetime-local" 
                                       name="end_date" 
                                       id="end_date" 
                                       required
                                       class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('end_date') ring-red-500 @enderror"
                                       value="{{ old('end_date') }}">
                                @error('end_date')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Date de fin d'inscription -->
                    <div>
                        <label for="registration_end_date" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                            Date limite d'inscription <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-2">
                            <input type="datetime-local" 
                                   name="registration_end_date" 
                                   id="registration_end_date" 
                                   required
                                   class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('registration_end_date') ring-red-500 @enderror"
                                   value="{{ old('registration_end_date') }}">
                            @error('registration_end_date')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Lieu français et anglais -->
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <!-- Lieu français -->
                        <div>
                            <label for="location_fr" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                Lieu (Français)
                            </label>
                            <div class="mt-2">
                                <input type="text" 
                                       name="location_fr" 
                                       id="location_fr" 
                                       class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('location_fr') ring-red-500 @enderror"
                                       value="{{ old('location_fr') }}"
                                       placeholder="Adresse ou plateforme en ligne">
                                @error('location_fr')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Lieu anglais -->
                        <div>
                            <label for="location_en" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                Lieu (Anglais)
                            </label>
                            <div class="mt-2">
                                <input type="text" 
                                       name="location_en" 
                                       id="location_en" 
                                       class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('location_en') ring-red-500 @enderror"
                                       value="{{ old('location_en') }}"
                                       placeholder="Address or online platform">
                                @error('location_en')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Type et lien externe -->
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <!-- Type -->
                        <div>
                            <label for="type" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                Type d'événement <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-2">
                                <select name="type" 
                                        id="type" 
                                        required
                                        class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('type') ring-red-500 @enderror">
                                    <option value="">Sélectionnez un type</option>
                                    <option value="conference" {{ old('type') == 'conference' ? 'selected' : '' }}>Conférence</option>
                                    <option value="workshop" {{ old('type') == 'workshop' ? 'selected' : '' }}>Atelier</option>
                                    <option value="networking" {{ old('type') == 'networking' ? 'selected' : '' }}>Networking</option>
                                    <option value="hackathon" {{ old('type') == 'hackathon' ? 'selected' : '' }}>Hackathon</option>
                                    <option value="webinar" {{ old('type') == 'webinar' ? 'selected' : '' }}>Webinaire</option>
                                    <option value="competition" {{ old('type') == 'competition' ? 'selected' : '' }}>Concours</option>
                                </select>
                                @error('type')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Lien externe -->
                        <div>
                            <label for="external_link" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                Lien externe
                            </label>
                            <div class="mt-2">
                                <input type="url" 
                                       name="external_link" 
                                       id="external_link" 
                                       class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('external_link') ring-red-500 @enderror"
                                       value="{{ old('external_link') }}"
                                       placeholder="https://example.com">
                                @error('external_link')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Image d'illustration -->
                    <div>
                        <label for="illustration" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                            Image d'illustration
                        </label>
                        <div class="mt-2 flex items-center gap-x-3">
                            <input type="file" 
                                   name="illustration" 
                                   id="illustration"
                                   accept="image/*"
                                   class="block w-full text-sm text-gray-900 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-orange-700 file:transition-colors font-poppins @error('illustration') ring-red-500 @enderror">
                        </div>
                        @error('illustration')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Paramètres avancés -->
                    <div class="border-t border-gray-200 pt-6">
                        <h3 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Paramètres</h3>
                        
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <!-- Capacité -->
                            <div>
                                <label for="max_participants" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                    Nombre maximum de participants <span class="text-red-500">*</span>
                                </label>
                                <div class="mt-2">
                                    <input type="number" 
                                           name="max_participants" 
                                           id="max_participants" 
                                           min="1"
                                           required
                                           class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('max_participants') ring-red-500 @enderror"
                                           value="{{ old('max_participants') }}"
                                           placeholder="Nombre de participants maximum">
                                    @error('max_participants')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Champ vide pour maintenir la grille -->
                            <div></div>
                        </div>

                        <!-- Prix et options payantes -->
                        <div class="mt-6">
                            <div class="flex items-center mb-4">
                                <input type="checkbox" 
                                       name="is_paid" 
                                       id="is_paid" 
                                       value="1"
                                       {{ old('is_paid') ? 'checked' : '' }}
                                       class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary"
                                       onchange="togglePriceFields()">
                                <label for="is_paid" class="ml-3 text-sm font-medium text-gray-700 font-poppins">
                                    Événement payant
                                </label>
                            </div>

                            <div id="price-fields" class="grid grid-cols-1 gap-6 sm:grid-cols-3" style="display: {{ old('is_paid') ? 'grid' : 'none' }}">
                                <!-- Prix normal -->
                                <div>
                                    <label for="price" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                        Prix (FCFA)
                                    </label>
                                    <div class="mt-2">
                                        <input type="number" 
                                               name="price" 
                                               id="price" 
                                               min="0"
                                               step="100"
                                               class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('price') ring-red-500 @enderror"
                                               value="{{ old('price', 0) }}"
                                               placeholder="Prix normal">
                                        @error('price')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Prix early bird -->
                                <div>
                                    <label for="early_bird_price" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                        Prix Early Bird (FCFA)
                                    </label>
                                    <div class="mt-2">
                                        <input type="number" 
                                               name="early_bird_price" 
                                               id="early_bird_price" 
                                               min="0"
                                               step="100"
                                               class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('early_bird_price') ring-red-500 @enderror"
                                               value="{{ old('early_bird_price') }}"
                                               placeholder="Prix réduit">
                                        @error('early_bird_price')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Date fin early bird -->
                                <div>
                                    <label for="early_bird_end_date" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                        Fin Early Bird
                                    </label>
                                    <div class="mt-2">
                                        <input type="datetime-local" 
                                               name="early_bird_end_date" 
                                               id="early_bird_end_date" 
                                               class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('early_bird_end_date') ring-red-500 @enderror"
                                               value="{{ old('early_bird_end_date') }}">
                                        @error('early_bird_end_date')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Devise -->
                            <div class="mt-4" id="currency-field" style="display: {{ old('is_paid') ? 'block' : 'none' }}">
                                <label for="currency" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                    Devise
                                </label>
                                <div class="mt-2">
                                    <select name="currency" 
                                            id="currency" 
                                            class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('currency') ring-red-500 @enderror">
                                        <option value="XOF" {{ old('currency', 'XOF') == 'XOF' ? 'selected' : '' }}>FCFA (XOF)</option>
                                        <option value="EUR" {{ old('currency') == 'EUR' ? 'selected' : '' }}>Euro (EUR)</option>
                                        <option value="USD" {{ old('currency') == 'USD' ? 'selected' : '' }}>Dollar (USD)</option>
                                    </select>
                                    @error('currency')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Options -->
                        <div class="mt-6">
                            <label class="block text-sm font-medium leading-6 text-gray-900 font-poppins mb-4">
                                Options
                            </label>
                            <div class="space-y-3">
                                <div class="flex items-center">
                                    <input type="checkbox" 
                                           name="is_remote" 
                                           id="is_remote" 
                                           value="1"
                                           {{ old('is_remote') ? 'checked' : '' }}
                                           class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary">
                                    <label for="is_remote" class="ml-3 text-sm font-medium text-gray-700 font-poppins">
                                        Événement en ligne
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Statut -->
                        <div class="mt-6">
                            <label for="status" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                Statut <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-2">
                                <select name="status" 
                                        id="status" 
                                        required
                                        class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('status') ring-red-500 @enderror">
                                    @foreach(\App\Enums\EventStatus::cases() as $status)
                                        <option value="{{ $status->value }}" {{ old('status', 'draft') == $status->value ? 'selected' : '' }}>
                                            {{ $status->label() }}
                                        </option>
                                    @endforeach
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
            <div class="flex items-center justify-end gap-x-3 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                <a href="{{ route('admin.events.index') }}" 
                   class="text-sm font-semibold leading-6 text-gray-900 hover:text-gray-700 font-poppins transition-colors">
                    Annuler
                </a>
                <button type="submit" 
                        class="inline-flex items-center rounded-md bg-primary px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-orange-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary transition-colors font-poppins">
                    <i data-lucide="save" class="h-4 w-4 mr-2"></i>
                    Créer l'événement
                </button>
            </div>
        </div>
    </form>
</div>

<script>
function togglePriceFields() {
    const isPaidCheckbox = document.getElementById('is_paid');
    const priceFields = document.getElementById('price-fields');
    const currencyField = document.getElementById('currency-field');
    
    if (isPaidCheckbox.checked) {
        priceFields.style.display = 'grid';
        currencyField.style.display = 'block';
    } else {
        priceFields.style.display = 'none';
        currencyField.style.display = 'none';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Initialiser les icônes Lucide
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
    
    // Auto-générer le slug depuis le titre
    const titleFr = document.getElementById('title_fr');
    const slugFr = document.getElementById('slug_fr');
    const titleEn = document.getElementById('title_en');
    const slugEn = document.getElementById('slug_en');
    
    if (titleFr && slugFr) {
        titleFr.addEventListener('input', function() {
            if (!slugFr.value || slugFr.value === titleFr.value.toLowerCase().replace(/[^\w\s-]/g, '').replace(/\s+/g, '-')) {
                slugFr.value = titleFr.value.toLowerCase()
                    .replace(/[^\w\s-]/g, '')
                    .replace(/\s+/g, '-');
            }
        });
    }
    
    if (titleEn && slugEn) {
        titleEn.addEventListener('input', function() {
            if (!slugEn.value || slugEn.value === titleEn.value.toLowerCase().replace(/[^\w\s-]/g, '').replace(/\s+/g, '-')) {
                slugEn.value = titleEn.value.toLowerCase()
                    .replace(/[^\w\s-]/g, '')
                    .replace(/\s+/g, '-');
            }
        });
    }
});
</script>
@endsection