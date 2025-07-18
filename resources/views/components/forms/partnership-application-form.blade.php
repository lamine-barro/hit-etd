<form action="{{ route('applications.partnership') }}" method="POST" class="application-form space-y-6">
    @csrf
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Type de partenariat -->
        <div class="md:col-span-2">
            <label for="partnership_type" class="block text-sm font-medium text-gray-700 mb-2">
                Type de partenariat <span class="text-red-500">*</span>
            </label>
            <select name="partnership_type" id="partnership_type" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors">
                <option value="">Sélectionnez un type de partenariat</option>
                @foreach(\App\Enums\PartnershipType::cases() as $type)
                    <option value="{{ $type->value }}" {{ old('partnership_type') === $type->value ? 'selected' : '' }}>
                        {{ $type->label() }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Nom de l'organisation -->
        <div>
            <label for="organization_name" class="block text-sm font-medium text-gray-700 mb-2">
                Nom de l'Organisation <span class="text-red-500">*</span>
            </label>
            <input type="text" name="organization_name" id="organization_name" value="{{ old('organization_name') }}" required
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors">
        </div>

        <!-- Nom et Prénom du représentant -->
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

        <!-- Message -->
        <div class="md:col-span-2">
            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                Votre message <span class="text-red-500">*</span>
            </label>
            <textarea name="message" id="message" rows="4" required
                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors resize-none"
                      placeholder="Décrivez votre projet de partenariat...">{{ old('message') }}</textarea>
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