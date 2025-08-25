<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Seulement en production
        if (app()->environment('production')) {
            $headers = config('production.security.security_headers', []);
            
            foreach ($headers as $header => $value) {
                $response->headers->set($header, $value);
            }
            
            // Content Security Policy pour la production
            $csp = "default-src 'self'; " .
                   "script-src 'self' 'unsafe-inline' https://unpkg.com https://cdn.jsdelivr.net; " .
                   "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdn.jsdelivr.net; " .
                   "font-src 'self' https://fonts.gstatic.com; " .
                   "img-src 'self' data: blob: https:; " .
                   "connect-src 'self' https://api.openai.com; " .
                   "frame-ancestors 'none';";
                   
            $response->headers->set('Content-Security-Policy', $csp);
        }

        return $response;
    }
}