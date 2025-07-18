<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminOtpNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(private string $otp)
    {
        //
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
            ->subject('Code d\'accès administrateur - HIT')
            ->greeting('Bonjour ' . $notifiable->getFilamentName() . ',')
            ->line('Voici votre code d\'accès à l\'administration :')
            ->line('**' . $this->otp . '**')
            ->line('Ce code est valide pendant 10 minutes.')
            ->line('Si vous n\'avez pas demandé ce code, ignorez cet email.')
            ->salutation('L\'équipe HIT');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'otp' => $this->otp,
            'expires_at' => now()->addMinutes(10),
        ];
    }
} 