<?php

namespace App\Http\Controllers;

use App\Models\EventPayment;
use App\Models\EventRegistration;
use App\Services\PaystackService;
use App\Notifications\EventRegistrationConfirmation;
use Illuminate\Http\Request;
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

            if (! $eventRegistration) {
                return response()->json([
                    'status' => 'error',
                    'message' => __('Inscription non trouvée'),
                ], 404);
            }

            $payment = $this->paystackService->initiatePayment($eventRegistration);

            return response()->json([
                'status' => 'success',
                'message' => __('Payment initiated successfully'),
                'data' => [
                    'authorization_url' => $payment->paystack_response['data']['authorization_url'],
                    'reference' => $payment->paystack_reference,
                ],
            ]);
        } catch (\Exception $e) {
            Log::error('Payment initiation failed: '.$e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => __('Failed to initiate payment'),
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function callback(Request $request)
    {
        $reference = $request->query('reference');

        if (! $reference) {
            return abort(404);
        }

        try {
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

                // Envoyer les notifications par email après paiement réussi
                try {
                    // Notification au candidat
                    Notification::route('mail', $payment->registration->email)
                        ->notify(new EventRegistrationConfirmation($payment->registration));

                    // Notification à l'équipe administrative
                    $supportEmail = env('HIT_SUPPORT_EMAIL');
                    if ($supportEmail) {
                        Notification::route('mail', $supportEmail)
                            ->notify(new \App\Notifications\NewEventRegistration($payment->registration));
                    }

                    Log::info('Notifications d\'inscription envoyées avec succès après paiement', [
                        'event_id' => $event->id,
                        'event_title' => $event->getTranslatedAttribute('title'),
                        'registration_id' => $payment->registration->id,
                        'candidate_email' => $payment->registration->email,
                        'support_email' => $supportEmail,
                    ]);
                } catch (\Exception $e) {
                    Log::error('Erreur lors de l\'envoi des notifications d\'inscription après paiement', [
                        'error' => $e->getMessage(),
                        'event_id' => $event->id,
                        'registration_id' => $payment->registration->id,
                    ]);
                }

                return redirect()->route('events.show', ['slug' => $event->getSlug()])
                    ->with('success', __('Paiement réussi ! Votre inscription est confirmée. Vous allez recevoir un email de confirmation.'));
            }

            $payment->markAsFailed($paymentData);

            // Récupérer l'événement pour son slug
            $event = $payment->registration->event;

            return redirect()->route('events.registration.failed', [
                'event' => $event->slug,
                'registration' => $payment->registration->uuid,
            ])->with('error', __('Le paiement a échoué. Veuillez réessayer.'));
        } catch (\Exception $e) {
            if ($e->getMessage() === __('Payment verification failed')) {
                return redirect()->route('events.index')
                    ->with('error', __('Le paiement a échoué. Veuillez réessayer.'));
            }

            Log::error('Payment callback failed: '.$e->getMessage());

            return redirect()->route('events.index')
                ->with('error', __('We could not verify your payment. Please contact support.'));
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

        if (! $eventRegistration) {
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

        return view('pages.events.payment', compact('eventRegistration'));
    }
}
