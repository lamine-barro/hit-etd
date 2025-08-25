<x-layouts.resident>
    <x-slot:title>{{ $event->getTranslatedAttribute('title') }} - Espace résident</x-slot:title>
    <x-slot:pageTitle>Détails de l'événement</x-slot:pageTitle>
    <x-slot:pageDescription>{{ Str::limit($event->getTranslatedAttribute('description'), 150) }}</x-slot:pageDescription>

    <div class="space-y-4">
        <!-- Back Button -->
        <div>
            <a href="{{ route('resident.events.index') }}" 
               class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
                Retour aux événements
            </a>
        </div>

        <!-- Event Header -->
        <div class="bg-white rounded-lg border border-gray-200 p-4">
            <div class="flex items-start justify-between mb-4">
                <div class="flex-1">
                    <h1 class="text-xl font-semibold text-gray-900 mb-2">{{ $event->getTranslatedAttribute('title') }}</h1>
                    
                    <div class="flex items-center space-x-4 text-sm text-gray-600">
                        <div class="flex items-center">
                            <i data-lucide="calendar" class="w-4 h-4 mr-1"></i>
                            <span>{{ $event->start_date->format('d/m/Y à H:i') }}</span>
                        </div>
                        
                        @if($event->getTranslatedAttribute('location'))
                        <div class="flex items-center">
                            <i data-lucide="map-pin" class="w-4 h-4 mr-1"></i>
                            <span>{{ $event->getTranslatedAttribute('location') }}</span>
                        </div>
                        @endif
                        
                        <div class="flex items-center">
                            <i data-lucide="users" class="w-4 h-4 mr-1"></i>
                            <span>{{ $event->registrations->count() }} participant{{ $event->registrations->count() > 1 ? 's' : '' }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center space-x-2">
                    @if($event->is_paid)
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                            {{ number_format($event->getCurrentPrice(), 0, ',', ' ') }} FCFA
                        </span>
                    @else
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            Gratuit
                        </span>
                    @endif
                    
                    @if($isRegistered)
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <i data-lucide="check" class="w-3 h-3 mr-1"></i>
                            Inscrit
                        </span>
                    @endif
                </div>
            </div>

            <!-- Event Image -->
            @if($event->illustration)
            <div class="mb-4">
                @if(str_starts_with($event->illustration, 'http'))
                    <img src="{{ $event->illustration }}" 
                         alt="{{ $event->getTranslatedAttribute('title') }}" 
                         class="w-full h-48 object-cover rounded-lg">
                @else
                    <img src="{{ asset('storage/' . $event->illustration) }}" 
                         alt="{{ $event->getTranslatedAttribute('title') }}" 
                         class="w-full h-48 object-cover rounded-lg">
                @endif
            </div>
            @endif

            <!-- Event Description -->
            <div class="mb-4">
                <h2 class="text-sm font-medium text-gray-700 mb-2">Description</h2>
                <div class="text-gray-900 text-sm">
                    {!! nl2br(e($event->getTranslatedAttribute('description'))) !!}
                </div>
            </div>

            <!-- Event Agenda -->
            @if($event->getTranslatedAttribute('agenda'))
            <div class="border-t border-gray-200 pt-4">
                <h2 class="text-sm font-medium text-gray-700 mb-2">Programme</h2>
                <div class="text-gray-900 text-sm">
                    {!! nl2br(e($event->getTranslatedAttribute('agenda'))) !!}
                </div>
            </div>
            @endif
        </div>

        <!-- Registration Status & Actions -->
        <div class="bg-white rounded-lg border border-gray-200 p-4">
            @if($isRegistered)
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-medium text-gray-900 mb-1">Vous êtes inscrit à cet événement</h3>
                        <p class="text-xs text-gray-500">Inscrit le {{ $registration->created_at->format('d/m/Y à H:i') }}</p>
                    </div>
                    
                    @if($event->start_date > now()->addHours(24))
                    <form method="POST" action="{{ route('resident.events.cancel', $registration) }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                onclick="return confirm('Annuler votre inscription à cet événement ?')"
                                class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-red-600 bg-red-50 border border-red-200 rounded-md hover:bg-red-100 hover:border-red-300 transition-colors">
                            <i data-lucide="x" class="w-3 h-3 mr-1"></i>
                            Annuler inscription
                        </button>
                    </form>
                    @endif
                </div>
            @else
                @if($event->start_date > now() && (!$event->max_participants || $event->registrations->count() < $event->max_participants))
                <div class="text-center">
                    <h3 class="text-sm font-medium text-gray-900 mb-2">Inscrivez-vous à cet événement</h3>
                    
                    @if($event->max_participants)
                    <p class="text-xs text-gray-500 mb-3">
                        {{ $event->getAvailableSpots() }} place{{ $event->getAvailableSpots() > 1 ? 's' : '' }} disponible{{ $event->getAvailableSpots() > 1 ? 's' : '' }} sur {{ $event->max_participants }}
                    </p>
                    @endif
                    
                    <form method="POST" action="{{ route('resident.events.register', $event) }}">
                        @csrf
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-colors font-medium">
                            <i data-lucide="calendar-plus" class="w-4 h-4 mr-2"></i>
                            S'inscrire
                        </button>
                    </form>
                </div>
                @elseif($event->start_date <= now())
                <div class="text-center text-gray-500">
                    <i data-lucide="clock" class="w-8 h-8 mx-auto mb-2 text-gray-400"></i>
                    <p class="text-sm">Cet événement est terminé</p>
                </div>
                @elseif($event->max_participants && $event->registrations->count() >= $event->max_participants)
                <div class="text-center text-gray-500">
                    <i data-lucide="users-x" class="w-8 h-8 mx-auto mb-2 text-gray-400"></i>
                    <p class="text-sm">Événement complet</p>
                </div>
                @endif
            @endif
        </div>

        <!-- Event Details -->
        <div class="bg-white rounded-lg border border-gray-200 p-4">
            <h3 class="text-sm font-medium text-gray-700 mb-3">Informations pratiques</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div>
                    <span class="text-gray-600">Date de début :</span>
                    <span class="text-gray-900 font-medium">{{ $event->start_date->format('d/m/Y à H:i') }}</span>
                </div>
                
                <div>
                    <span class="text-gray-600">Date de fin :</span>
                    <span class="text-gray-900 font-medium">{{ $event->end_date->format('d/m/Y à H:i') }}</span>
                </div>
                
                @if($event->getTranslatedAttribute('location'))
                <div>
                    <span class="text-gray-600">Lieu :</span>
                    <span class="text-gray-900 font-medium">{{ $event->getTranslatedAttribute('location') }}</span>
                </div>
                @endif
                
                <div>
                    <span class="text-gray-600">Type :</span>
                    <span class="text-gray-900 font-medium">{{ ucfirst($event->type) }}</span>
                </div>
                
                @if($event->max_participants)
                <div>
                    <span class="text-gray-600">Capacité :</span>
                    <span class="text-gray-900 font-medium">{{ $event->max_participants }} personnes</span>
                </div>
                @endif
                
                <div>
                    <span class="text-gray-600">Participants actuels :</span>
                    <span class="text-gray-900 font-medium">{{ $event->registrations->count() }} personnes</span>
                </div>
            </div>

            @if($event->tags && count($event->tags) > 0)
            <div class="border-t border-gray-200 pt-3 mt-3">
                <span class="text-gray-600 text-sm">Tags :</span>
                <div class="flex flex-wrap gap-2 mt-1">
                    @foreach($event->tags as $tag)
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                            {{ $tag }}
                        </span>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</x-layouts.resident>