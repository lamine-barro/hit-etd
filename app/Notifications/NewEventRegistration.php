<?php

namespace App\Notifications;

use App\Models\EventRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewEventRegistration extends Notification implements ShouldQueue
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

        return (new MailMessage)
            ->subject('✅ Nouvelle inscription - ' . $eventTitle)
            ->greeting('Bonjour équipe Hub Ivoire Tech,')
            ->line('Une nouvelle inscription vient d\'être enregistrée pour l\'événement **' . $eventTitle . '**')
            ->line('**Détails du participant :**')
            ->line('👤 **Nom :** ' . $this->eventRegistration->name)
            ->line('📧 **Email :** ' . $this->eventRegistration->email)
            ->line('📱 **WhatsApp :** ' . ($this->eventRegistration->whatsapp ?? 'Non renseigné'))
            ->line('💼 **Fonction :** ' . $this->eventRegistration->position)
            ->line('🏢 **Organisation :** ' . $this->eventRegistration->organization)
            ->line('🌍 **Pays :** ' . $this->eventRegistration->country)
            ->line('🎯 **Profil :** ' . $this->getActorTypeLabel())
            ->line('📊 **Statut :** ' . $this->getStatusLabel())
            ->line('⏰ **Date d\'inscription :** ' . $this->eventRegistration->created_at->format('d/m/Y à H:i'))
            ->line('**Informations sur l\'événement :**')
            ->line('📅 **Date :** ' . $event->start_date->format('d/m/Y à H:i'))
            ->line('📍 **Lieu :** ' . ($event->location ?? ($event->is_remote ? 'En ligne' : 'À déterminer')))
            ->line('💰 **Prix :** ' . ($event->is_paid ? number_format($event->getCurrentPrice(), 0, ',', ' ') . ' ' . $event->currency : 'Gratuit'))
            ->action('Voir dans l\'administration', url('/admin/event-registrations/' . $this->eventRegistration->id))
            ->line('Bonne continuation !')
            ->salutation('L\'équipe Hub Ivoire Tech');
    }

    /**
     * Obtient le libellé du statut d'inscription de manière sécurisée
     */
    private function getStatusLabel(): string
    {
        $status = $this->eventRegistration->status;

        $statusLabels = [
            'pending' => '🟡 En attente',
            'confirmed' => '🟢 Confirmé',
            'cancelled' => '🔴 Annulé',
        ];

        // Si c'est un objet enum
        if (is_object($status) && property_exists($status, 'value')) {
            return $statusLabels[$status->value] ?? $status->value;
        }

        // Si c'est une chaîne
        if (is_string($status)) {
            return $statusLabels[$status] ?? $status;
        }

        return 'Non défini';
    }

    /**
     * Obtient le libellé du type d'acteur
     */
    private function getActorTypeLabel(): string
    {
        $actorType = $this->eventRegistration->actor_type;
        
        $actorTypeLabels = [
            'startup' => 'Startup / Entrepreneur',
            'etudiant' => 'Étudiant',
            'chercheur' => 'Chercheur / Académique',
            'investisseur' => 'Investisseur',
            'media' => 'Média / Journaliste',
            'corporate' => 'Corporate / Grande entreprise',
            'service_public' => 'Service Public',
            'structure_accompagnement' => 'Structure d\'accompagnement',
            'autre' => 'Autre',
        ];

        return $actorTypeLabels[$actorType] ?? $actorType;
    }

    public function toArray(object $notifiable): array
    {
        return [
            'event_id' => $this->eventRegistration->event_id,
            'event_title' => $this->eventRegistration->event->getTranslatedAttribute('title'),
            'registration_id' => $this->eventRegistration->id,
            'participant_name' => $this->eventRegistration->name,
            'participant_email' => $this->eventRegistration->email,
        ];
    }
}
