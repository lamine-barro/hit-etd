<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected $guards = [];

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : (in_array('web', $this->guards) ? route('filament.resident.auth.login') : route('filament.admin.auth.login'));
    }
}
