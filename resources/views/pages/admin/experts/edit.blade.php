@extends('pages.admin.layouts.app')

@section('title', 'Modifier un expert')
@section('page-title', 'Modifier un expert')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- En-tête -->
    <div class="mb-8">
        <div class="flex items-center space-x-3 text-sm text-gray-500 mb-4">
            <a href="{{ route('admin.experts.index') }}" class="hover:text-primary transition-colors">Experts</a>
            <i data-lucide="chevron-right" class="h-4 w-4"></i>
            <span class="text-gray-900">Modifier {{ $expert->full_name }}</span>
        </div>
        <h1 class="text-2xl font-semibold text-gray-900 font-poppins">Modifier l'expert</h1>
        <p class="mt-2 text-sm text-gray-600">Modifiez les informations de l'expert {{ $expert->full_name }}.</p>
    </div>

    <!-- Formulaire -->
    <form action="{{ route('admin.experts.update', $expert) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <!-- Card principale -->
        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
            <div class="px-4 py-6 sm:p-8">
                <div class="grid grid-cols-1 gap-6">
                    
                    <!-- Informations personnelles -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Informations personnelles</h3>
                        
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
                                           value="{{ old('full_name', $expert->full_name) }}"
                                           placeholder="Ex: Dr. Marie Kouassi">
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
                                           value="{{ old('email', $expert->email) }}"
                                           placeholder="marie.kouassi@email.com">
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
                                           value="{{ old('phone', $expert->phone) }}"
                                           placeholder="+225 XX XX XX XX XX">
                                    @error('phone')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Position -->
                            <div>
                                <label for="position" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                    Poste/Position <span class="text-red-500">*</span>
                                </label>
                                <div class="mt-2">
                                    <input type="text" 
                                           name="position" 
                                           id="position" 
                                           required
                                           class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('position') ring-red-500 @enderror"
                                           value="{{ old('position', $expert->position) }}"
                                           placeholder="Ex: Directeur Innovation, Consultant Senior">
                                    @error('position')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Informations professionnelles -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Informations professionnelles</h3>
                        
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
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
                                           value="{{ old('organization', $expert->organization) }}"
                                           placeholder="Ex: Orange Digital Center, Université FHB">
                                    @error('organization')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Années d'expérience -->
                            <div>
                                <label for="years_experience" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                    Années d'expérience
                                </label>
                                <div class="mt-2">
                                    <input type="number" 
                                           name="years_experience" 
                                           id="years_experience" 
                                           min="0"
                                           max="50"
                                           class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('years_experience') ring-red-500 @enderror"
                                           value="{{ old('years_experience', $expert->years_experience) }}"
                                           placeholder="Ex: 10">
                                    @error('years_experience')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- LinkedIn -->
                            <div>
                                <label for="linkedin" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                    LinkedIn
                                </label>
                                <div class="mt-2">
                                    <input type="url" 
                                           name="linkedin" 
                                           id="linkedin" 
                                           class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('linkedin') ring-red-500 @enderror"
                                           value="{{ old('linkedin', $expert->linkedin) }}"
                                           placeholder="https://linkedin.com/in/profile">
                                    @error('linkedin')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Site web -->
                            <div>
                                <label for="website" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                    Site web personnel
                                </label>
                                <div class="mt-2">
                                    <input type="url" 
                                           name="website" 
                                           id="website" 
                                           class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('website') ring-red-500 @enderror"
                                           value="{{ old('website', $expert->website) }}"
                                           placeholder="https://monsite.com">
                                    @error('website')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Spécialités et expertise -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Spécialités et expertise</h3>
                        
                        <!-- Spécialités -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium leading-6 text-gray-900 font-poppins mb-4">
                                Domaines de spécialité <span class="text-red-500">*</span>
                            </label>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                @foreach(\App\Models\Expert::SPECIALTIES as $key => $label)
                                    <div class="flex items-center">
                                        <input type="checkbox" 
                                               name="specialties[]" 
                                               id="specialty_{{ $key }}" 
                                               value="{{ $key }}"
                                               {{ (is_array(old('specialties', $expert->specialties ?? [])) && in_array($key, old('specialties', $expert->specialties ?? []))) ? 'checked' : '' }}
                                               class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary">
                                        <label for="specialty_{{ $key }}" class="ml-3 text-sm font-medium text-gray-700 font-poppins">
                                            {{ $label }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            @error('specialties')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Bio -->
                        <div class="mb-6">
                            <label for="bio" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                Biographie <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-2">
                                <textarea name="bio" 
                                          id="bio" 
                                          rows="4" 
                                          required
                                          class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('bio') ring-red-500 @enderror"
                                          placeholder="Décrivez l'expertise, l'expérience et les réalisations de l'expert...">{{ old('bio', $expert->bio) }}</textarea>
                                @error('bio')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Domaines d'intervention -->
                        <div>
                            <label for="intervention_areas" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                Domaines d'intervention
                            </label>
                            <div class="mt-2">
                                <textarea name="intervention_areas" 
                                          id="intervention_areas" 
                                          rows="3" 
                                          class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('intervention_areas') ring-red-500 @enderror"
                                          placeholder="Mentoring, Formation, Conseil stratégique, Accompagnement technique...">{{ old('intervention_areas', $expert->intervention_areas) }}</textarea>
                                @error('intervention_areas')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Disponibilité et tarifs -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Disponibilité et tarifs</h3>
                        
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <!-- Tarif horaire -->
                            <div>
                                <label for="hourly_rate" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                    Tarif horaire (FCFA)
                                </label>
                                <div class="mt-2">
                                    <input type="number" 
                                           name="hourly_rate" 
                                           id="hourly_rate" 
                                           min="0"
                                           step="1000"
                                           class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('hourly_rate') ring-red-500 @enderror"
                                           value="{{ old('hourly_rate', $expert->hourly_rate ?? 0) }}"
                                           placeholder="Ex: 50000">
                                    @error('hourly_rate')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Disponibilité -->
                            <div>
                                <label for="availability" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                    Disponibilité
                                </label>
                                <div class="mt-2">
                                    <select name="availability" 
                                            id="availability" 
                                            class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('availability') ring-red-500 @enderror">
                                        <option value="">Sélectionnez une disponibilité</option>
                                        <option value="immediate" {{ old('availability', $expert->availability) == 'immediate' ? 'selected' : '' }}>Immédiate</option>
                                        <option value="1_week" {{ old('availability', $expert->availability) == '1_week' ? 'selected' : '' }}>Dans 1 semaine</option>
                                        <option value="2_weeks" {{ old('availability', $expert->availability) == '2_weeks' ? 'selected' : '' }}>Dans 2 semaines</option>
                                        <option value="1_month" {{ old('availability', $expert->availability) == '1_month' ? 'selected' : '' }}>Dans 1 mois</option>
                                        <option value="limited" {{ old('availability', $expert->availability) == 'limited' ? 'selected' : '' }}>Limitée</option>
                                    </select>
                                    @error('availability')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Notes sur la disponibilité -->
                        <div class="mt-6">
                            <label for="availability_notes" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                Notes sur la disponibilité
                            </label>
                            <div class="mt-2">
                                <textarea name="availability_notes" 
                                          id="availability_notes" 
                                          rows="2" 
                                          class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('availability_notes') ring-red-500 @enderror"
                                          placeholder="Précisions sur la disponibilité, créneaux préférés...">{{ old('availability_notes', $expert->availability_notes) }}</textarea>
                                @error('availability_notes')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Photo et documents -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Photo et documents</h3>
                        
                        <!-- Photo de profil -->
                        <div class="mb-6">
                            <label for="profile_picture" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                Photo de profil
                            </label>
                            
                            @if($expert->profile_picture)
                            <div class="mt-4">
                                <div class="flex items-center gap-x-4">
                                    <img src="{{ str_starts_with($expert->profile_picture, 'http') ? $expert->profile_picture : asset('storage/' . $expert->profile_picture) }}" alt="Photo actuelle" class="h-16 w-16 rounded-lg object-cover">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Photo actuelle</p>
                                        <p class="text-sm text-gray-500">Sélectionnez une nouvelle photo pour la remplacer</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                            <div class="mt-2 flex items-center gap-x-3">
                                <input type="file" 
                                       name="profile_picture" 
                                       id="profile_picture"
                                       accept="image/*"
                                       class="block w-full text-sm text-gray-900 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-orange-700 file:transition-colors font-poppins @error('profile_picture') ring-red-500 @enderror">
                            </div>
                            @error('profile_picture')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- CV -->
                        <div>
                            <label for="cv_file" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                CV (optionnel)
                            </label>
                            
                            @if($expert->cv_file)
                            <div class="mt-2 mb-4">
                                <div class="flex items-center gap-x-3">
                                    <i data-lucide="file-text" class="h-5 w-5 text-gray-400"></i>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">CV actuel</p>
                                        <a href="{{ asset('storage/' . $expert->cv_file) }}" target="_blank" class="text-sm text-primary hover:text-orange-700">
                                            Télécharger le CV actuel
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                            <div class="mt-2 flex items-center gap-x-3">
                                <input type="file" 
                                       name="cv_file" 
                                       id="cv_file"
                                       accept=".pdf,.doc,.docx"
                                       class="block w-full text-sm text-gray-900 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-orange-700 file:transition-colors font-poppins @error('cv_file') ring-red-500 @enderror">
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Formats acceptés : PDF, DOC, DOCX</p>
                            @error('cv_file')
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
                                @foreach(\App\Models\Expert::STATUSES as $key => $label)
                                    <option value="{{ $key }}" {{ old('status', $expert->status) == $key ? 'selected' : '' }}>
                                        {{ $label }}
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

            <!-- Actions -->
            <div class="flex items-center justify-end gap-x-3 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                <a href="{{ route('admin.experts.index') }}" 
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
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialiser les icônes Lucide
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
});
</script>
@endsection