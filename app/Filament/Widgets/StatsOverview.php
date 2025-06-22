<?php

namespace App\Filament\Widgets;

use App\Models\Audience;
use App\Models\Booking;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\Partnership;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Résidents', User::count())
                ->description('Nombre total de résidents')
                ->descriptionIcon('heroicon-m-user')
                ->color('primary')
                ->url(route('filament.admin.resources.users.index'))
                ->chart([
                    User::whereMonth('created_at', now()->subMonths(3)->month)->count(),
                    User::whereMonth('created_at', now()->subMonths(2)->month)->count(),
                    User::whereMonth('created_at', now()->subMonths(1)->month)->count(),
                    User::whereMonth('created_at', now()->month)->count(),
                ]),

            Stat::make('Événements', Event::count())
                ->description(Event::where('start_date', '>=', now())->count().' événements à venir')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('success')
                ->url(route('filament.admin.resources.events.index'))
                ->chart([
                    Event::whereMonth('created_at', now()->subMonths(3)->month)->count(),
                    Event::whereMonth('created_at', now()->subMonths(2)->month)->count(),
                    Event::whereMonth('created_at', now()->subMonths(1)->month)->count(),
                    Event::whereMonth('created_at', now()->month)->count(),
                ]),

            Stat::make('Inscriptions', EventRegistration::count())
                ->description(EventRegistration::where('created_at', '>=', now()->subDays(30))->count().' dans les 30 derniers jours')
                ->descriptionIcon('heroicon-m-ticket')
                ->color('warning')
                ->url(route('filament.admin.resources.event-registrations.index'))
                ->chart([
                    EventRegistration::whereMonth('created_at', now()->subMonths(3)->month)->count(),
                    EventRegistration::whereMonth('created_at', now()->subMonths(2)->month)->count(),
                    EventRegistration::whereMonth('created_at', now()->subMonths(1)->month)->count(),
                    EventRegistration::whereMonth('created_at', now()->month)->count(),
                ]),

            Stat::make('Audience', Audience::count())
                ->description(Audience::where('newsletter_email', true)->count().' abonnés à la newsletter')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('info')
                ->url(route('filament.admin.resources.audiences.index'))
                ->chart([
                    Audience::whereMonth('created_at', now()->subMonths(3)->month)->count(),
                    Audience::whereMonth('created_at', now()->subMonths(2)->month)->count(),
                    Audience::whereMonth('created_at', now()->subMonths(1)->month)->count(),
                    Audience::whereMonth('created_at', now()->month)->count(),
                ]),

            Stat::make('Partenariats', Partnership::count())
                ->description(Partnership::where('status', 'approved')->count().' partenariats actifs')
                ->descriptionIcon('heroicon-m-heart')
                ->color('danger')
                ->url(route('filament.admin.resources.partnerships.index'))
                ->chart([
                    Partnership::whereMonth('created_at', now()->subMonths(3)->month)->count(),
                    Partnership::whereMonth('created_at', now()->subMonths(2)->month)->count(),
                    Partnership::whereMonth('created_at', now()->subMonths(1)->month)->count(),
                    Partnership::whereMonth('created_at', now()->month)->count(),
                ]),

            Stat::make('Visite', Booking::count())
                ->description(Booking::where('status', 'approved')->count().' demande de visite actifs')
                ->descriptionIcon('heroicon-m-heart')
                ->color('danger')
                ->url(route('filament.admin.resources.partnerships.index'))
                ->chart([
                    Booking::whereMonth('created_at', now()->subMonths(3)->month)->count(),
                    Booking::whereMonth('created_at', now()->subMonths(2)->month)->count(),
                    Booking::whereMonth('created_at', now()->subMonths(1)->month)->count(),
                    Booking::whereMonth('created_at', now()->month)->count(),
                ]),
        ];
    }
}
