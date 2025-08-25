<x-layouts.resident>
    <x-slot:title>Événements - Espace résident</x-slot:title>
    <x-slot:pageTitle>Événements</x-slot:pageTitle>
    <x-slot:pageDescription>Découvrez et gérez vos inscriptions aux événements</x-slot:pageDescription>

    <div class="space-y-4">
        <!-- My Upcoming Events -->
        @if($myEvents->where('event.start_date', '>', now())->count() > 0)
            <div class="space-y-3">
                @foreach($myEvents->where('event.start_date', '>', now()) as $registration)
                    <div class="bg-white border border-gray-200 rounded-lg p-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="h-8 w-8 bg-green-500 rounded-lg flex items-center justify-center">
                                    <i data-lucide="calendar-days" class="w-4 h-4 text-white"></i>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-gray-900">{{ $registration->event->title }}</h3>
                                    <div class="flex items-center space-x-2 text-sm text-gray-500">
                                        <span>{{ \Carbon\Carbon::parse($registration->event->start_date)->format('d/m/Y à H:i') }}</span>
                                        @if($registration->event->getTranslatedAttribute('location'))
                                            <span>•</span>
                                            <span>{{ Str::limit($registration->event->getTranslatedAttribute('location'), 30) }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Inscrit
                                </span>
                                <a href="{{ route('resident.events.show', $registration->event->id) }}" 
                                   class="inline-flex items-center px-2 py-1 text-xs font-medium text-orange-600 bg-orange-50 border border-orange-200 rounded-md hover:bg-orange-100 transition-colors">
                                    <i data-lucide="eye" class="w-3 h-3 mr-1"></i>
                                    Détails
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif


        <!-- Past Events -->
        @if($pastEvents->count() > 0)
            <div class="bg-white rounded-lg border border-gray-200">
                <div class="p-3 border-b border-gray-200">
                    <h2 class="text-base font-semibold text-gray-900">Événements passés</h2>
                    <p class="text-gray-600">Événements auxquels vous avez participé</p>
                </div>
                <div class="p-3">
                    <div class="space-y-2">
                        @foreach($pastEvents->take(5) as $registration)
                            <div class="flex items-center justify-between p-2 border border-gray-200 rounded-lg">
                                <div class="flex items-center space-x-2">
                                    <div class="h-6 w-6 bg-gray-100 rounded-lg flex items-center justify-center">
                                        <i data-lucide="calendar-days" class="w-3 h-3 text-gray-400"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $registration->event->title }}</p>
                                        <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($registration->event->start_date)->format('d/m/Y') }}</p>
                                    </div>
                                </div>
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    Participé
                                </span>
                            </div>
                        @endforeach
                        @if($pastEvents->count() > 5)
                            <p class="text-xs text-gray-500 text-center mt-2">
                                ... et {{ $pastEvents->count() - 5 }} autre{{ $pastEvents->count() - 5 > 1 ? 's' : '' }} événement{{ $pastEvents->count() - 5 > 1 ? 's' : '' }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        <!-- Empty State -->
        @if($myEvents->count() === 0 && $pastEvents->count() === 0)
            <div class="bg-white rounded-lg border border-gray-200 p-8 text-center">
                <i data-lucide="calendar-days" class="w-12 h-12 text-gray-300 mx-auto mb-3"></i>
                <h3 class="text-base font-medium text-gray-900 mb-2">Aucun événement</h3>
                <p class="text-gray-500 mb-4">Il n'y a aucun événement disponible pour le moment.</p>
                <a href="{{ route('events') }}" 
                   class="text-orange-600 hover:text-orange-700 font-medium">
                    Découvrir les événements sur le site principal
                </a>
            </div>
        @endif
    </div>
</x-layouts.resident>