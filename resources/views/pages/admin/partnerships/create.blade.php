@extends('pages.admin.layouts.app')

@section('title', 'Créer un partenariat')
@section('page-title', 'Créer un partenariat')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- En-tête -->
    <div class="mb-8">
        <div class="flex items-center space-x-3 text-sm text-gray-500 mb-4">
            <a href="{{ route('admin.partnerships.index') }}" class="hover:text-primary transition-colors">Partenariats</a>
            <i data-lucide="chevron-right" class="h-4 w-4"></i>
            <span class="text-gray-900">Nouveau partenariat</span>
        </div>
        <h1 class="text-2xl font-semibold text-gray-900 font-poppins">Créer un nouveau partenariat</h1>
        <p class="mt-2 text-sm text-gray-600">Remplissez les informations ci-dessous pour créer un nouveau partenariat.</p>
    </div>

    <!-- Formulaire -->
    <form action="{{ route('admin.partnerships.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <!-- Card principale -->
        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
            <div class="px-4 py-6 sm:p-8">
                <div class="grid grid-cols-1 gap-6">
                    
                    <!-- Informations de l'organisation -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Informations de l'organisation</h3>
                        
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <!-- Nom de l'organisation -->
                            <div>
                                <label for="organization_name" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                    Nom de l'organisation <span class="text-red-500">*</span>
                                </label>
                                <div class="mt-2">
                                    <input type="text" 
                                           name="organization_name" 
                                           id="organization_name" 
                                           required
                                           class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('organization_name') ring-red-500 @enderror"
                                           value="{{ old('organization_name') }}"
                                           placeholder="Ex: Orange Digital Center">
                                    @error('organization_name')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Type de partenariat -->
                            <div>
                                <label for="type" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                    Type de partenariat <span class="text-red-500">*</span>
                                </label>
                                <div class="mt-2">
                                    <select name="type" 
                                            id="type" 
                                            required
                                            class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('type') ring-red-500 @enderror">
                                        <option value="">Sélectionnez un type</option>
                                        @foreach(\App\Enums\PartnershipType::cases() as $type)
                                            <option value="{{ $type->value }}" {{ old('type') == $type->value ? 'selected' : '' }}>
                                                {{ $type->label() }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('type')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Site web -->
                            <div>
                                <label for="website" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                    Site web
                                </label>
                                <div class="mt-2">
                                    <input type="url" 
                                           name="website" 
                                           id="website" 
                                           class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('website') ring-red-500 @enderror"
                                           value="{{ old('website') }}"
                                           placeholder="https://example.com">
                                    @error('website')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Secteur d'activité -->
                            <div>
                                <label for="industry" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                    Secteur d'activité
                                </label>
                                <div class="mt-2">
                                    <input type="text" 
                                           name="industry" 
                                           id="industry" 
                                           class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('industry') ring-red-500 @enderror"
                                           value="{{ old('industry') }}"
                                           placeholder="Ex: Technologie, Finance, Éducation">
                                    @error('industry')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Informations de contact -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Informations de contact</h3>
                        
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <!-- Nom du contact -->
                            <div>
                                <label for="contact_name" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                    Nom du contact <span class="text-red-500">*</span>
                                </label>
                                <div class="mt-2">
                                    <input type="text" 
                                           name="contact_name" 
                                           id="contact_name" 
                                           required
                                           class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('contact_name') ring-red-500 @enderror"
                                           value="{{ old('contact_name') }}"
                                           placeholder="Ex: Marie Kouassi">
                                    @error('contact_name')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Poste du contact -->
                            <div>
                                <label for="contact_position" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                    Poste du contact
                                </label>
                                <div class="mt-2">
                                    <input type="text" 
                                           name="contact_position" 
                                           id="contact_position" 
                                           class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('contact_position') ring-red-500 @enderror"
                                           value="{{ old('contact_position') }}"
                                           placeholder="Ex: Directeur des Partenariats">
                                    @error('contact_position')
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
                                           placeholder="contact@example.com">
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

                    <!-- Détails du partenariat -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Détails du partenariat</h3>
                        
                        <!-- Description -->
                        <div class="mb-6">
                            <label for="description" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                Description du partenariat <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-2">
                                <textarea name="description" 
                                          id="description" 
                                          rows="4" 
                                          required
                                          class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('description') ring-red-500 @enderror"
                                          placeholder="Décrivez la nature et les objectifs du partenariat...">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Objectifs -->
                        <div class="mb-6">
                            <label for="objectives" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                Objectifs du partenariat
                            </label>
                            <div class="mt-2">
                                <textarea name="objectives" 
                                          id="objectives" 
                                          rows="3" 
                                          class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('objectives') ring-red-500 @enderror"
                                          placeholder="Définissez les objectifs spécifiques de ce partenariat...">{{ old('objectives') }}</textarea>
                                @error('objectives')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Bénéfices -->
                        <div class="mb-6">
                            <label for="benefits" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                Bénéfices attendus
                            </label>
                            <div class="mt-2">
                                <textarea name="benefits" 
                                          id="benefits" 
                                          rows="3" 
                                          class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('benefits') ring-red-500 @enderror"
                                          placeholder="Décrivez les bénéfices attendus pour les deux parties...">{{ old('benefits') }}</textarea>
                                @error('benefits')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Durée et dates -->
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <!-- Date de début souhaitée -->
                            <div>
                                <label for="start_date" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                    Date de début souhaitée
                                </label>
                                <div class="mt-2">
                                    <input type="date" 
                                           name="start_date" 
                                           id="start_date" 
                                           class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('start_date') ring-red-500 @enderror"
                                           value="{{ old('start_date') }}">
                                    @error('start_date')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Durée du partenariat -->
                            <div>
                                <label for="duration" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                    Durée du partenariat
                                </label>
                                <div class="mt-2">
                                    <select name="duration" 
                                            id="duration" 
                                            class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('duration') ring-red-500 @enderror">
                                        <option value="">Sélectionnez une durée</option>
                                        <option value="3_months" {{ old('duration') == '3_months' ? 'selected' : '' }}>3 mois</option>
                                        <option value="6_months" {{ old('duration') == '6_months' ? 'selected' : '' }}>6 mois</option>
                                        <option value="1_year" {{ old('duration') == '1_year' ? 'selected' : '' }}>1 an</option>
                                        <option value="2_years" {{ old('duration') == '2_years' ? 'selected' : '' }}>2 ans</option>
                                        <option value="3_years" {{ old('duration') == '3_years' ? 'selected' : '' }}>3 ans</option>
                                        <option value="indefinite" {{ old('duration') == 'indefinite' ? 'selected' : '' }}>Indéterminée</option>
                                    </select>
                                    @error('duration')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Documents -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Documents</h3>
                        
                        <!-- Logo de l'organisation -->
                        <div class="mb-6">
                            <label for="logo" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                Logo de l'organisation
                            </label>
                            <div class="mt-2 flex items-center gap-x-3">
                                <input type="file" 
                                       name="logo" 
                                       id="logo"
                                       accept="image/*"
                                       class="block w-full text-sm text-gray-900 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-orange-700 file:transition-colors font-poppins @error('logo') ring-red-500 @enderror">
                            </div>
                            @error('logo')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Documents supplémentaires -->
                        <div>
                            <label for="documents" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                Documents supplémentaires
                            </label>
                            <div class="mt-2 flex items-center gap-x-3">
                                <input type="file" 
                                       name="documents[]" 
                                       id="documents"
                                       multiple
                                       accept=".pdf,.doc,.docx,.txt"
                                       class="block w-full text-sm text-gray-900 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-orange-700 file:transition-colors font-poppins @error('documents') ring-red-500 @enderror">
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Formats acceptés : PDF, DOC, DOCX, TXT</p>
                            @error('documents')
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
                                @foreach(\App\Enums\PartnershipStatus::cases() as $status)
                                    <option value="{{ $status->value }}" {{ old('status', 'pending') == $status->value ? 'selected' : '' }}>
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

            <!-- Actions -->
            <div class="flex items-center justify-end gap-x-3 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                <a href="{{ route('admin.partnerships.index') }}" 
                   class="text-sm font-semibold leading-6 text-gray-900 hover:text-gray-700 font-poppins transition-colors">
                    Annuler
                </a>
                <button type="submit" 
                        class="inline-flex items-center rounded-md bg-primary px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-orange-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary transition-colors font-poppins">
                    <i data-lucide="save" class="h-4 w-4 mr-2"></i>
                    Créer le partenariat
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