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

        return (new MailMessage)
            ->subject(__('Nouvelle inscription : ').$event->title)
            ->greeting(__('Bonjour !'))
            ->line(__('Une nouvelle inscription a été enregistrée pour l\'événement : ').$event->title)
            ->line(__('Détails du participant :'))
            ->line(__('Nom : ').$this->eventRegistration->name)
            ->line(__('Email : ').$this->eventRegistration->email)
            ->line(__('WhatsApp : ').($this->eventRegistration->whatsapp ?? __('Non renseigné')))
            ->line(__('Fonction : ').$this->eventRegistration->position)
            ->line(__('Organisation : ').$this->eventRegistration->organization)
            ->line(__('Pays : ').$this->eventRegistration->country)
            ->line(__('Type d\'acteur : ').$this->eventRegistration->actor_type)
            ->line(__('Statut : ').$this->getStatusLabel())
            ->line(__('Date d\'inscription : ').$this->eventRegistration->created_at->format('d/m/Y H:i'))
            ->action(__('Voir les détails dans l\'administration'), url('/admin/event-registrations/'.$this->eventRegistration->id))
            ->line(__('Merci d\'utiliser notre plateforme !'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    /**
     * Obtient le libellé du statut d'inscription de manière sécurisée
     */
    private function getStatusLabel(): string
    {
        $status = $this->eventRegistration->status;

        // Si c'est un objet enum
        if (is_object($status) && method_exists($status, 'label')) {
            return $status->label();
        }

        // Si c'est un objet enum mais sans méthode label
        if (is_object($status) && property_exists($status, 'value')) {
            return $status->value;
        }

        // Si c'est une chaîne
        if (is_string($status)) {
            return __(''.$status);
        }

        // Valeur par défaut
        return __('non défini');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'event_id' => $this->eventRegistration->event_id,
            'event_title' => $this->eventRegistration->event->title,
            'registration_id' => $this->eventRegistration->id,
            'participant_name' => $this->eventRegistration->name,
            'participant_email' => $this->eventRegistration->email,
        ];
    }
}
