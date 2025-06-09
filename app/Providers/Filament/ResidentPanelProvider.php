<?php

namespace App\Providers\Filament;

use Filament\Panel;
use Filament\PanelProvider;
use App\Filament\Resident\Pages\Dashboard;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Filament\Http\Middleware\AuthenticateSession;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Saade\FilamentFullCalendar\FilamentFullCalendarPlugin;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;

class ResidentPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('resident')
            ->path('resident')
            ->font('Poppins')
            ->brandLogo('/logo_hit.png')
            ->topNavigation(true)
            ->login()
            ->brandLogoHeight('50px')
            ->colors([
                'primary' => '#ea580c',
            ])
            ->discoverResources(in: app_path('Filament/Resident/Resources'), for: 'App\\Filament\\Resident\\Resources')
            ->discoverPages(in: app_path('Filament/Resident/Pages'), for: 'App\\Filament\\Resident\\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Resident/Widgets'), for: 'App\\Filament\\Resident\\Widgets')
            ->widgets([])
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
                ->timezone(date_default_timezone_get())
                ->locale('fr'),
        ]);
    }
}
