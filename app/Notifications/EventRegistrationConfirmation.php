<?php

namespace App\Notifications;

use App\Models\EventRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EventRegistrationConfirmation extends Notification implements ShouldQueue
{
    use Queueable;

    protected $eventRegistration;

    /**
     * Create a new notification instance.
     */
    public function __construct(EventRegistration $eventRegistration)
    {
        $this->eventRegistration = $eventRegistration;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $event = $this->eventRegistration->event;
        $eventTitle = $event->getTranslatedAttribute('title') ?? $event->title ?? 'Événement';
        $eventLocation = $event->getTranslatedAttribute('location') ?? $event->location;

        $mailMessage = (new MailMessage)
            ->subject('🎉 Confirmation d\'inscription - ' . $eventTitle)
            ->greeting('Bonjour ' . $this->eventRegistration->name . ',')
            ->line('Nous avons le plaisir de vous confirmer votre inscription à l\'événement **' . $eventTitle . '**.')
            ->line('**Détails de votre inscription :**')
            ->line('📅 **Date :** ' . $event->start_date->format('l d F Y'))
            ->line('⏰ **Heure :** ' . $event->start_date->format('H:i') . ($event->end_date ? ' - ' . $event->end_date->format('H:i') : ''))
            ->line('📍 **Lieu :** ' . ($eventLocation ?? ($event->is_remote ? 'En ligne' : 'À déterminer')))
            ->line('🎯 **Format :** ' . ($event->is_remote ? 'Événement en ligne' : 'Événement présentiel'));

        // Informations spécifiques selon le statut de l'inscription
        if ($this->eventRegistration->status->value === 'confirmed') {
            $mailMessage->line('✅ **Statut :** Inscription confirmée');
            
            if ($event->is_paid && $this->eventRegistration->amount_paid) {
                $mailMessage->line('💰 **Paiement :** Confirmé (' . number_format($this->eventRegistration->amount_paid, 0, ',', ' ') . ' ' . $event->currency . ')');
            } elseif ($event->is_paid) {
                $mailMessage->line('💳 **Prix :** ' . number_format($event->getCurrentPrice(), 0, ',', ' ') . ' ' . $event->currency);
            } else {
                $mailMessage->line('🆓 **Prix :** Gratuit');
            }
        } else {
            $mailMessage->line('🟡 **Statut :** En cours de traitement');
            
            if ($event->is_paid) {
                $mailMessage->line('💳 **Prix :** ' . number_format($event->getCurrentPrice(), 0, ',', ' ') . ' ' . $event->currency);
                $mailMessage->line('⚠️ Votre inscription sera confirmée après réception du paiement.');
            }
        }

        // Instructions spécifiques selon le type d'événement
        if ($event->is_remote) {
            $mailMessage->line('**Informations importantes :**')
                ->line('🔗 Les détails de connexion vous seront envoyés 24h avant l\'événement.')
                ->line('💻 Assurez-vous d\'avoir une connexion internet stable.');
        } else {
            $mailMessage->line('**Informations importantes :**')
                ->line('🎫 Présentez-vous sur le lieu 15 minutes avant le début de l\'événement.')
                ->line('📱 Conservez cet email comme justificatif d\'inscription.');
        }

        // Instructions pour les événements payants en attente
        if ($event->is_paid && $this->eventRegistration->status->value === 'pending') {
            $mailMessage->line('**Prochaines étapes :**')
                ->line('1. Effectuez le paiement en suivant les instructions reçues')
                ->line('2. Votre inscription sera automatiquement confirmée')
                ->line('3. Vous recevrez un email de confirmation finale');
        }

        $mailMessage->line('**Vos informations d\'inscription :**')
            ->line('👤 **Nom :** ' . $this->eventRegistration->name)
            ->line('📧 **Email :** ' . $this->eventRegistration->email)
            ->line('💼 **Fonction :** ' . $this->eventRegistration->position)
            ->line('🏢 **Organisation :** ' . $this->eventRegistration->organization);

        // Actions selon le statut
        if ($this->eventRegistration->status->value === 'confirmed') {
            $mailMessage->action('Voir les détails de l\'événement', route('events.show', ['slug' => $event->getSlug()]));
        } else {
            $mailMessage->action('Suivre mon inscription', route('events.show', ['slug' => $event->getSlug()]));
        }

        $mailMessage->line('Nous avons hâte de vous retrouver lors de cet événement !')
            ->line('En cas de questions, n\'hésitez pas à nous contacter.')
            ->salutation('L\'équipe Hub Ivoire Tech');

        return $mailMessage;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'event_id' => $this->eventRegistration->event_id,
            'event_title' => $this->eventRegistration->event->getTranslatedAttribute('title'),
            'registration_id' => $this->eventRegistration->id,
            'registration_status' => $this->eventRegistration->status->value,
        ];
    }
} 