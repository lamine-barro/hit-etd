@extends('pages.admin.layouts.app')

@section('title', 'Modifier l\'événement')
@section('page-title', 'Modifier l\'événement')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- En-tête -->
    <div class="mb-8">
        <div class="flex items-center space-x-3 text-sm text-gray-500 mb-4">
            <a href="{{ route('admin.events.index') }}" class="hover:text-primary transition-colors">Événements</a>
            <i data-lucide="chevron-right" class="h-4 w-4"></i>
            <a href="{{ route('admin.events.show', $event) }}" class="hover:text-primary transition-colors">{{ Str::limit($event->getTranslatedAttribute('title'), 30) }}</a>
            <i data-lucide="chevron-right" class="h-4 w-4"></i>
            <span class="text-gray-900">Modifier</span>
        </div>
        <h1 class="text-2xl font-semibold text-gray-900 font-poppins">Modifier l'événement</h1>
        <p class="mt-2 text-sm text-gray-600">Modifiez les informations de l'événement ci-dessous.</p>
    </div>

    <!-- Formulaire -->
    <form action="{{ route('admin.events.update', $event) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <!-- Card principale -->
        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
            <div class="px-4 py-6 sm:p-8">
                <div class="grid grid-cols-1 gap-6">
                    
                    <!-- Titre français -->
                    <div>
                        <label for="title_fr" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                            Titre de l'événement (Français) <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-2">
                            <input type="text" 
                                   name="title_fr" 
                                   id="title_fr" 
                                   required
                                   class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('title_fr') ring-red-500 @enderror"
                                   value="{{ old('title_fr', $event->translations->where('locale', 'fr')->first()?->title) }}"
                                   placeholder="Entrez le titre en français">
                            @error('title_fr')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Slug français -->
                    <div>
                        <label for="slug_fr" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                            Slug (Français) <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-2">
                            <input type="text" 
                                   name="slug_fr" 
                                   id="slug_fr" 
                                   required
                                   class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('slug_fr') ring-red-500 @enderror"
                                   value="{{ old('slug_fr', $event->translations->where('locale', 'fr')->first()?->slug) }}"
                                   placeholder="URL-friendly version du titre">
                            @error('slug_fr')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Titre anglais -->
                    <div>
                        <label for="title_en" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                            Titre de l'événement (Anglais)
                        </label>
                        <div class="mt-2">
                            <input type="text" 
                                   name="title_en" 
                                   id="title_en" 
                                   class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('title_en') ring-red-500 @enderror"
                                   value="{{ old('title_en', $event->translations->where('locale', 'en')->first()?->title) }}"
                                   placeholder="Entrez le titre en anglais">
                            @error('title_en')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Slug anglais -->
                    <div>
                        <label for="slug_en" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                            Slug (Anglais)
                        </label>
                        <div class="mt-2">
                            <input type="text" 
                                   name="slug_en" 
                                   id="slug_en" 
                                   class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('slug_en') ring-red-500 @enderror"
                                   value="{{ old('slug_en', $event->translations->where('locale', 'en')->first()?->slug) }}"
                                   placeholder="URL-friendly version du titre anglais">
                            @error('slug_en')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Description française -->
                    <div>
                        <label for="description_fr" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                            Description (Français) <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-2">
                            <textarea name="description_fr" 
                                      id="description_fr" 
                                      rows="4" 
                                      required
                                      class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('description_fr') ring-red-500 @enderror"
                                      placeholder="Description détaillée de l'événement en français">{{ old('description_fr', $event->translations->where('locale', 'fr')->first()?->description) }}</textarea>
                            @error('description_fr')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Description anglaise -->
                    <div>
                        <label for="description_en" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                            Description (Anglais)
                        </label>
                        <div class="mt-2">
                            <textarea name="description_en" 
                                      id="description_en" 
                                      rows="4" 
                                      class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('description_en') ring-red-500 @enderror"
                                      placeholder="Description détaillée de l'événement en anglais">{{ old('description_en', $event->translations->where('locale', 'en')->first()?->description) }}</textarea>
                            @error('description_en')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <!-- Date de début -->
                        <div>
                            <label for="start_date" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                Date et heure de début <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-2">
                                <input type="datetime-local" 
                                       name="start_date" 
                                       id="start_date" 
                                       required
                                       class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('start_date') ring-red-500 @enderror"
                                       value="{{ old('start_date', $event->start_date ? $event->start_date->format('Y-m-d\TH:i') : '') }}">
                                @error('start_date')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Date de fin -->
                        <div>
                            <label for="end_date" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                Date et heure de fin <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-2">
                                <input type="datetime-local" 
                                       name="end_date" 
                                       id="end_date" 
                                       required
                                       class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('end_date') ring-red-500 @enderror"
                                       value="{{ old('end_date', $event->end_date ? $event->end_date->format('Y-m-d\TH:i') : '') }}">
                                @error('end_date')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Date de fin d'inscription -->
                    <div>
                        <label for="registration_end_date" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                            Date limite d'inscription <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-2">
                            <input type="datetime-local" 
                                   name="registration_end_date" 
                                   id="registration_end_date" 
                                   required
                                   class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('registration_end_date') ring-red-500 @enderror"
                                   value="{{ old('registration_end_date', $event->registration_end_date ? $event->registration_end_date->format('Y-m-d\TH:i') : '') }}">
                            @error('registration_end_date')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Lieu français et anglais -->
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <!-- Lieu français -->
                        <div>
                            <label for="location_fr" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                Lieu (Français)
                            </label>
                            <div class="mt-2">
                                <input type="text" 
                                       name="location_fr" 
                                       id="location_fr" 
                                       class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('location_fr') ring-red-500 @enderror"
                                       value="{{ old('location_fr', $event->translations->where('locale', 'fr')->first()?->location) }}"
                                       placeholder="Adresse ou plateforme en ligne">
                                @error('location_fr')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Lieu anglais -->
                        <div>
                            <label for="location_en" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                Lieu (Anglais)
                            </label>
                            <div class="mt-2">
                                <input type="text" 
                                       name="location_en" 
                                       id="location_en" 
                                       class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('location_en') ring-red-500 @enderror"
                                       value="{{ old('location_en', $event->translations->where('locale', 'en')->first()?->location) }}"
                                       placeholder="Address or online platform">
                                @error('location_en')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Type -->
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">

                        <!-- Type -->
                        <div>
                            <label for="type" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                Type d'événement <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-2">
                                <select name="type" 
                                        id="type" 
                                        required
                                        class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('type') ring-red-500 @enderror">
                                    <option value="">Sélectionnez un type</option>
                                    <option value="conference" {{ old('type', $event->type) == 'conference' ? 'selected' : '' }}>Conférence</option>
                                    <option value="workshop" {{ old('type', $event->type) == 'workshop' ? 'selected' : '' }}>Atelier</option>
                                    <option value="networking" {{ old('type', $event->type) == 'networking' ? 'selected' : '' }}>Networking</option>
                                    <option value="hackathon" {{ old('type', $event->type) == 'hackathon' ? 'selected' : '' }}>Hackathon</option>
                                    <option value="webinar" {{ old('type', $event->type) == 'webinar' ? 'selected' : '' }}>Webinaire</option>
                                    <option value="competition" {{ old('type', $event->type) == 'competition' ? 'selected' : '' }}>Concours</option>
                                </select>
                                @error('type')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Lien externe -->
                        <div>
                            <label for="external_link" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                Lien externe
                            </label>
                            <div class="mt-2">
                                <input type="url" 
                                       name="external_link" 
                                       id="external_link" 
                                       class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('external_link') ring-red-500 @enderror"
                                       value="{{ old('external_link', $event->external_link) }}"
                                       placeholder="https://example.com">
                                @error('external_link')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Programme -->
                    <div>
                        <label for="agenda" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                            Programme / Agenda
                        </label>
                        <div class="mt-2">
                            <textarea name="agenda" 
                                      id="agenda" 
                                      rows="4" 
                                      class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('agenda') ring-red-500 @enderror"
                                      placeholder="Détail du programme de l'événement">{{ old('agenda', $event->getTranslatedAttribute('agenda')) }}</textarea>
                            @error('agenda')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Image d'illustration -->
                    <div>
                        <label for="illustration" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                            Image d'illustration
                        </label>
                        @if($event->illustration)
                            <div class="mt-2 mb-3">
                                <img src="{{ asset('storage/' . $event->illustration) }}" alt="Illustration actuelle" class="h-32 w-auto rounded-lg shadow-sm">
                                <p class="mt-1 text-sm text-gray-500">Image actuelle</p>
                            </div>
                        @endif
                        <div class="mt-2 flex items-center gap-x-3">
                            <input type="file" 
                                   name="illustration" 
                                   id="illustration"
                                   accept="image/*"
                                   class="block w-full text-sm text-gray-900 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-orange-700 file:transition-colors font-poppins @error('illustration') ring-red-500 @enderror">
                        </div>
                        <p class="mt-1 text-sm text-gray-500">Laissez vide pour conserver l'image actuelle</p>
                        @error('illustration')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Paramètres avancés -->
                    <div class="border-t border-gray-200 pt-6">
                        <h3 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Paramètres</h3>
                        
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <!-- Capacité -->
                            <div>
                                <label for="max_participants" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                    Nombre maximum de participants <span class="text-red-500">*</span>
                                </label>
                                <div class="mt-2">
                                    <input type="number" 
                                           name="max_participants" 
                                           id="max_participants" 
                                           min="1"
                                           required
                                           class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('max_participants') ring-red-500 @enderror"
                                           value="{{ old('max_participants', $event->max_participants) }}"
                                           placeholder="Nombre de participants maximum">
                                    @error('max_participants')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Champ vide pour maintenir la grille -->
                            <div></div>
                        </div>

                        <!-- Prix et options payantes -->
                        <div class="mt-6">
                            <div class="flex items-center mb-4">
                                <input type="checkbox" 
                                       name="is_paid" 
                                       id="is_paid" 
                                       value="1"
                                       {{ old('is_paid', $event->is_paid) ? 'checked' : '' }}
                                       class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary"
                                       onchange="togglePriceFields()">
                                <label for="is_paid" class="ml-3 text-sm font-medium text-gray-700 font-poppins">
                                    Événement payant
                                </label>
                            </div>

                            <div id="price-fields" class="grid grid-cols-1 gap-6 sm:grid-cols-3" style="display: {{ old('is_paid', $event->is_paid) ? 'grid' : 'none' }}">
                                <!-- Prix normal -->
                                <div>
                                    <label for="price" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                        Prix (FCFA)
                                    </label>
                                    <div class="mt-2">
                                        <input type="number" 
                                               name="price" 
                                               id="price" 
                                               min="0"
                                               step="100"
                                               class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('price') ring-red-500 @enderror"
                                               value="{{ old('price', $event->price) }}"
                                               placeholder="Prix normal">
                                        @error('price')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Prix early bird -->
                                <div>
                                    <label for="early_bird_price" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                        Prix Early Bird (FCFA)
                                    </label>
                                    <div class="mt-2">
                                        <input type="number" 
                                               name="early_bird_price" 
                                               id="early_bird_price" 
                                               min="0"
                                               step="100"
                                               class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('early_bird_price') ring-red-500 @enderror"
                                               value="{{ old('early_bird_price', $event->early_bird_price) }}"
                                               placeholder="Prix réduit">
                                        @error('early_bird_price')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Date fin early bird -->
                                <div>
                                    <label for="early_bird_end_date" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                        Fin Early Bird
                                    </label>
                                    <div class="mt-2">
                                        <input type="datetime-local" 
                                               name="early_bird_end_date" 
                                               id="early_bird_end_date" 
                                               class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('early_bird_end_date') ring-red-500 @enderror"
                                               value="{{ old('early_bird_end_date', $event->early_bird_end_date ? $event->early_bird_end_date->format('Y-m-d\TH:i') : '') }}">
                                        @error('early_bird_end_date')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Devise -->
                            <div class="mt-4" id="currency-field" style="display: {{ old('is_paid', $event->is_paid) ? 'block' : 'none' }}">
                                <label for="currency" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                    Devise
                                </label>
                                <div class="mt-2">
                                    <select name="currency" 
                                            id="currency" 
                                            class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('currency') ring-red-500 @enderror">
                                        <option value="XOF" {{ old('currency', $event->currency) == 'XOF' ? 'selected' : '' }}>FCFA (XOF)</option>
                                        <option value="EUR" {{ old('currency', $event->currency) == 'EUR' ? 'selected' : '' }}>Euro (EUR)</option>
                                        <option value="USD" {{ old('currency', $event->currency) == 'USD' ? 'selected' : '' }}>Dollar (USD)</option>
                                    </select>
                                    @error('currency')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Tags -->
                        <div class="mt-6">
                            <label for="tags" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                Tags
                            </label>
                            <div class="mt-2">
                                <input type="text" 
                                       name="tags" 
                                       id="tags"
                                       class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('tags') ring-red-500 @enderror"
                                       value="{{ old('tags', is_array($event->tags) ? implode(', ', $event->tags) : $event->tags) }}"
                                       placeholder="Séparez les tags par des virgules">
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Exemple: innovation, startup, tech</p>
                            @error('tags')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Options -->
                        <div class="mt-6">
                            <label class="block text-sm font-medium leading-6 text-gray-900 font-poppins mb-4">
                                Options
                            </label>
                            <div class="space-y-3">
                                <div class="flex items-center">
                                    <input type="checkbox" 
                                           name="is_remote" 
                                           id="is_remote" 
                                           value="1"
                                           {{ old('is_remote', $event->is_remote) ? 'checked' : '' }}
                                           class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary">
                                    <label for="is_remote" class="ml-3 text-sm font-medium text-gray-700 font-poppins">
                                        Événement en ligne
                                    </label>
                                </div>
                                
                                <div class="flex items-center">
                                    <input type="checkbox" 
                                           name="requires_approval" 
                                           id="requires_approval" 
                                           value="1"
                                           {{ old('requires_approval', $event->requires_approval) ? 'checked' : '' }}
                                           class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary">
                                    <label for="requires_approval" class="ml-3 text-sm font-medium text-gray-700 font-poppins">
                                        Inscription soumise à validation
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Statut -->
                        <div class="mt-6">
                            <label for="status" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                Statut <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-2">
                                <select name="status" 
                                        id="status" 
                                        required
                                        class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('status') ring-red-500 @enderror">
                                    @foreach(\App\Enums\EventStatus::cases() as $status)
                                        <option value="{{ $status->value }}" {{ old('status', $event->status?->value) == $status->value ? 'selected' : '' }}>
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
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between border-t border-gray-900/10 px-4 py-4 sm:px-8">
                <button type="button" 
                        onclick="openConfirmModal('{{ route('admin.events.destroy', $event) }}', 'Êtes-vous sûr de vouloir supprimer cet événement ?', 'delete', 'DELETE')"
                        class="inline-flex items-center text-sm font-semibold text-gray-600 hover:text-red-700 font-poppins transition-colors">
                    <i data-lucide="trash-2" class="h-4 w-4 mr-2"></i>
                    Supprimer l'événement
                </button>
                
                <div class="flex items-center gap-x-3">
                    <a href="{{ route('admin.events.show', $event) }}" 
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
function togglePriceFields() {
    const isPaidCheckbox = document.getElementById('is_paid');
    const priceFields = document.getElementById('price-fields');
    const currencyField = document.getElementById('currency-field');
    
    if (isPaidCheckbox.checked) {
        priceFields.style.display = 'grid';
        currencyField.style.display = 'block';
    } else {
        priceFields.style.display = 'none';
        currencyField.style.display = 'none';
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