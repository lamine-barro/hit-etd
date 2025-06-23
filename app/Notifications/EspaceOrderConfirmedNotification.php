<?php

namespace App\Notifications;

use App\Models\EspaceOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EspaceOrderConfirmedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected EspaceOrder $espaceOrder)
    {
        $this->onQueue('default');
        $this->delay(500);
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
        return (new MailMessage)
            ->subject('Confirmation de votre commande')
            ->greeting('Bonjour '.$notifiable->name.',')
            ->line('Nous avons le plaisir de votre informez que votre reservation a été confirmée.')
            ->line('Ref: '.$this->espaceOrder->reference)
            ->line('Statut: '.$this->espaceOrder->status)
            ->line('Montant total: '.$this->espaceOrder->total_amount.' FCFA')
            ->line('Vous pouvez consulter les détails de votre commande dans votre espace utilisateur.')
            ->action('Notification Action', route('filament.resident.resources.espace-orders.index'))
            ->line('Merci d\'utiliser notre application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
