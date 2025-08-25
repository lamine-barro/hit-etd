<?php

namespace App\Notifications;

use App\Models\EspaceOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SpaceReservationCreated extends Notification implements ShouldQueue
{
    use Queueable;

    protected $order;

    /**
     * Create a new notification instance.
     */
    public function __construct(EspaceOrder $order)
    {
        $this->order = $order;
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
        $firstItem = $this->order->orderItems->first();
        $spaceName = $firstItem ? $firstItem->espace->name : 'Espace';
        
        return (new MailMessage)
                    ->subject('Confirmation de réservation d\'espace - Hub Ivoire Tech')
                    ->greeting('Bonjour ' . $notifiable->name . ',')
                    ->line('Votre réservation d\'espace a été créée avec succès.')
                    ->line('**Détails de la réservation :**')
                    ->line('• Référence : ' . $this->order->reference)
                    ->line('• Espace : ' . $spaceName)
                    ->line('• Date de réservation : ' . $this->order->order_date->format('d/m/Y à H:i'))
                    ->when($firstItem && $firstItem->started_at, function ($message) use ($firstItem) {
                        return $message->line('• Période : du ' . $firstItem->started_at->format('d/m/Y à H:i') . ' au ' . $firstItem->ended_at->format('d/m/Y à H:i'));
                    })
                    ->line('• Montant : ' . number_format($this->order->total_amount, 0, ',', ' ') . ' FCFA')
                    ->line('• Statut : En attente de validation')
                    ->line('')
                    ->line('Votre réservation sera examinée par notre équipe et vous recevrez une confirmation dans les plus brefs délais.')
                    ->action('Voir ma réservation', route('resident.espaces.show', $this->order))
                    ->line('Merci de faire confiance au Hub Ivoire Tech !');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'order_id' => $this->order->id,
            'order_reference' => $this->order->reference,
            'message' => 'Nouvelle réservation d\'espace créée'
        ];
    }
}
