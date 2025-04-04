<?php

namespace App\Http\Controllers;

use App\Models\EventPayment;
use App\Models\EventRegistration;
use App\Services\PaystackService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EventPaymentController extends Controller
{
    private PaystackService $paystackService;

    public function __construct(PaystackService $paystackService)
    {
        $this->paystackService = $paystackService;
    }

    public function initiate(string $registrationId)
    {
        try {
            $eventRegistration = EventRegistration::where('uuid', $registrationId)->first();
            
            if (!$eventRegistration) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Inscription non trouvée',
                ], 404);
            }
            
            $payment = $this->paystackService->initiatePayment($eventRegistration);

            return response()->json([
                'status' => 'success',
                'message' => 'Payment initiated successfully',
                'data' => [
                    'authorization_url' => $payment->paystack_response['data']['authorization_url'],
                    'reference' => $payment->paystack_reference,
                ],
            ]);
        } catch (\Exception $e) {
            Log::error('Payment initiation failed: '.$e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to initiate payment',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function callback(Request $request)
    {
        try {
            $reference = $request->query('reference');
            $paymentData = $this->paystackService->verifyPayment($reference);

            $payment = EventPayment::where('paystack_reference', $reference)->firstOrFail();

            if ($paymentData['data']['status'] === 'success') {
                $payment->markAsSuccessful(
                    $paymentData['data']['id'],
                    $paymentData['data']
                );

                // Update EventRegistration status
                $payment->registration->update(['status' => 'confirmed']);

                return redirect()->route('events.registration.success', [
                    'event' => $payment->event_id,
                    'registration' => $payment->event_registration_id,
                ])->with('success', 'Payment successful! Your registration is confirmed.');
            }

            $payment->markAsFailed($paymentData);

            return redirect()->route('events.registration.failed', [
                'event' => $payment->event_id,
                'registration' => $payment->event_registration_id,
            ])->with('error', 'Payment failed. Please try again.');

        } catch (\Exception $e) {
            Log::error('Payment callback failed: '.$e->getMessage());

            return redirect()->route('events.index')
                ->with('error', 'We could not verify your payment. Please contact support.');
        }
    }

    public function webhook(Request $request)
    {
        try {
            $this->paystackService->handleWebhook($request->all());

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            Log::error('Webhook processing failed: '.$e->getMessage());

            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function show(Request $request, string $registrationId)
    {
        $eventRegistration = EventRegistration::where('uuid', $registrationId)->first();
        
        if (!$eventRegistration) {
            return redirect()->route('events.index')
                ->with('error', __('Inscription non trouvée.'));
        }

        // Vérifier si le paiement est toujours en attente
        if ($eventRegistration->status !== 'pending') {
            return redirect()->route('events.show', ['event' => $eventRegistration->event_id])
                ->with('error', __('Cette inscription a déjà été traitée.'));
        }

        return view('pages.event-payment', compact('eventRegistration'));
    }
}
