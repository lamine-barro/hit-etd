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
            ->subject('Nouvelle inscription : ' . $event->title)
            ->greeting('Bonjour !')
            ->line('Une nouvelle inscription a été enregistrée pour l\'événement : ' . $event->title)
            ->line('Détails du participant :')
            ->line('Nom : ' . $this->eventRegistration->name)
            ->line('Email : ' . $this->eventRegistration->email)
            ->line('WhatsApp : ' . ($this->eventRegistration->whatsapp ?? 'Non renseigné'))
            ->line('Fonction : ' . $this->eventRegistration->position)
            ->line('Organisation : ' . $this->eventRegistration->organization)
            ->line('Pays : ' . $this->eventRegistration->country)
            ->line('Type d\'acteur : ' . $this->eventRegistration->actor_type)
            ->line('Statut : ' . $this->getStatusLabel())
            ->line('Date d\'inscription : ' . $this->eventRegistration->created_at->format('d/m/Y H:i'))
            ->action('Voir les détails dans l\'administration', url('/admin/event-registrations/' . $this->eventRegistration->id))
            ->line('Merci d\'utiliser notre plateforme !');
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
            return $status;
        }
        
        // Valeur par défaut
        return 'non défini';
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
