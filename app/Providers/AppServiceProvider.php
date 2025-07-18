<?php

namespace App\Providers;

use App\Models\Expert;
use App\Models\User;
use App\Observers\ExpertObserver;
use App\Observers\UserObserver;
use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Expert::observe(ExpertObserver::class);
        User::observe(UserObserver::class);

        FilamentAsset::register([
            Css::make('example-local-stylesheet', asset('css/styles.css')),
        ]);

        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch->locales(['fr', 'en'])
                ->visible(outsidePanels: true);
        });

        if (in_array($this->app->environment(), ['production', 'staging'])) {
            URL::forceScheme('https');
        }
    }
}
