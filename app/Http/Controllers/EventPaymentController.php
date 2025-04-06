<?php

namespace App\Http\Controllers;

use App\Models\EventPayment;
use App\Models\EventRegistration;
use App\Services\PaystackService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

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
                $payment->registration->update(['status' => \App\Enums\RegistrationStatus::CONFIRMED]);
                
                // Récupérer l'événement pour son slug
                $event = $payment->registration->event;
                
                // Envoyer une notification par email après paiement réussi
                try {
                    $supportEmail = env('HIT_SUPPORT_EMAIL');
                    
                    Log::info('Tentative d\'envoi d\'email après paiement réussi', ['email' => $supportEmail]);
                    
                    Notification::route('mail', $supportEmail)
                        ->notify(new \App\Notifications\NewEventRegistration($payment->registration));
                    
                    Log::info('Notification d\'inscription envoyée avec succès après paiement', [
                        'event_id' => $event->id,
                        'event_title' => $event->title,
                        'registration_id' => $payment->registration->id,
                        'support_email' => $supportEmail
                    ]);
                } catch (\Exception $e) {
                    Log::error('Erreur lors de l\'envoi de la notification d\'inscription après paiement', [
                        'error' => $e->getMessage(),
                        'event_id' => $event->id,
                        'registration_id' => $payment->registration->id,
                    ]);
                }

                return redirect()->route('events.registration.success', [
                    'event' => $event->slug,
                    'registration' => $payment->registration->uuid,
                ])->with('success', __('Paiement réussi ! Votre inscription est confirmée.'));
            }

            $payment->markAsFailed($paymentData);
            
            // Récupérer l'événement pour son slug
            $event = $payment->registration->event;

            return redirect()->route('events.registration.failed', [
                'event' => $event->slug,
                'registration' => $payment->registration->uuid,
            ])->with('error', __('Le paiement a échoué. Veuillez réessayer.'));

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
        if ($eventRegistration->status !== \App\Enums\RegistrationStatus::PENDING) {
            // Récupérer l'événement et utiliser son slug pour la redirection
            $event = $eventRegistration->event;
            return redirect()->route('events.show', $event->slug)
                ->with('error', __('Cette inscription a déjà été traitée.'));
        }

        return view('pages.event-payment', compact('eventRegistration'));
    }
}
