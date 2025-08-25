<x-layouts.resident>
    <x-slot:title>Tableau de bord - Espace résident</x-slot:title>
    <x-slot:pageTitle>Tableau de bord</x-slot:pageTitle>
    <x-slot:pageDescription>Bienvenue {{ auth()->user()->name }}, voici un aperçu de votre activité</x-slot:pageDescription>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3 mb-4">
        <!-- Réservations d'espaces -->
        <div class="bg-white rounded-lg p-3 border border-gray-200">
            <div class="flex items-center justify-between mb-2">
                <div class="h-8 w-8 bg-blue-50 rounded-lg flex items-center justify-center">
                    <i data-lucide="building-2" class="w-4 h-4 text-blue-600"></i>
                </div>
                <span class="text-xs text-green-600 font-medium">{{ $stats['active_orders'] }} actives</span>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-900">{{ $stats['orders_count'] }}</p>
                <p class="text-xs text-gray-500 mt-1">Total réservations</p>
            </div>
        </div>

        <!-- Événements inscrits -->
        <div class="bg-white rounded-lg p-3 border border-gray-200">
            <div class="flex items-center justify-between mb-2">
                <div class="h-8 w-8 bg-green-50 rounded-lg flex items-center justify-center">
                    <i data-lucide="calendar-days" class="w-4 h-4 text-green-600"></i>
                </div>
                <span class="text-xs text-blue-600 font-medium">{{ $stats['upcoming_events'] }} à venir</span>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-900">{{ $stats['events_registered'] }}</p>
                <p class="text-xs text-gray-500 mt-1">Événements inscrits</p>
            </div>
        </div>

        <!-- Statut du compte -->
        <div class="bg-white rounded-lg p-3 border border-gray-200">
            <div class="flex items-center justify-between mb-2">
                <div class="h-8 w-8 {{ auth()->user()->is_active ? 'bg-green-50' : 'bg-red-50' }} rounded-lg flex items-center justify-center">
                    <i data-lucide="{{ auth()->user()->is_active ? 'check-circle' : 'x-circle' }}" class="w-4 h-4 {{ auth()->user()->is_active ? 'text-green-600' : 'text-red-600' }}"></i>
                </div>
                <span class="text-xs {{ auth()->user()->is_active ? 'text-green-600' : 'text-red-600' }} font-medium">
                    {{ auth()->user()->is_active ? 'Actif' : 'Inactif' }}
                </span>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-900">Compte</p>
                <p class="text-xs text-gray-500 mt-1">{{ ucfirst(str_replace('_', ' ', auth()->user()->category ?? '')) }}</p>
            </div>
        </div>

        <!-- Membre depuis -->
        <div class="bg-white rounded-lg p-3 border border-gray-200">
            <div class="flex items-center justify-between mb-2">
                <div class="h-8 w-8 bg-purple-50 rounded-lg flex items-center justify-center">
                    <i data-lucide="user" class="w-4 h-4 text-purple-600"></i>
                </div>
                <span class="text-xs text-gray-600 font-medium">{{ auth()->user()->created_at->format('M Y') }}</span>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-900">Membre</p>
                <p class="text-xs text-gray-500 mt-1">{{ auth()->user()->created_at->diffForHumans() }}</p>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <!-- Réservations récentes -->
        <div class="bg-white rounded-lg border border-gray-200">
            <div class="p-3 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <h3 class="text-base font-semibold text-gray-900">Réservations récentes</h3>
                    <a href="{{ route('resident.espaces.index') }}" class="text-orange-600 hover:text-orange-700 text-sm font-medium">Voir tout</a>
                </div>
            </div>
            <div class="p-3">
                @forelse($recentOrders as $order)
                    <div class="flex items-center justify-between py-2 {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
                        <div class="flex items-center gap-2">
                            <div class="h-8 w-8 bg-blue-50 rounded-lg flex items-center justify-center">
                                <i data-lucide="building-2" class="w-4 h-4 text-blue-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">
                                    @if($order->orderItems->first() && $order->orderItems->first()->espace)
                                        {{ $order->orderItems->first()->espace->name }}
                                    @else
                                        Réservation d'espace
                                    @endif
                                </p>
                                <p class="text-sm text-gray-500">{{ $order->created_at->format('d/m/Y') }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium
                                {{ $order->status === 'confirmed' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $order->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                            <p class="text-sm text-gray-500">{{ $order->orderItems->count() }} item(s)</p>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-6">
                        <i data-lucide="building-2" class="w-10 h-10 text-gray-300 mx-auto mb-2"></i>
                        <p class="text-gray-500">Aucune réservation récente</p>
                        <a href="{{ route('resident.espaces.create') }}" class="text-primary-600 hover:text-primary-700 text-sm font-medium">Réserver un espace</a>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Événements à venir -->
        <div class="bg-white rounded-lg border border-gray-200">
            <div class="p-3 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-base font-semibold text-gray-900">Mes événements à venir</h3>
                    <a href="{{ route('resident.events.index') }}" class="text-primary-600 hover:text-primary-700 text-sm font-medium">Voir tout</a>
                </div>
            </div>
            <div class="p-3">
                @forelse($upcomingEvents as $registration)
                    <div class="flex items-center justify-between py-2 {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
                        <div class="flex items-center space-x-2">
                            <div class="h-8 w-8 bg-green-600 rounded-lg flex items-center justify-center">
                                <i data-lucide="calendar-days" class="w-4 h-4 text-white"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">{{ $registration->event->title }}</p>
                                <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($registration->event->start_date)->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                Inscrit
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-6">
                        <i data-lucide="calendar-days" class="w-10 h-10 text-gray-300 mx-auto mb-2"></i>
                        <p class="text-gray-500">Aucun événement à venir</p>
                        <a href="{{ route('resident.events.index') }}" class="text-primary-600 hover:text-primary-700 text-sm font-medium">Découvrir les événements</a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Available Events Section -->
    @if($availableEvents->count() > 0)
    <div class="mt-4">
        <div class="bg-white rounded-lg border border-gray-200">
            <div class="p-3 border-b border-gray-200">
                <h3 class="text-base font-semibold text-gray-900">Événements disponibles pour inscription</h3>
                <p class="text-gray-600">Découvrez les prochains événements et inscrivez-vous</p>
            </div>
            <div class="p-3">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach($availableEvents as $event)
                        <div class="border border-gray-200 rounded-lg p-3">
                            <div class="flex items-center space-x-2 mb-2">
                                <div class="h-6 w-6 bg-orange-500 rounded-lg flex items-center justify-center">
                                    <i data-lucide="calendar-days" class="w-3 h-3 text-white"></i>
                                </div>
                                <h4 class="font-semibold text-gray-900">{{ $event->title }}</h4>
                            </div>
                            <p class="text-sm text-gray-600 mb-2">{{ Str::limit($event->description, 100) }}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y') }}</span>
                                <a href="{{ route('resident.events.show', $event->id) }}" class="text-primary-600 hover:text-primary-700 text-sm font-medium">Voir détails</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Quick Actions -->
    <div class="mt-4">
        <h3 class="text-base font-semibold text-gray-900 mb-2">Actions rapides</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
            <a href="{{ route('resident.espaces.create') }}" class="bg-white border-2 border-dashed border-gray-300 rounded-lg p-4 hover:border-primary-500 hover:bg-primary-50 transition-colors text-center group">
                <i data-lucide="plus" class="w-6 h-6 text-gray-400 group-hover:text-primary-500 mx-auto mb-1"></i>
                <p class="text-sm font-medium text-gray-900 group-hover:text-primary-700">Réserver un espace</p>
                <p class="text-xs text-gray-500">Nouvelle réservation</p>
            </a>

            <a href="{{ route('resident.events.index') }}" class="bg-white border-2 border-dashed border-gray-300 rounded-lg p-4 hover:border-green-500 hover:bg-green-50 transition-colors text-center group">
                <i data-lucide="calendar-days" class="w-6 h-6 text-gray-400 group-hover:text-green-500 mx-auto mb-1"></i>
                <p class="text-sm font-medium text-gray-900 group-hover:text-green-700">Parcourir événements</p>
                <p class="text-xs text-gray-500">Découvrir et s'inscrire</p>
            </a>

            <a href="{{ route('resident.profile') }}" class="bg-white border-2 border-dashed border-gray-300 rounded-lg p-4 hover:border-purple-500 hover:bg-purple-50 transition-colors text-center group">
                <i data-lucide="user" class="w-6 h-6 text-gray-400 group-hover:text-purple-500 mx-auto mb-1"></i>
                <p class="text-sm font-medium text-gray-900 group-hover:text-purple-700">Mettre à jour le profil</p>
                <p class="text-xs text-gray-500">Informations personnelles</p>
            </a>
        </div>
    </div>
</x-layouts.resident>