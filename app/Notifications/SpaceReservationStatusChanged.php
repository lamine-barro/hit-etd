<?php

namespace App\Notifications;

use App\Models\EspaceOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SpaceReservationStatusChanged extends Notification implements ShouldQueue
{
    use Queueable;

    protected $order;
    protected $oldStatus;
    protected $newStatus;

    /**
     * Create a new notification instance.
     */
    public function __construct(EspaceOrder $order, string $oldStatus, string $newStatus)
    {
        $this->order = $order;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
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
        
        $statusLabels = [
            'pending' => 'En attente',
            'confirmed' => 'Confirmée',
            'cancelled' => 'Annulée',
            'rejected' => 'Refusée'
        ];

        $newStatusLabel = $statusLabels[$this->newStatus] ?? ucfirst($this->newStatus);
        
        $message = (new MailMessage)
                    ->subject('Mise à jour de votre réservation - ' . $this->order->reference)
                    ->greeting('Bonjour ' . $notifiable->name . ',')
                    ->line('Le statut de votre réservation d\'espace a été mis à jour.')
                    ->line('**Détails de la réservation :**')
                    ->line('• Référence : ' . $this->order->reference)
                    ->line('• Espace : ' . $spaceName)
                    ->when($firstItem && $firstItem->started_at, function ($message) use ($firstItem) {
                        return $message->line('• Période : du ' . $firstItem->started_at->format('d/m/Y à H:i') . ' au ' . $firstItem->ended_at->format('d/m/Y à H:i'));
                    })
                    ->line('• **Nouveau statut : ' . $newStatusLabel . '**');

        switch ($this->newStatus) {
            case 'confirmed':
                $message->line('')
                        ->line('🎉 Excellente nouvelle ! Votre réservation a été confirmée.')
                        ->line('Vous pouvez maintenant utiliser l\'espace aux dates et heures réservées.')
                        ->line('Pensez à vous présenter à la réception 15 minutes avant votre créneau.');
                break;
                
            case 'rejected':
                $message->line('')
                        ->line('❌ Malheureusement, votre réservation a été refusée.')
                        ->line('Cela peut être dû à un conflit d\'horaires ou à l\'indisponibilité de l\'espace.')
                        ->line('N\'hésitez pas à nous contacter pour plus d\'informations ou pour faire une nouvelle demande.');
                break;
                
            case 'cancelled':
                $message->line('')
                        ->line('⚠️ Votre réservation a été annulée.')
                        ->line('Si vous n\'êtes pas à l\'origine de cette annulation, veuillez nous contacter rapidement.');
                break;
        }

        return $message
                ->line('')
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
            'old_status' => $this->oldStatus,
            'new_status' => $this->newStatus,
            'message' => 'Statut de réservation mis à jour : ' . $this->newStatus
        ];
    }
}
