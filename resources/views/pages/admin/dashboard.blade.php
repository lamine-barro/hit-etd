@extends('pages.admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<!-- En-tête simple -->
<div class="mb-8">
    <h1 class="text-2xl font-semibold text-gray-900 font-poppins">Tableau de bord</h1>
    <p class="mt-1 text-sm text-gray-600 font-poppins">Vue d'ensemble de votre hub d'innovation</p>
</div>

<!-- Statistiques principales - Design sobre -->
<div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
    <!-- Utilisateurs -->
    <div class="bg-white rounded-lg border border-gray-200 p-4">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 font-poppins">Utilisateurs</p>
                <p class="text-2xl font-semibold text-gray-900 font-poppins">{{ number_format($stats['users_count']) }}</p>
            </div>
            <i data-lucide="users" class="h-6 w-6 text-gray-400"></i>
        </div>
    </div>

    <!-- Événements -->
    <div class="bg-white rounded-lg border border-gray-200 p-4">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 font-poppins">Événements</p>
                <p class="text-2xl font-semibold text-gray-900 font-poppins">{{ number_format($stats['events_count']) }}</p>
            </div>
            <i data-lucide="calendar" class="h-6 w-6 text-gray-400"></i>
        </div>
    </div>

    <!-- Espaces -->
    <div class="bg-white rounded-lg border border-gray-200 p-4">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 font-poppins">Espaces</p>
                <p class="text-2xl font-semibold text-gray-900 font-poppins">{{ number_format($stats['espaces_count']) }}</p>
            </div>
            <i data-lucide="building-2" class="h-6 w-6 text-gray-400"></i>
        </div>
    </div>

    <!-- Partenariats -->
    <div class="bg-white rounded-lg border border-gray-200 p-4">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 font-poppins">Partenariats</p>
                <p class="text-2xl font-semibold text-gray-900 font-poppins">
                    {{ number_format($stats['partnerships_pending']) }}
                    @if($stats['partnerships_pending'] > 0)
                        <span class="ml-1 w-2 h-2 bg-orange-500 rounded-full inline-block"></span>
                    @endif
                </p>
            </div>
            <i data-lucide="handshake" class="h-6 w-6 text-gray-400"></i>
        </div>
    </div>

    <!-- Experts -->
    <div class="bg-white rounded-lg border border-gray-200 p-4">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 font-poppins">Experts</p>
                <p class="text-2xl font-semibold text-gray-900 font-poppins">{{ number_format($stats['experts_count']) }}</p>
            </div>
            <i data-lucide="graduation-cap" class="h-6 w-6 text-gray-400"></i>
        </div>
    </div>
</div>

<!-- Actions rapides -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Demandes en attente -->
    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-medium text-gray-900 font-poppins">Demandes en attente</h3>
            <i data-lucide="clock" class="h-5 w-5 text-gray-400"></i>
        </div>
        
        @if($stats['partnerships_pending'] > 0)
            <div class="space-y-3">
                <div class="flex items-center justify-between p-3 bg-orange-50 rounded-lg">
                    <div class="flex items-center">
                        <i data-lucide="handshake" class="h-4 w-4 text-orange-600 mr-2"></i>
                        <span class="text-sm text-gray-700 font-poppins">Partenariats</span>
                    </div>
                    <span class="bg-orange-100 text-orange-800 px-2 py-1 rounded-full text-xs font-medium">
                        {{ $stats['partnerships_pending'] }}
                    </span>
                </div>
                <div class="text-center pt-2">
                    <a href="{{ route('admin.partnerships.index') }}" 
                       class="text-sm font-medium text-primary hover:text-orange-700 font-poppins">
                        Traiter les demandes →
                    </a>
                </div>
            </div>
        @else
            <p class="text-gray-500 text-center py-8 font-poppins">Aucune demande en attente</p>
        @endif
    </div>

    <!-- Activités récentes -->
    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-medium text-gray-900 font-poppins">Accès rapide</h3>
            <i data-lucide="zap" class="h-5 w-5 text-gray-400"></i>
        </div>
        
        <div class="space-y-3">
            <a href="{{ route('admin.espaces.index') }}" 
               class="flex items-center p-3 rounded-lg border hover:bg-gray-50 transition-colors group">
                <i data-lucide="building-2" class="h-4 w-4 text-gray-400 group-hover:text-primary mr-3"></i>
                <span class="text-sm text-gray-700 group-hover:text-gray-900 font-poppins">Gérer les espaces</span>
            </a>
            
            <a href="{{ route('admin.events.index') }}" 
               class="flex items-center p-3 rounded-lg border hover:bg-gray-50 transition-colors group">
                <i data-lucide="calendar" class="h-4 w-4 text-gray-400 group-hover:text-primary mr-3"></i>
                <span class="text-sm text-gray-700 group-hover:text-gray-900 font-poppins">Événements</span>
            </a>
            
            <a href="{{ route('admin.users.index') }}" 
               class="flex items-center p-3 rounded-lg border hover:bg-gray-50 transition-colors group">
                <i data-lucide="users" class="h-4 w-4 text-gray-400 group-hover:text-primary mr-3"></i>
                <span class="text-sm text-gray-700 group-hover:text-gray-900 font-poppins">Utilisateurs</span>
            </a>
        </div>
    </div>
</div>
@endsection