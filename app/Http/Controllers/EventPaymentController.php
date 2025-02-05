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

    public function initiate(EventRegistration $eventRegistration)
    {
        try {
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
                $payment->EventRegistration->update(['status' => 'confirmed']);

                return redirect()->route('events.EventRegistration.success', [
                    'event' => $payment->event_id,
                    'EventRegistration' => $payment->event_EventRegistration_id,
                ])->with('success', 'Payment successful! Your EventRegistration is confirmed.');
            }

            $payment->markAsFailed($paymentData);

            return redirect()->route('events.EventRegistration.failed', [
                'event' => $payment->event_id,
                'EventRegistration' => $payment->event_EventRegistration_id,
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

    public function show(Request $request, EventRegistration $eventRegistration)
    {
        // Vérifier si le paiement est toujours en attente
        if ($eventRegistration->status !== 'pending') {
            return redirect()->route('events.show', $eventRegistration->event)
                ->with('error', __('Cette inscription a déjà été traitée.'));
        }

        return view('pages.event-payment', compact('EventRegistration'));
    }
}
