<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserAccountCreated extends Notification
{
    use Queueable;

    public $adminName;
    public $loginUrl;

    /**
     * Create a new notification instance.
     */
    public function __construct($adminName = null)
    {
        $this->adminName = $adminName;
        $this->loginUrl = route('resident.otp.login');
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
                    ->subject('Bienvenue sur HIT Hub - Votre compte a été créé')
                    ->greeting('Bonjour ' . $notifiable->name . ',')
                    ->line('Nous sommes heureux de vous informer que votre compte HIT Hub a été créé avec succès' . ($this->adminName ? ' par ' . $this->adminName : '') . '.')
                    ->line('Vous pouvez maintenant accéder à la plateforme en utilisant votre adresse email : **' . $notifiable->email . '**')
                    ->line('Notre système utilise une authentification sécurisée par OTP (One-Time Password). Vous recevrez un code de vérification par email à chaque connexion.')
                    ->action('Se connecter à HIT Hub', $this->loginUrl)
                    ->line('Si vous avez des questions ou besoin d\'assistance, n\'hésitez pas à nous contacter.')
                    ->salutation('L\'équipe HIT Hub');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'admin_name' => $this->adminName,
            'user_email' => $notifiable->email,
        ];
    }
}
