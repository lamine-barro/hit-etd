<x-layouts.resident>
    <x-slot:title>Mon profil - Espace résident</x-slot:title>
    <x-slot:pageTitle>Mon profil</x-slot:pageTitle>
    <x-slot:pageDescription>Gérez vos informations personnelles et préférences</x-slot:pageDescription>

    <div class="w-full">
        <!-- Profile Information Card -->
        <div class="bg-white rounded-lg border border-gray-200 p-4 mb-4">
            <div class="flex items-center space-x-3 mb-4">
                <div class="h-12 w-12 bg-orange-500 rounded-full flex items-center justify-center text-white font-bold">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-gray-900">{{ $user->name }}</h2>
                    <p class="text-gray-500">{{ $user->email }}</p>
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium
                        {{ $user->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $user->is_active ? 'Compte actif' : 'Compte inactif' }}
                    </span>
                </div>
            </div>

            <!-- Profile Form -->
            <form method="POST" action="{{ route('resident.profile.update') }}" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                            Nom complet *
                        </label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $user->name) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('name') border-red-500 @enderror"
                               required>
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">
                            Téléphone
                        </label>
                        <input type="text" 
                               id="phone" 
                               name="phone" 
                               value="{{ old('phone', $user->phone) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('phone') border-red-500 @enderror">
                        @error('phone')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email (readonly) -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                            Adresse email
                        </label>
                        <input type="email" 
                               id="email" 
                               value="{{ $user->email }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-500" 
                               readonly>
                        <p class="text-xs text-gray-500">L'email ne peut pas être modifié</p>
                    </div>

                    <!-- Category (readonly) -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">
                            Catégorie
                        </label>
                        <input type="text" 
                               id="category" 
                               value="{{ ucfirst(str_replace('_', ' ', $user->category ?? 'Non définie')) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-500" 
                               readonly>
                        <p class="text-xs text-gray-500">Contactez l'administration pour modifier</p>
                    </div>
                </div>

                <!-- Needs -->
                <div>
                    <label for="needs" class="block text-sm font-medium text-gray-700 mb-1">
                        Besoins spécifiques
                    </label>
                    <textarea id="needs" 
                              name="needs" 
                              rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('needs') border-red-500 @enderror"
                              placeholder="Décrivez vos besoins spécifiques, attentes ou projets...">{{ old('needs', $user->needs) }}</textarea>
                    @error('needs')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500">Ces informations aideront notre équipe à mieux vous accompagner</p>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" 
                            class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition-colors font-medium">
                        Mettre à jour le profil
                    </button>
                </div>
            </form>
        </div>

        <!-- Account Information -->
        <div class="bg-white rounded-lg border border-gray-200 p-4">
            <h3 class="text-base font-semibold text-gray-900 mb-3">Informations du compte</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <h4 class="text-sm font-medium text-gray-700">Membre depuis</h4>
                    <p class="text-gray-900">{{ $user->created_at->format('d/m/Y') }}</p>
                    <p class="text-xs text-gray-500">{{ $user->created_at->diffForHumans() }}</p>
                </div>

                <div>
                    <h4 class="text-sm font-medium text-gray-700">Dernière connexion</h4>
                    <p class="text-gray-900">
                        @if($user->updated_at)
                            {{ $user->updated_at->format('d/m/Y H:i') }}
                        @else
                            Non disponible
                        @endif
                    </p>
                </div>

                <div>
                    <h4 class="text-sm font-medium text-gray-700">Statut de vérification</h4>
                    <div class="flex items-center space-x-2">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium
                            {{ $user->is_verified ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $user->is_verified ? 'Vérifié' : 'En attente' }}
                        </span>
                    </div>
                </div>

                <div>
                    <h4 class="text-sm font-medium text-gray-700">Type de demande</h4>
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        {{ $user->is_request ? 'Candidature' : 'Membre direct' }}
                    </span>
                </div>
            </div>

            @if(!$user->is_active)
                <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                    <div class="flex">
                        <i data-lucide="alert-triangle" class="w-4 h-4 text-yellow-400 mr-2"></i>
                        <div>
                            <h4 class="text-sm font-medium text-yellow-800">Compte en attente d'activation</h4>
                            <p class="text-sm text-yellow-700">
                                Votre compte est en attente d'activation par notre équipe. 
                                Vous recevrez un email de confirmation une fois votre compte activé.
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-layouts.resident>