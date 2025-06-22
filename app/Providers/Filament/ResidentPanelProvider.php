<?php

namespace App\Providers\Filament;

use App\Filament\Resident\Pages\Dashboard;
use App\Filament\Resident\Pages\EditProfile;
// use Filament\Http\Middleware\Authenticate;
// use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Panel;
use Filament\PanelProvider;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Saade\FilamentFullCalendar\FilamentFullCalendarPlugin;

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
            // ->maxContentWidth('full')
            ->colors([
                'primary' => '#ea580c',
            ])
            ->userMenuItems([
                MenuItem::make()
                    ->label('Profil')
                    ->url(fn (): string => EditProfile::getUrl())
                    ->icon('heroicon-o-user'),
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
                // AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                // Authenticate::class,
            ])->plugins([
                FilamentFullCalendarPlugin::make()
                    ->selectable()
                    ->editable()
                    ->timezone(date_default_timezone_get())
                    ->locale('fr'),
            ]);
    }
}
