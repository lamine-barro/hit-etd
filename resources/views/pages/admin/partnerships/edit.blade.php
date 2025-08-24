@extends('pages.admin.layouts.app')

@section('title', 'Modifier un partenariat')
@section('page-title', 'Modifier un partenariat')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- En-tête -->
    <div class="mb-8">
        <div class="flex items-center space-x-3 text-sm text-gray-500 mb-4">
            <a href="{{ route('admin.partnerships.index') }}" class="hover:text-primary transition-colors">Partenariats</a>
            <i data-lucide="chevron-right" class="h-4 w-4"></i>
            <span class="text-gray-900">Modifier {{ $partnership->organization_name }}</span>
        </div>
        <h1 class="text-2xl font-semibold text-gray-900 font-poppins">Modifier le partenariat</h1>
        <p class="mt-2 text-sm text-gray-600">Modifiez les informations du partenariat avec {{ $partnership->organization_name }}.</p>
    </div>

    <!-- Formulaire -->
    <form action="{{ route('admin.partnerships.update', $partnership) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
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
                                           value="{{ old('organization_name', $partnership->organization_name) }}"
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
                                            <option value="{{ $type->value }}" {{ old('type', $partnership->type->value) == $type->value ? 'selected' : '' }}>
                                                {{ $type->label() }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('type')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Personne de contact -->
                            <div>
                                <label for="contact_name" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                    Personne de contact
                                </label>
                                <div class="mt-2">
                                    <input type="text" 
                                           name="contact_name" 
                                           id="contact_name" 
                                           class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('contact_name') ring-red-500 @enderror"
                                           value="{{ old('contact_name', $partnership->contact_name) }}"
                                           placeholder="Ex: Marie Kouassi">
                                    @error('contact_name')
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
                                           value="{{ old('email', $partnership->email) }}"
                                           placeholder="marie.kouassi@example.com">
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
                                           value="{{ old('phone', $partnership->phone) }}"
                                           placeholder="+225 XX XX XX XX XX">
                                    @error('phone')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Montant -->
                            <div>
                                <label for="amount" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                    Montant (FCFA)
                                </label>
                                <div class="mt-2">
                                    <input type="number" 
                                           name="amount" 
                                           id="amount" 
                                           min="0"
                                           step="1000"
                                           class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('amount') ring-red-500 @enderror"
                                           value="{{ old('amount', $partnership->amount) }}"
                                           placeholder="Ex: 1000000">
                                    @error('amount')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Message et notes -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Message et notes</h3>
                        
                        <!-- Message de la demande -->
                        <div class="mb-6">
                            <label for="message" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                Message de la demande
                            </label>
                            <div class="mt-2">
                                <textarea name="message" 
                                          id="message" 
                                          rows="4" 
                                          class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('message') ring-red-500 @enderror"
                                          placeholder="Décrivez votre demande de partenariat, vos objectifs et ce que vous proposez...">{{ old('message', $partnership->message) }}</textarea>
                                @error('message')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Notes internes -->
                        <div>
                            <label for="internal_notes" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                Notes internes (non visibles par le partenaire)
                            </label>
                            <div class="mt-2">
                                <textarea name="internal_notes" 
                                          id="internal_notes" 
                                          rows="3" 
                                          class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('internal_notes') ring-red-500 @enderror"
                                          placeholder="Notes internes, commentaires de l'équipe, historique des échanges...">{{ old('internal_notes', $partnership->internal_notes) }}</textarea>
                                @error('internal_notes')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
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
                                    <option value="{{ $status->value }}" {{ old('status', $partnership->status->value) == $status->value ? 'selected' : '' }}>
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