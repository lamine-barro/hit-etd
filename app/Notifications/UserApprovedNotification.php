<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserApprovedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
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
                    ->subject('Félicitations ! Votre accès au Hub Ivoire Tech est approuvé')
                    ->greeting('Bonjour ' . $notifiable->name . ' ! 🎉')
                    ->line('Excellente nouvelle ! Votre demande d\'accès au Hub Ivoire Tech a été approuvée.')
                    ->line('')
                    ->line('**Vous pouvez maintenant :**')
                    ->line('✅ Accéder à votre espace résident')
                    ->line('✅ Réserver des espaces de travail')
                    ->line('✅ Vous inscrire aux événements')
                    ->line('✅ Profiter de tous les services du Hub')
                    ->line('')
                    ->line('**Vos informations de connexion :**')
                    ->line('• Email : ' . $notifiable->email)
                    ->line('• Catégorie : ' . ucfirst($notifiable->category ?? 'Résidents'))
                    ->line('')
                    ->line('Pour vous connecter, utilisez le système de connexion par code OTP avec votre adresse email.')
                    ->action('Accéder à mon espace', route('resident.otp.login'))
                    ->line('')
                    ->line('**Prochaines étapes :**')
                    ->line('1. Connectez-vous à votre espace résident')
                    ->line('2. Complétez votre profil si nécessaire')
                    ->line('3. Explorez les espaces et événements disponibles')
                    ->line('')
                    ->line('Bienvenue dans la communauté du Hub Ivoire Tech ! 🚀')
                    ->salutation('L\'équipe du Hub Ivoire Tech');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'user_id' => $notifiable->id,
            'user_name' => $notifiable->name,
            'user_email' => $notifiable->email,
            'message' => 'Utilisateur approuvé et activé'
        ];
    }
}
