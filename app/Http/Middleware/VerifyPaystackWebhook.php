<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VerifyPaystackWebhook
{
    public function handle(Request $request, Closure $next)
    {
        // Vérifier que c'est une requête POST
        if ($request->method() !== 'POST') {
            return response()->json(['message' => __('Invalid method')], 405);
        }

        // Vérifier la signature Paystack
        if (! $request->hasHeader('x-paystack-signature')) {
            return response()->json(['message' => __('No Paystack signature')], 400);
        }

        $signature = $request->header('x-paystack-signature');
        $payload = $request->getContent();
        $computedSignature = hash_hmac('sha512', $payload, config('services.paystack.secret_key'));

        if ($signature !== $computedSignature) {
            Log::warning('Invalid Paystack webhook signature', [
                'received' => $signature,
                'computed' => $computedSignature,
            ]);

            return response()->json(['message' => __('Invalid signature')], 400);
        }

        return $next($request);
    }
}
