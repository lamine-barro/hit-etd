<form action="{{ route('applications.expert') }}" method="POST" enctype="multipart/form-data" class="application-form space-y-6">
    @csrf
    
    <!-- Informations personnelles -->
    <div class="bg-gray-50 rounded-lg p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Informations personnelles</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Nom et Prénom -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Nom et Prénom(s) du Représentant <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors">
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    Adresse Email <span class="text-red-500">*</span>
                </label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors">
            </div>

            <!-- Téléphone -->
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                    Numéro de Téléphone <span class="text-red-500">*</span>
                </label>
                <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors">
            </div>

            <!-- Organisation -->
            <div>
                <label for="organization" class="block text-sm font-medium text-gray-700 mb-2">
                    Organisation/Affiliation
                </label>
                <input type="text" name="organization" id="organization" value="{{ old('organization') }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors">
            </div>

            <!-- Poste -->
            <div>
                <label for="position" class="block text-sm font-medium text-gray-700 mb-2">
                    Poste
                </label>
                <input type="text" name="position" id="position" value="{{ old('position') }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors">
            </div>

            <!-- LinkedIn -->
            <div>
                <label for="linkedin" class="block text-sm font-medium text-gray-700 mb-2">
                    LinkedIn
                </label>
                <input type="url" name="linkedin" id="linkedin" value="{{ old('linkedin') }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors"
                       placeholder="https://linkedin.com/in/...">
            </div>

            <!-- CV -->
            <div class="md:col-span-2">
                <label for="cv" class="block text-sm font-medium text-gray-700 mb-2">
                    CV
                </label>
                <input type="file" name="cv" id="cv" accept=".pdf,.doc,.docx"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors">
                <p class="text-sm text-gray-500 mt-1">Formats acceptés : PDF, DOC, DOCX (max 5MB)</p>
            </div>
        </div>
    </div>

    <!-- Spécialités -->
    <div class="bg-gray-50 rounded-lg p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Spécialités <span class="text-red-500">*</span></h3>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
            @foreach(\App\Models\Expert::SPECIALTIES as $key => $label)
                <div class="flex items-center">
                    <input type="checkbox" name="specialties[]" value="{{ $key }}" id="specialty_{{ $key }}"
                           {{ in_array($key, old('specialties', [])) ? 'checked' : '' }}
                           class="h-4 w-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                    <label for="specialty_{{ $key }}" class="ml-2 text-sm text-gray-700">
                        {{ $label }}
                    </label>
                </div>
            @endforeach
        </div>
        
        <div class="mt-3" x-data="{ showOther: false }" x-show="showOther" x-init="$watch('showOther', value => { if (!value) document.getElementById('other_specialty').value = '' })">
            <input type="text" name="other_specialty" id="other_specialty" value="{{ old('other_specialty') }}"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors"
                   placeholder="Précisez votre autre spécialité...">
        </div>
    </div>

    <!-- Types de formation/masterclass -->
    <div class="bg-gray-50 rounded-lg p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Types de formation/masterclass préférés <span class="text-red-500">*</span></h3>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
            @foreach(\App\Models\Expert::TRAINING_TYPES as $key => $label)
                <div class="flex items-center">
                    <input type="checkbox" name="training_types[]" value="{{ $key }}" id="training_type_{{ $key }}"
                           {{ in_array($key, old('training_types', [])) ? 'checked' : '' }}
                           class="h-4 w-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                    <label for="training_type_{{ $key }}" class="ml-2 text-sm text-gray-700">
                        {{ $label }}
                    </label>
                </div>
            @endforeach
        </div>
        
        <div class="mt-3" x-data="{ showOther: false }" x-show="showOther">
            <input type="text" name="other_training_type" id="other_training_type" value="{{ old('other_training_type') }}"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors"
                   placeholder="Précisez votre autre type de formation...">
        </div>
    </div>

    <!-- Méthode pédagogique -->
    <div class="bg-gray-50 rounded-lg p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Méthode pédagogique <span class="text-red-500">*</span></h3>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
            @foreach(\App\Models\Expert::PEDAGOGICAL_METHODS as $key => $label)
                <div class="flex items-center">
                    <input type="checkbox" name="pedagogical_methods[]" value="{{ $key }}" id="pedagogical_method_{{ $key }}"
                           {{ in_array($key, old('pedagogical_methods', [])) ? 'checked' : '' }}
                           class="h-4 w-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                    <label for="pedagogical_method_{{ $key }}" class="ml-2 text-sm text-gray-700">
                        {{ $label }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Publics cibles -->
    <div class="bg-gray-50 rounded-lg p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Public cible <span class="text-red-500">*</span></h3>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            @foreach(\App\Models\Expert::TARGET_AUDIENCES as $key => $label)
                <div class="flex items-center">
                    <input type="checkbox" name="target_audiences[]" value="{{ $key }}" id="target_audience_{{ $key }}"
                           {{ in_array($key, old('target_audiences', [])) ? 'checked' : '' }}
                           class="h-4 w-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                    <label for="target_audience_{{ $key }}" class="ml-2 text-sm text-gray-700">
                        {{ $label }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Fréquence d'intervention -->
    <div class="bg-gray-50 rounded-lg p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Fréquence d'intervention préférée <span class="text-red-500">*</span></h3>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
            @foreach(\App\Models\Expert::INTERVENTION_FREQUENCIES as $key => $label)
                <div class="flex items-center">
                    <input type="radio" name="intervention_frequency" value="{{ $key }}" id="frequency_{{ $key }}"
                           {{ old('intervention_frequency') === $key ? 'checked' : '' }}
                           class="h-4 w-4 text-primary-600 border-gray-300 focus:ring-primary-500">
                    <label for="frequency_{{ $key }}" class="ml-2 text-sm text-gray-700">
                        {{ $label }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Jours préférés -->
    <div class="bg-gray-50 rounded-lg p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Jours préférés <span class="text-red-500">*</span></h3>
        
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
            @foreach(\App\Models\Expert::PREFERRED_DAYS as $key => $label)
                <div class="flex items-center">
                    <input type="checkbox" name="preferred_days[]" value="{{ $key }}" id="day_{{ $key }}"
                           {{ in_array($key, old('preferred_days', [])) ? 'checked' : '' }}
                           class="h-4 w-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                    <label for="day_{{ $key }}" class="ml-2 text-sm text-gray-700">
                        {{ $label }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Plages horaires -->
    <div class="bg-gray-50 rounded-lg p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Plages horaires <span class="text-red-500">*</span></h3>
        
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            @foreach(\App\Models\Expert::TIME_SLOTS as $key => $label)
                <div class="flex items-center">
                    <input type="checkbox" name="time_slots[]" value="{{ $key }}" id="time_slot_{{ $key }}"
                           {{ in_array($key, old('time_slots', [])) ? 'checked' : '' }}
                           class="h-4 w-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                    <label for="time_slot_{{ $key }}" class="ml-2 text-sm text-gray-700">
                        {{ $label }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Submit Button -->
    <div class="flex justify-end pt-6">
        <button type="submit"
                class="bg-primary-600 hover:bg-primary-700 text-white font-medium py-3 px-8 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
            Soumettre ma candidature
        </button>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gestion de l'affichage du champ "Autre" pour les spécialités
    const otherSpecialtyCheckbox = document.getElementById('specialty_autre');
    const otherSpecialtyInput = document.getElementById('other_specialty');
    
    if (otherSpecialtyCheckbox && otherSpecialtyInput) {
        otherSpecialtyCheckbox.addEventListener('change', function() {
            if (this.checked) {
                otherSpecialtyInput.parentElement.style.display = 'block';
            } else {
                otherSpecialtyInput.parentElement.style.display = 'none';
                otherSpecialtyInput.value = '';
            }
        });
    }
    
    // Gestion de l'affichage du champ "Autre" pour les types de formation
    const otherTrainingCheckbox = document.getElementById('training_type_autre');
    const otherTrainingInput = document.getElementById('other_training_type');
    
    if (otherTrainingCheckbox && otherTrainingInput) {
        otherTrainingCheckbox.addEventListener('change', function() {
            if (this.checked) {
                otherTrainingInput.parentElement.style.display = 'block';
            } else {
                otherTrainingInput.parentElement.style.display = 'none';
                otherTrainingInput.value = '';
            }
        });
    }
});
</script> 