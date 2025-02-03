<?php

namespace App\Services;

use App\Models\Registration;
use App\Models\EventPayment;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaystackService
{
    protected $secretKey;
    protected $publicKey;
    protected $baseUrl = 'https://api.paystack.co';

    public function __construct()
    {
        $this->secretKey = config('services.paystack.secret_key');
        $this->publicKey = config('services.paystack.public_key');
    }

    public function initiatePayment(Registration $registration)
    {
        try {
            // Créer une référence unique pour le paiement
            $reference = 'HIT_' . Str::random(16);

            // Créer l'enregistrement du paiement
            $payment = EventPayment::create([
                'event_id' => $registration->event_id,
                'event_registration_id' => $registration->id,
                'reference' => $reference,
                'amount' => $registration->event->getCurrentPrice() * 100, // Paystack utilise les plus petites unités monétaires
                'currency' => $registration->event->currency,
                'paystack_reference' => $reference,
                'status' => 'pending'
            ]);

            // Initialiser la transaction avec Paystack
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->secretKey,
                'Content-Type' => 'application/json',
            ])->post($this->baseUrl . '/transaction/initialize', [
                'email' => $registration->email,
                'amount' => $payment->amount,
                'currency' => $payment->currency,
                'reference' => $payment->reference,
                'callback_url' => route('events.payment.callback'),
                'metadata' => [
                    'registration_id' => $registration->id,
                    'event_id' => $registration->event_id,
                    'payment_id' => $payment->id,
                    'custom_fields' => [
                        [
                            'display_name' => "Nom de l'événement",
                            'variable_name' => "event_name",
                            'value' => $registration->event->title
                        ],
                        [
                            'display_name' => "Date de l'événement",
                            'variable_name' => "event_date",
                            'value' => $registration->event->start_date->format('d/m/Y')
                        ]
                    ]
                ]
            ]);

            if (!$response->successful()) {
                throw new \Exception('Échec de l\'initialisation du paiement: ' . $response->body());
            }

            $data = $response->json();

            // Mettre à jour le paiement avec la réponse de Paystack
            $payment->update([
                'paystack_response' => $data
            ]);

            return $payment;

        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'initialisation du paiement Paystack', [
                'error' => $e->getMessage(),
                'registration_id' => $registration->id
            ]);

            throw $e;
        }
    }

    public function verifyPayment(string $reference)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->secretKey,
                'Content-Type' => 'application/json',
            ])->get($this->baseUrl . '/transaction/verify/' . $reference);

            if (!$response->successful()) {
                throw new \Exception('Échec de la vérification du paiement: ' . $response->body());
            }

            return $response->json();

        } catch (\Exception $e) {
            Log::error('Erreur lors de la vérification du paiement Paystack', [
                'error' => $e->getMessage(),
                'reference' => $reference
            ]);

            throw $e;
        }
    }

    public function handleWebhook(array $payload)
    {
        try {
            $event = $payload['event'];
            $data = $payload['data'];

            // Trouver le paiement correspondant
            $payment = EventPayment::where('reference', $data['reference'])->first();

            if (!$payment) {
                throw new \Exception('Paiement non trouvé: ' . $data['reference']);
            }

            switch ($event) {
                case 'charge.success':
                    $payment->markAsSuccessful(
                        $data['id'],
                        $payload
                    );

                    // Confirmer l'inscription
                    $payment->registration->update([
                        'status' => 'confirmed',
                        'payment_status' => 'completed',
                        'payment_date' => now(),
                        'amount_paid' => $data['amount'] / 100
                    ]);
                    break;

                case 'charge.failed':
                    $payment->markAsFailed($payload);
                    break;
            }

            return true;

        } catch (\Exception $e) {
            Log::error('Erreur lors du traitement du webhook Paystack', [
                'error' => $e->getMessage(),
                'payload' => $payload
            ]);

            throw $e;
        }
    }
} 