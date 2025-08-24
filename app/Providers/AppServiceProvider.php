<?php

namespace App\Providers;

use App\Models\Expert;
use App\Models\User;
use App\Observers\ExpertObserver;
use App\Observers\UserObserver;
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
        // Expert::observe(ExpertObserver::class);
        // User::observe(UserObserver::class);

        if (in_array($this->app->environment(), ['production', 'staging'])) {
            URL::forceScheme('https');
        }
    }
}
