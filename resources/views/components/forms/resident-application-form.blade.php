<form action="{{ route('applications.resident') }}" method="POST" class="application-form space-y-6">
    @csrf
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Catégorie -->
        <div class="md:col-span-2">
            <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                Catégorie <span class="text-red-500">*</span>
            </label>
            <select name="category" id="category" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors">
                <option value="">Sélectionnez une catégorie</option>
                <option value="startup" {{ old('category') === 'startup' ? 'selected' : '' }}>Startup</option>
                <option value="structure_accompagnement" {{ old('category') === 'structure_accompagnement' ? 'selected' : '' }}>Structure d'accompagnement</option>
                <option value="professionnel" {{ old('category') === 'professionnel' ? 'selected' : '' }}>Professionnel⸱le</option>
                <option value="gestionnaire" {{ old('category') === 'gestionnaire' ? 'selected' : '' }}>Gestionnaire</option>
            </select>
        </div>

        <!-- Nom d'organisation -->
        <div>
            <label for="organization_name" class="block text-sm font-medium text-gray-700 mb-2">
                Nom d'organisation
            </label>
            <input type="text" name="organization_name" id="organization_name" value="{{ old('organization_name') }}"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors"
                   placeholder="Ex: Ma Startup, Mon Entreprise, etc.">
        </div>

        <!-- Nom et Prénom -->
        <div>
            <label for="representative_name" class="block text-sm font-medium text-gray-700 mb-2">
                Nom et Prénom(s) du Représentant <span class="text-red-500">*</span>
            </label>
            <input type="text" name="representative_name" id="representative_name" value="{{ old('representative_name') }}" required
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

        <!-- Besoins spécifiques -->
        <div class="md:col-span-2">
            <label for="specific_needs" class="block text-sm font-medium text-gray-700 mb-2">
                Besoins spécifiques
            </label>
            <textarea name="specific_needs" id="specific_needs" rows="4"
                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors resize-none"
                      placeholder="Décrivez vos besoins spécifiques...">{{ old('specific_needs') }}</textarea>
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