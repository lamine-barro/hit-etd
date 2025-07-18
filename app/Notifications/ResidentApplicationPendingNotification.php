<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResidentApplicationPendingNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public User $applicant)
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
            ->subject('Confirmation de votre candidature de résidence - Hub Ivoire Tech')
            ->greeting('Bonjour ' . $this->applicant->name . ',')
            ->line('Nous avons bien reçu votre candidature pour rejoindre Hub Ivoire Tech en tant que résident.')
            ->line('Votre candidature est actuellement en cours d\'examen par notre équipe.')
            ->line('Vous recevrez un email de confirmation dès que votre candidature sera validée.')
            ->line('Si vous avez des questions, n\'hésitez pas à nous contacter.')
            ->salutation('L\'équipe Hub Ivoire Tech');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'applicant_id' => $this->applicant->id,
            'applicant_name' => $this->applicant->name,
            'applicant_email' => $this->applicant->email,
            'category' => $this->applicant->category,
        ];
    }
}
