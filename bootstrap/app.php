<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        api: __DIR__.'/../routes/api.php',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->trustProxies(at: '*');
        $middleware->web([
            \App\Http\Middleware\Localization::class,
        ]);

        $middleware->validateCsrfTokens(except: [
            'api/webhooks/paystack',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
