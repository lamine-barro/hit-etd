<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Dashboard;
use App\Filament\Pages\Auth\Login;
use App\Filament\Widgets\StatsOverview;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Panel;
use Filament\PanelProvider;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Saade\FilamentFullCalendar\FilamentFullCalendarPlugin;
use SolutionForest\FilamentSimpleLightBox\SimpleLightBoxPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login(Login::class)
            ->loginRouteSlug('auth/login')
            ->authGuard('admin')
            ->font('Poppins')
            ->brandLogo('/logo_hit.png')
            ->brandLogoHeight('50px')
            ->databaseNotifications(true)
            ->colors([
                'primary' => '#ea580c',
            ])
            ->sidebarCollapsibleOnDesktop(true)
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                StatsOverview::class,
            ])
            ->maxContentWidth('full')
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])->plugins([
                FilamentFullCalendarPlugin::make()
                    ->selectable()
                    ->editable()
                    ->timezone(date_default_timezone_get()),

                SimpleLightBoxPlugin::make(),
            ])
            ->navigationGroups([
                NavigationGroup::make('Demandes')
                    ->icon('heroicon-o-inbox')
                    ->collapsed(false),
                NavigationGroup::make('Utilisateurs')
                    ->icon('heroicon-o-users')
                    ->collapsed(false),
                NavigationGroup::make('Espaces & Réservations')  
                    ->icon('heroicon-o-building-office')
                    ->collapsed(false),
                NavigationGroup::make('Événements')
                    ->icon('heroicon-o-calendar')
                    ->collapsed(false),
                NavigationGroup::make('Contenu')
                    ->icon('heroicon-o-document-text')
                    ->collapsed(true),
            ]);
    }
}
