<x-layouts.resident>
    <x-slot:title>Nouvelle réservation - Espace résident</x-slot:title>
    <x-slot:pageTitle>Nouvelle réservation</x-slot:pageTitle>
    <x-slot:pageDescription>Réservez un espace de travail selon vos besoins</x-slot:pageDescription>

    <div class="space-y-4">
        <!-- Back Button -->
        <div>
            <a href="{{ route('resident.espaces.index') }}" 
               class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
                Retour aux réservations
            </a>
        </div>

        <!-- Reservation Form -->
        <div class="bg-white rounded-lg border border-gray-200 p-4">
            <div class="mb-4">
                <h2 class="text-base font-semibold text-gray-900">Sélectionner un espace</h2>
                <p class="text-gray-600">Choisissez l'espace qui correspond à vos besoins</p>
            </div>

            @if($espaces->count() > 0)
                <form method="POST" action="{{ route('resident.espaces.store') }}" class="space-y-4">
                    @csrf
                    
                    <!-- Space Selection -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($espaces as $espace)
                            <div class="espace-card border border-gray-200 rounded-lg overflow-hidden transition-all duration-200 hover:border-gray-300">
                                <!-- Illustration -->
                                @if($espace->illustration_url)
                                    <div class="aspect-video w-full cursor-pointer" onclick="selectEspace({{ $espace->id }})">
                                        <img src="{{ $espace->illustration_url }}" 
                                             alt="{{ $espace->name }}" 
                                             class="w-full h-full object-cover hover:opacity-90 transition-opacity">
                                    </div>
                                @else
                                    <div class="aspect-video w-full bg-gray-100 flex items-center justify-center cursor-pointer hover:bg-gray-200 transition-colors" onclick="selectEspace({{ $espace->id }})">
                                        <i data-lucide="building-2" class="w-12 h-12 text-gray-400"></i>
                                    </div>
                                @endif
                                
                                <div class="p-3">
                                    <div class="flex items-center mb-2">
                                        <input type="radio" 
                                               id="espace_{{ $espace->id }}" 
                                               name="espace_id" 
                                               value="{{ $espace->id }}"
                                               class="text-orange-500 focus:ring-orange-500"
                                               required>
                                        <label for="espace_{{ $espace->id }}" class="ml-2 font-medium text-gray-900 cursor-pointer">
                                            {{ $espace->name }}
                                        </label>
                                    </div>
                                    
                                    @if($espace->description)
                                        <p class="text-sm text-gray-600 mb-2">{{ Str::limit($espace->description, 80) }}</p>
                                    @endif
                                    
                                    <div class="flex items-center justify-between text-sm">
                                        <div class="flex items-center space-x-2">
                                            @if($espace->type)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs bg-blue-100 text-blue-800">
                                                    {{ App\Models\Espace::FR_TYPES[$espace->type] ?? ucfirst(str_replace('_', ' ', $espace->type)) }}
                                                </span>
                                            @endif
                                            @if($espace->number_of_people)
                                                <span class="text-gray-500 flex items-center">
                                                    <i data-lucide="users" class="w-3 h-3 mr-1"></i>
                                                    {{ $espace->number_of_people }}
                                                </span>
                                            @endif
                                        </div>
                                        @if($espace->price_per_hour)
                                            <span class="font-medium text-gray-900">{{ number_format($espace->price_per_hour, 0, ',', ' ') }} FCFA/h</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Date and Time Selection -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <!-- Date -->
                        <div>
                            <label for="reservation_date" class="block text-sm font-medium text-gray-700 mb-1">
                                Date de réservation *
                            </label>
                            <input type="date" 
                                   id="reservation_date" 
                                   name="reservation_date" 
                                   min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                   value="{{ old('reservation_date') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 @error('reservation_date') border-red-500 @enderror"
                                   required>
                            @error('reservation_date')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Start Time -->
                        <div>
                            <label for="start_time" class="block text-sm font-medium text-gray-700 mb-1">
                                Heure de début *
                            </label>
                            <input type="time" 
                                   id="start_time" 
                                   name="start_time" 
                                   min="07:00" 
                                   max="22:00"
                                   value="{{ old('start_time', '09:00') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 @error('start_time') border-red-500 @enderror"
                                   required>
                            @error('start_time')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Additional Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Duration -->
                        <div>
                            <label for="duration" class="block text-sm font-medium text-gray-700 mb-1">
                                Durée (heures) *
                            </label>
                            <input type="number" 
                                   id="duration" 
                                   name="duration" 
                                   min="1" 
                                   max="12" 
                                   value="{{ old('duration', 2) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 @error('duration') border-red-500 @enderror"
                                   required>
                            @error('duration')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Participants -->
                        <div>
                            <label for="participants_count" class="block text-sm font-medium text-gray-700 mb-1">
                                Nombre de participants
                            </label>
                            <input type="number" 
                                   id="participants_count" 
                                   name="participants_count" 
                                   min="1" 
                                   max="50" 
                                   value="{{ old('participants_count', 1) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 @error('participants_count') border-red-500 @enderror">
                            @error('participants_count')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                            Description de l'utilisation
                        </label>
                        <textarea id="description" 
                                  name="description" 
                                  rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 @error('description') border-red-500 @enderror"
                                  placeholder="Décrivez brièvement l'utilisation prévue de l'espace...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Notes -->
                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">
                            Notes supplémentaires
                        </label>
                        <textarea id="notes" 
                                  name="notes" 
                                  rows="2"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 @error('notes') border-red-500 @enderror"
                                  placeholder="Informations complémentaires, besoins spécifiques...">{{ old('notes') }}</textarea>
                        @error('notes')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                        <a href="{{ route('resident.espaces.index') }}" 
                           class="px-4 py-2 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                            Annuler
                        </a>
                        <button type="submit" 
                                class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition-colors font-medium">
                            Créer la réservation
                        </button>
                    </div>
                </form>
            @else
                <!-- Empty State -->
                <div class="text-center py-8">
                    <i data-lucide="building-2" class="w-12 h-12 text-gray-300 mx-auto mb-3"></i>
                    <h3 class="text-base font-medium text-gray-900 mb-2">Aucun espace disponible</h3>
                    <p class="text-gray-500">Il n'y a aucun espace disponible pour le moment.</p>
                </div>
            @endif
        </div>
    </div>

    <x-slot:scripts>
        <script>
            function selectEspace(espaceId) {
                const radioButton = document.getElementById('espace_' + espaceId);
                if (radioButton) {
                    radioButton.checked = true;
                    
                    // Remove active class from all cards
                    document.querySelectorAll('.espace-card').forEach(card => {
                        card.classList.remove('ring-2', 'ring-orange-500', 'border-orange-500', 'outline', 'outline-2', 'outline-orange-500');
                        card.classList.add('border-gray-200');
                    });
                    
                    // Add active class to selected card
                    const selectedCard = radioButton.closest('.espace-card');
                    if (selectedCard) {
                        selectedCard.classList.remove('border-gray-200');
                        selectedCard.classList.add('outline', 'outline-2', 'outline-orange-500', 'border-orange-500');
                    }
                }
            }

            // Add event listeners to radio buttons
            document.addEventListener('DOMContentLoaded', function() {
                const radioButtons = document.querySelectorAll('input[name="espace_id"]');
                radioButtons.forEach(radio => {
                    radio.addEventListener('change', function() {
                        if (this.checked) {
                            selectEspace(this.value);
                        }
                    });
                });
            });
        </script>
    </x-slot:scripts>
</x-layouts.resident>