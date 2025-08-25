<?php

namespace App\Notifications;

use App\Models\EspaceOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminSpaceReservationNotification extends Notification implements ShouldQueue
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
        $user = $this->order->user;
        
        return (new MailMessage)
                    ->subject('Nouvelle réservation d\'espace - ' . $this->order->reference)
                    ->greeting('Bonjour,')
                    ->line('Une nouvelle réservation d\'espace vient d\'être créée et nécessite votre validation.')
                    ->line('**Détails de la réservation :**')
                    ->line('• Référence : ' . $this->order->reference)
                    ->line('• Réservé par : ' . $user->name . ' (' . $user->email . ')')
                    ->line('• Espace : ' . $spaceName)
                    ->line('• Date de réservation : ' . $this->order->order_date->format('d/m/Y à H:i'))
                    ->when($firstItem && $firstItem->started_at, function ($message) use ($firstItem) {
                        return $message->line('• Période : du ' . $firstItem->started_at->format('d/m/Y à H:i') . ' au ' . $firstItem->ended_at->format('d/m/Y à H:i'));
                    })
                    ->when($firstItem && $firstItem->number_of_people, function ($message) use ($firstItem) {
                        return $message->line('• Nombre de participants : ' . $firstItem->number_of_people);
                    })
                    ->line('• Montant : ' . number_format($this->order->total_amount, 0, ',', ' ') . ' FCFA')
                    ->when($this->order->notes, function ($message) {
                        return $message->line('• Notes : ' . $this->order->notes);
                    })
                    ->line('')
                    ->line('Veuillez examiner et traiter cette demande dans l\'interface d\'administration.')
                    ->action('Gérer la réservation', url('/admin/espace-orders/' . $this->order->id))
                    ->line('Hub Ivoire Tech - Système de gestion');
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
            'user_name' => $this->order->user->name,
            'message' => 'Nouvelle réservation d\'espace en attente de validation'
        ];
    }
}
