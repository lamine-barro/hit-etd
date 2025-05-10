<?php

namespace App\Providers;

use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        $lang = Session::get('locale');

        FilamentAsset::register([
            Css::make('example-local-stylesheet', asset('css/styles.css')),
        ]);

        if (in_array($this->app->environment(), ['production', 'staging'])) {
            URL::forceScheme('https');
        }
    }
}
