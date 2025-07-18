@props(['event', 'action' => ''])

<form action="{{ $action }}" method="POST" class="space-y-6">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">{{ __("Nom complet") }}</label>
            <input type="text" name="name" id="name" required value="{{ old('name', auth()->check() ? auth()->user()->name : '') }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500">
            @error('name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">{{ __("Adresse e-mail") }}</label>
            <input type="email" name="email" id="email" required value="{{ old('email', auth()->check() ? auth()->user()->email : '') }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500">
            @error('email')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="whatsapp" class="block text-sm font-medium text-gray-700">{{ __("Numéro WhatsApp (avec indicatif)") }}</label>
            <input type="tel" name="whatsapp" id="whatsapp" value="{{ old('whatsapp', auth()->check() ? auth()->user()->whatsapp : '') }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500">
            @error('whatsapp')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="position" class="block text-sm font-medium text-gray-700">{{ __("Poste/Fonction") }}</label>
            <input type="text" name="position" id="position" required value="{{ old('position', auth()->check() ? auth()->user()->position : '') }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500">
            @error('position')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="organization" class="block text-sm font-medium text-gray-700">{{ __("Organisation/Entreprise") }}</label>
            <input type="text" name="organization" id="organization" required value="{{ old('organization', auth()->check() ? auth()->user()->organization : '') }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500">
            @error('organization')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="country" class="block text-sm font-medium text-gray-700">{{ __("Pays de résidence") }}</label>
            <input type="text" name="country" id="country" required value="{{ old('country', auth()->check() ? auth()->user()->country : '') }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500">
            @error('country')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
    </div>
    <div>
        <label for="actor_type" class="block text-sm font-medium text-gray-700">{{ __("Vous êtes ?") }}</label>
        <select name="actor_type" id="actor_type" required
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500">
            <option value="">{{ __("Sélectionner...") }}</option>
            <option value="startup" @selected(old('actor_type') == 'startup')>{{ __("Startup") }}</option>
            <option value="etudiant" @selected(old('actor_type') == 'etudiant')>{{ __("Étudiant") }}</option>
            <option value="chercheur" @selected(old('actor_type') == 'chercheur')>{{ __("Chercheur") }}</option>
            <option value="investisseur" @selected(old('actor_type') == 'investisseur')>{{ __("Investisseur") }}</option>
            <option value="media" @selected(old('actor_type') == 'media')>{{ __("Média") }}</option>
            <option value="corporate" @selected(old('actor_type') == 'corporate')>{{ __("Corporate") }}</option>
            <option value="service_public" @selected(old('actor_type') == 'service_public')>{{ __("Service Public") }}</option>
            <option value="structure_accompagnement" @selected(old('actor_type') == 'structure_accompagnement')>{{ __("Structure d'accompagnement") }}</option>
            <option value="autre" @selected(old('actor_type') == 'autre')>{{ __("Autre") }}</option>
        </select>
        @error('actor_type')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <button type="submit"
                class="w-full bg-primary-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 disabled:opacity-50"
                @if(!$event->isRegistrationOpen()) disabled @endif>
            {{ $event->is_paid ? __("Continuer vers le paiement") : __("Confirmer l'inscription") }}
        </button>
    </div>
</form> 