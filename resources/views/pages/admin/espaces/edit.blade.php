@extends('pages.admin.layouts.app')

@section('title', 'Modifier l\'espace')
@section('page-title', 'Modifier l\'espace')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- En-tête -->
    <div class="mb-8">
        <div class="flex items-center space-x-3 text-sm text-gray-500 mb-4">
            <a href="{{ route('admin.espaces.index') }}" class="hover:text-primary transition-colors">Espaces</a>
            <i data-lucide="chevron-right" class="h-4 w-4"></i>
            <a href="{{ route('admin.espaces.show', $espace) }}" class="hover:text-primary transition-colors">{{ Str::limit($espace->name, 30) }}</a>
            <i data-lucide="chevron-right" class="h-4 w-4"></i>
            <span class="text-gray-900">Modifier</span>
        </div>
        <h1 class="text-2xl font-semibold text-gray-900 font-poppins">Modifier l'espace</h1>
        <p class="mt-2 text-sm text-gray-600">Modifiez les informations de l'espace ci-dessous.</p>
    </div>

    <!-- Formulaire -->
    <form action="{{ route('admin.espaces.update', $espace) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <!-- Card principale -->
        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
            <div class="px-4 py-6 sm:p-8">
                <div class="grid grid-cols-1 gap-6">
                    
                    <!-- Nom et Code -->
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <!-- Nom -->
                        <div>
                            <label for="name" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                Nom de l'espace <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-2">
                                <input type="text" 
                                       name="name" 
                                       id="name" 
                                       required
                                       class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('name') ring-red-500 @enderror"
                                       value="{{ old('name', $espace->name) }}"
                                       placeholder="Ex: Salle de réunion A">
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Code -->
                        <div>
                            <label for="code" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                Code de l'espace <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-2">
                                <input type="text" 
                                       name="code" 
                                       id="code" 
                                       required
                                       class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('code') ring-red-500 @enderror"
                                       value="{{ old('code', $espace->code) }}"
                                       placeholder="Ex: SRA-001">
                                @error('code')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                            Description
                        </label>
                        <div class="mt-2">
                            <textarea name="description" 
                                      id="description" 
                                      rows="4" 
                                      class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('description') ring-red-500 @enderror"
                                      placeholder="Description détaillée de l'espace">{{ old('description', $espace->description) }}</textarea>
                            @error('description')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Type et Étage -->
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <!-- Type -->
                        <div>
                            <label for="type" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                Type d'espace <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-2">
                                <select name="type" 
                                        id="type" 
                                        required
                                        class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('type') ring-red-500 @enderror">
                                    <option value="">Sélectionnez un type</option>
                                    @foreach(\App\Models\Espace::FR_TYPES as $type => $label)
                                        <option value="{{ $type }}" {{ old('type', $espace->type) == $type ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('type')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Étage -->
                        <div>
                            <label for="floor" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                Étage
                            </label>
                            <div class="mt-2">
                                <select name="floor" 
                                        id="floor" 
                                        class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('floor') ring-red-500 @enderror">
                                    <option value="">Sélectionnez un étage</option>
                                    @foreach(\App\Models\Espace::FR_FLOORS as $floor => $label)
                                        <option value="{{ $floor }}" {{ old('floor', $espace->floor) == $floor ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('floor')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Capacité et Surface -->
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <!-- Capacité -->
                        <div>
                            <label for="capacity" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                Capacité (personnes)
                            </label>
                            <div class="mt-2">
                                <input type="number" 
                                       name="capacity" 
                                       id="capacity" 
                                       min="1"
                                       class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('capacity') ring-red-500 @enderror"
                                       value="{{ old('capacity', $espace->capacity) }}"
                                       placeholder="Ex: 10">
                                @error('capacity')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Surface -->
                        <div>
                            <label for="surface" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                Surface (m²)
                            </label>
                            <div class="mt-2">
                                <input type="number" 
                                       name="surface" 
                                       id="surface" 
                                       min="1"
                                       step="0.1"
                                       class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('surface') ring-red-500 @enderror"
                                       value="{{ old('surface', $espace->surface) }}"
                                       placeholder="Ex: 25.5">
                                @error('surface')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Prix et durée -->
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
                        <!-- Prix par heure -->
                        <div>
                            <label for="price_per_hour" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                Prix par heure (FCFA) <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-2">
                                <input type="number" 
                                       name="price_per_hour" 
                                       id="price_per_hour" 
                                       min="0"
                                       step="100"
                                       required
                                       class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('price_per_hour') ring-red-500 @enderror"
                                       value="{{ old('price_per_hour', $espace->price_per_hour) }}"
                                       placeholder="Ex: 5000">
                                @error('price_per_hour')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Prix par jour -->
                        <div>
                            <label for="price_per_day" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                Prix par jour (FCFA)
                            </label>
                            <div class="mt-2">
                                <input type="number" 
                                       name="price_per_day" 
                                       id="price_per_day" 
                                       min="0"
                                       step="100"
                                       class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('price_per_day') ring-red-500 @enderror"
                                       value="{{ old('price_per_day', $espace->price_per_day) }}"
                                       placeholder="Ex: 30000">
                                @error('price_per_day')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Durée minimum -->
                        <div>
                            <label for="minimum_duration" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                Durée minimum (heures) <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-2">
                                <input type="number" 
                                       name="minimum_duration" 
                                       id="minimum_duration" 
                                       min="1"
                                       max="24"
                                       required
                                       class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('minimum_duration') ring-red-500 @enderror"
                                       value="{{ old('minimum_duration', $espace->minimum_duration ?? 1) }}"
                                       placeholder="Ex: 2">
                                @error('minimum_duration')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Équipements -->
                    <div>
                        <label for="features" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                            Équipements disponibles
                        </label>
                        <div class="mt-2">
                            <input type="text" 
                                   name="features" 
                                   id="features"
                                   class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('features') ring-red-500 @enderror"
                                   value="{{ old('features', is_array($espace->features) ? implode(', ', $espace->features) : $espace->features) }}"
                                   placeholder="Séparez les équipements par des virgules">
                        </div>
                        <p class="mt-1 text-sm text-gray-500">Exemple: Projecteur, Tableau blanc, Climatisation, WiFi</p>
                        @error('features')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image d'illustration -->
                    <div>
                        <label for="illustration" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                            Image d'illustration
                        </label>
                        @if($espace->illustration_url)
                            <div class="mt-2 mb-3">
                                <img src="{{ $espace->illustration_url }}" alt="Illustration actuelle" class="h-32 w-auto rounded-lg shadow-sm">
                                <p class="mt-1 text-sm text-gray-500">Image actuelle</p>
                            </div>
                        @endif
                        <div id="image-preview" class="mt-2 mb-3 hidden">
                            <img id="preview-img" src="" alt="Nouvelle prévisualisation" class="h-32 w-auto rounded-lg shadow-sm">
                            <p class="mt-1 text-sm text-gray-500">Nouvelle image (prévisualisation)</p>
                        </div>
                        <div class="mt-2 flex items-center gap-x-3">
                            <input type="file" 
                                   name="illustration" 
                                   id="illustration"
                                   accept="image/*"
                                   onchange="previewImage(this)"
                                   class="block w-full text-sm text-gray-900 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-orange-700 file:transition-colors font-poppins @error('illustration') ring-red-500 @enderror">
                        </div>
                        <p class="mt-1 text-sm text-gray-500">Laissez vide pour conserver l'image actuelle</p>
                        @error('illustration')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Paramètres -->
                    <div class="border-t border-gray-200 pt-6">
                        <h3 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Paramètres</h3>
                        
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
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
                                        <option value="{{ \App\Models\Espace::STATUS_AVAILABLE }}" {{ old('status', $espace->status) == \App\Models\Espace::STATUS_AVAILABLE ? 'selected' : '' }}>
                                            Disponible
                                        </option>
                                        <option value="{{ \App\Models\Espace::STATUS_UNAVAILABLE }}" {{ old('status', $espace->status) == \App\Models\Espace::STATUS_UNAVAILABLE ? 'selected' : '' }}>
                                            Indisponible
                                        </option>
                                        <option value="{{ \App\Models\Espace::STATUS_RESERVED }}" {{ old('status', $espace->status) == \App\Models\Espace::STATUS_RESERVED ? 'selected' : '' }}>
                                            Réservé
                                        </option>
                                    </select>
                                    @error('status')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Options -->
                            <div>
                                <label class="block text-sm font-medium leading-6 text-gray-900 font-poppins mb-4">
                                    Options
                                </label>
                                <div class="space-y-3">
                                    <div class="flex items-center">
                                        <input type="checkbox" 
                                               name="is_active" 
                                               id="is_active" 
                                               value="1"
                                               {{ old('is_active', $espace->is_active) ? 'checked' : '' }}
                                               class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary">
                                        <label for="is_active" class="ml-3 text-sm font-medium text-gray-700 font-poppins">
                                            Publier l'espace
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between border-t border-gray-900/10 px-4 py-4 sm:px-8">
                <button type="button" 
                        onclick="openConfirmModal('{{ route('admin.espaces.destroy', $espace) }}', 'Êtes-vous sûr de vouloir supprimer cet espace ?', 'delete', 'DELETE')"
                        class="inline-flex items-center text-sm font-semibold text-gray-600 hover:text-red-700 font-poppins transition-colors">
                    <i data-lucide="trash-2" class="h-4 w-4 mr-2"></i>
                    Supprimer l'espace
                </button>
                
                <div class="flex items-center gap-x-3">
                    <a href="{{ route('admin.espaces.show', $espace) }}" 
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
function previewImage(input) {
    const preview = document.getElementById('image-preview');
    const previewImg = document.getElementById('preview-img');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.classList.remove('hidden');
        }
        
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.classList.add('hidden');
        previewImg.src = '';
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