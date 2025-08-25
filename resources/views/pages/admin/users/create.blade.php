@extends('pages.admin.layouts.app')

@section('title', 'Créer un utilisateur')
@section('page-title', 'Créer un utilisateur')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- En-tête -->
    <div class="mb-8">
        <div class="flex items-center space-x-3 text-sm text-gray-500 mb-4">
            <a href="{{ route('admin.users.index') }}" class="hover:text-primary transition-colors">Utilisateurs</a>
            <i data-lucide="chevron-right" class="h-4 w-4"></i>
            <span class="text-gray-900">Nouvel utilisateur</span>
        </div>
        <h1 class="text-2xl font-semibold text-gray-900 font-poppins">Créer un nouvel utilisateur</h1>
        <p class="mt-2 text-sm text-gray-600">Remplissez les informations ci-dessous pour créer un nouvel utilisateur.</p>
    </div>

    <!-- Formulaire -->
    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <!-- Card principale -->
        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
            <div class="px-4 py-6 sm:p-8">
                <div class="grid grid-cols-1 gap-6">
                    
                    <!-- Informations personnelles -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Informations personnelles</h3>
                        
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <!-- Nom -->
                            <div>
                                <label for="name" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                    Nom complet <span class="text-red-500">*</span>
                                </label>
                                <div class="mt-2">
                                    <input type="text" 
                                           name="name" 
                                           id="name" 
                                           required
                                           class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('name') ring-red-500 @enderror"
                                           value="{{ old('name') }}"
                                           placeholder="Ex: Jean Dupont">
                                    @error('name')
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
                                           value="{{ old('email') }}"
                                           placeholder="jean.dupont@email.com">
                                    @error('email')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Téléphone -->
                            <div>
                                <label for="phone" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                    Téléphone
                                </label>
                                <div class="mt-2">
                                    <input type="tel" 
                                           name="phone" 
                                           id="phone" 
                                           class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('phone') ring-red-500 @enderror"
                                           value="{{ old('phone') }}"
                                           placeholder="+225 XX XX XX XX XX">
                                    @error('phone')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Catégorie et profil -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Profil</h3>
                        
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <!-- Catégorie -->
                            <div>
                                <label for="category" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                    Catégorie <span class="text-red-500">*</span>
                                </label>
                                <div class="mt-2">
                                    <select name="category" 
                                            id="category" 
                                            required
                                            class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('category') ring-red-500 @enderror">
                                        <option value="">Sélectionnez une catégorie</option>
                                        @foreach(\App\Models\User::CATEGORIES as $key => $label)
                                            <option value="{{ $key }}" {{ old('category') == $key ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Profession -->
                            <div>
                                <label for="profession" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                    Profession
                                </label>
                                <div class="mt-2">
                                    <input type="text" 
                                           name="profession" 
                                           id="profession" 
                                           class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('profession') ring-red-500 @enderror"
                                           value="{{ old('profession') }}"
                                           placeholder="Ex: Développeur, Entrepreneur">
                                    @error('profession')
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
                                           value="{{ old('organization') }}"
                                           placeholder="Nom de l'entreprise ou organisation">
                                    @error('organization')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Ville -->
                            <div>
                                <label for="city" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                    Ville
                                </label>
                                <div class="mt-2">
                                    <input type="text" 
                                           name="city" 
                                           id="city" 
                                           class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('city') ring-red-500 @enderror"
                                           value="{{ old('city') }}"
                                           placeholder="Ex: Abidjan">
                                    @error('city')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bio et description -->
                    <div class="border-b border-gray-200 pb-6">
                        <!-- Bio -->
                        <div class="mb-6">
                            <label for="bio" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                Biographie
                            </label>
                            <div class="mt-2">
                                <textarea name="bio" 
                                          id="bio" 
                                          rows="4" 
                                          class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('bio') ring-red-500 @enderror"
                                          placeholder="Courte biographie de l'utilisateur...">{{ old('bio') }}</textarea>
                                @error('bio')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Description de l'entreprise -->
                        <div>
                            <label for="startup_description" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                Description de l'entreprise/startup
                            </label>
                            <div class="mt-2">
                                <textarea name="startup_description" 
                                          id="startup_description" 
                                          rows="4" 
                                          class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('startup_description') ring-red-500 @enderror"
                                          placeholder="Description de l'entreprise ou startup...">{{ old('startup_description') }}</textarea>
                                @error('startup_description')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Photo de profil -->
                    <div class="border-b border-gray-200 pb-6">
                        <label for="profile_picture" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                            Photo de profil
                        </label>
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

                    <!-- Paramètres du compte -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Paramètres du compte</h3>
                        
                        <div class="space-y-4">
                            <!-- Options -->
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                <div class="flex items-center">
                                    <input type="checkbox" 
                                           name="is_verified" 
                                           id="is_verified" 
                                           value="1"
                                           {{ old('is_verified') ? 'checked' : '' }}
                                           class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary">
                                    <label for="is_verified" class="ml-3 text-sm font-medium text-gray-700 font-poppins">
                                        Compte vérifié
                                    </label>
                                </div>
                                
                                <div class="flex items-center">
                                    <input type="checkbox" 
                                           name="is_active" 
                                           id="is_active" 
                                           value="1"
                                           {{ old('is_active', true) ? 'checked' : '' }}
                                           class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary">
                                    <label for="is_active" class="ml-3 text-sm font-medium text-gray-700 font-poppins">
                                        Compte actif
                                    </label>
                                </div>
                            </div>

                            <!-- Raison de blocage -->
                            <div>
                                <label for="lock_raison" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                    Raison de blocage (si inactif)
                                </label>
                                <div class="mt-2">
                                    <input type="text" 
                                           name="lock_raison" 
                                           id="lock_raison" 
                                           class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('lock_raison') ring-red-500 @enderror"
                                           value="{{ old('lock_raison') }}"
                                           placeholder="Raison du blocage du compte">
                                    @error('lock_raison')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end gap-x-3 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                <a href="{{ route('admin.users.index') }}" 
                   class="text-sm font-semibold leading-6 text-gray-900 hover:text-gray-700 font-poppins transition-colors">
                    Annuler
                </a>
                <button type="submit" 
                        class="inline-flex items-center rounded-md bg-primary px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-orange-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary transition-colors font-poppins">
                    <i data-lucide="save" class="h-4 w-4 mr-2"></i>
                    Créer l'utilisateur
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