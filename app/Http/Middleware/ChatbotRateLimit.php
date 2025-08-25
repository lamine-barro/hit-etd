<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class ChatbotRateLimit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $key = 'chatbot:' . $request->ip();
        
        // Limite : 10 requêtes par minute
        $executed = RateLimiter::attempt(
            $key,
            10, // maxAttempts
            function () use ($next, $request) {
                return $next($request);
            },
            60 // decaySeconds
        );

        if (!$executed) {
            return response()->json([
                'success' => false,
                'message' => 'Trop de requêtes. Veuillez patienter avant de réessayer.',
                'fallback' => 'Pour une assistance immédiate, contactez-nous à hello@hubivoiretech.ci.',
                'retry_after' => RateLimiter::availableIn($key)
            ], 429);
        }

        return $executed;
    }
}