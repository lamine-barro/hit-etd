<?php

namespace App\Jobs;

use App\Mail\NewsletterSubscriptionAdmin;
use App\Mail\NewsletterSubscriptionConfirmation;
use App\Mail\NewsletterPreferencesUpdated;
use App\Models\Administrator;
use App\Models\Audience;
use App\Notifications\NewNewsletterSubscriberNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendNewsletterNotificationsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private Audience $audience,
        private bool $isNewSubscriber = true
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            if ($this->isNewSubscriber) {
                // Nouvel abonné
                Mail::queue(new NewsletterSubscriptionConfirmation($this->audience));
                Mail::queue(new NewsletterSubscriptionAdmin($this->audience));
                
                // Notifications in-app pour les administrateurs
                $administrators = Administrator::all();
                foreach ($administrators as $admin) {
                    $admin->notify(new NewNewsletterSubscriberNotification($this->audience));
                }
                
                Log::info('New newsletter subscriber notifications sent', [
                    'subscriber_id' => $this->audience->id,
                    'subscriber_email' => $this->audience->email,
                    'admin_notifications_count' => $administrators->count(),
                ]);
            } else {
                // Mise à jour des préférences
                Mail::queue(new NewsletterPreferencesUpdated($this->audience));
                
                Log::info('Newsletter preferences update notification sent', [
                    'subscriber_id' => $this->audience->id,
                    'subscriber_email' => $this->audience->email,
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Failed to send newsletter notifications', [
                'subscriber_id' => $this->audience->id,
                'is_new_subscriber' => $this->isNewSubscriber,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            
            throw $e; // Re-lancer l'exception pour que le job soit marqué comme échoué
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception): void
    {
        Log::error('Newsletter notifications job failed', [
            'subscriber_id' => $this->audience->id,
            'is_new_subscriber' => $this->isNewSubscriber,
            'exception' => $exception->getMessage(),
        ]);
    }
} 