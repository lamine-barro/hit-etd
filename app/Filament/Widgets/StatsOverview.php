<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use App\Models\Espace;
use App\Models\Event;
use App\Models\Expert;
use App\Models\Partnership;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Espaces', Espace::count())
                ->description(Espace::where('status', 'available')->count().' espaces disponibles')
                ->descriptionIcon('heroicon-m-building-office')
                ->color('primary')
                ->url(route('filament.admin.resources.espaces.index'))
                ->chart([
                    Espace::whereMonth('created_at', now()->subMonths(3)->month)->count(),
                    Espace::whereMonth('created_at', now()->subMonths(2)->month)->count(),
                    Espace::whereMonth('created_at', now()->subMonths(1)->month)->count(),
                    Espace::whereMonth('created_at', now()->month)->count(),
                ]),

            Stat::make('Événements', Event::count())
                ->description(Event::where('start_date', '>=', now())->count().' événements à venir')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('success')
                ->url(route('filament.admin.resources.events.index'))
                ->chart([
                    Event::whereMonth('created_at', now()->subMonths(3)->month)->count(),
                    Event::whereMonth('created_at', now()->subMonths(2)->month)->count(),
                    Event::whereMonth('created_at', now()->subMonths(1)->month)->count(),
                    Event::whereMonth('created_at', now()->month)->count(),
                ]),

            Stat::make('Demandes de visite', Booking::count())
                ->description(Booking::where('status', 'pending')->count().' demandes en attente')
                ->descriptionIcon('heroicon-m-eye')
                ->color('warning')
                ->url(route('filament.admin.resources.bookings.index'))
                ->chart([
                    Booking::whereMonth('created_at', now()->subMonths(3)->month)->count(),
                    Booking::whereMonth('created_at', now()->subMonths(2)->month)->count(),
                    Booking::whereMonth('created_at', now()->subMonths(1)->month)->count(),
                    Booking::whereMonth('created_at', now()->month)->count(),
                ]),

            Stat::make('Résidents', User::count())
                ->description(User::where('is_active', true)->count().' résidents actifs')
                ->descriptionIcon('heroicon-m-users')
                ->color('info')
                ->url(route('filament.admin.resources.users.index'))
                ->chart([
                    User::whereMonth('created_at', now()->subMonths(3)->month)->count(),
                    User::whereMonth('created_at', now()->subMonths(2)->month)->count(),
                    User::whereMonth('created_at', now()->subMonths(1)->month)->count(),
                    User::whereMonth('created_at', now()->month)->count(),
                ]),

            Stat::make('Partenariats', Partnership::count())
                ->description(Partnership::where('status', 'approved')->count().' partenariats approuvés')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('rose')
                ->url(route('filament.admin.resources.partnerships.index'))
                ->chart([
                    Partnership::whereMonth('created_at', now()->subMonths(3)->month)->count(),
                    Partnership::whereMonth('created_at', now()->subMonths(2)->month)->count(),
                    Partnership::whereMonth('created_at', now()->subMonths(1)->month)->count(),
                    Partnership::whereMonth('created_at', now()->month)->count(),
                ]),

            Stat::make('Experts', Expert::count())
                ->description(Expert::where('status', 'approved')->count().' experts approuvés')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('amber')
                ->url(route('filament.admin.resources.experts.index'))
                ->chart([
                    Expert::whereMonth('created_at', now()->subMonths(3)->month)->count(),
                    Expert::whereMonth('created_at', now()->subMonths(2)->month)->count(),
                    Expert::whereMonth('created_at', now()->subMonths(1)->month)->count(),
                    Expert::whereMonth('created_at', now()->month)->count(),
                ]),
        ];
    }
}
