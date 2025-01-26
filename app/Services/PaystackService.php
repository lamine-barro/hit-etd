<?php

namespace App\Services;

use App\Models\EventPayment;
use App\Models\EventRegistration;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PaystackService
{
    private string $secretKey;
    private string $baseUrl = 'https://api.paystack.co';

    public function __construct()
    {
        $this->secretKey = config('services.paystack.secret_key');
    }

    public function initiatePayment(EventRegistration $registration): EventPayment
    {
        $event = $registration->event;
        $amount = $event->getCurrentPrice() * 100; // Convert to kobo/cents

        $payment = EventPayment::create([
            'event_id' => $event->id,
            'event_registration_id' => $registration->id,
            'reference' => 'HIT-' . Str::random(10),
            'amount' => $event->getCurrentPrice(),
            'currency' => $event->currency,
            'paystack_reference' => 'PSK-' . Str::random(10),
            'status' => 'pending',
        ]);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->secretKey,
            'Content-Type' => 'application/json',
        ])->post($this->baseUrl . '/transaction/initialize', [
            'email' => $registration->email,
            'amount' => $amount,
            'currency' => $event->currency,
            'reference' => $payment->paystack_reference,
            'callback_url' => route('events.payment.callback'),
            'metadata' => [
                'event_id' => $event->id,
                'registration_id' => $registration->id,
                'payment_id' => $payment->id,
                'custom_fields' => [
                    [
                        'display_name' => 'Event Name',
                        'variable_name' => 'event_name',
                        'value' => $event->title,
                    ],
                    [
                        'display_name' => 'Participant Name',
                        'variable_name' => 'participant_name',
                        'value' => $registration->name,
                    ],
                ],
            ],
        ]);

        if (!$response->successful()) {
            $payment->markAsFailed($response->json());
            throw new \Exception('Failed to initialize payment: ' . $response->body());
        }

        $data = $response->json();
        $payment->update([
            'paystack_response' => $data,
        ]);

        return $payment;
    }

    public function verifyPayment(string $reference): array
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->secretKey,
            'Content-Type' => 'application/json',
        ])->get($this->baseUrl . '/transaction/verify/' . $reference);

        if (!$response->successful()) {
            throw new \Exception('Failed to verify payment: ' . $response->body());
        }

        return $response->json();
    }

    public function handleWebhook(array $payload): void
    {
        $payment = EventPayment::where('paystack_reference', $payload['data']['reference'])->first();

        if (!$payment) {
            throw new \Exception('Payment not found');
        }

        if ($payload['event'] === 'charge.success') {
            $payment->markAsSuccessful(
                $payload['data']['id'],
                $payload['data']
            );

            // Update registration status
            $payment->registration->update(['status' => 'confirmed']);
        } else {
            $payment->markAsFailed($payload);
        }
    }
} 