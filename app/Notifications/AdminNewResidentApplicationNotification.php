<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminNewResidentApplicationNotification extends Notification implements ShouldQueue
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
            ->subject('Nouvelle candidature de résident - Hub Ivoire Tech')
            ->greeting('Bonjour,')
            ->line('Une nouvelle candidature de résident a été soumise.')
            ->line('Détails du candidat :')
            ->line('**Nom :** ' . $this->applicant->name)
            ->line('**Email :** ' . $this->applicant->email)
            ->line('**Téléphone :** ' . $this->applicant->phone)
            ->line('**Catégorie :** ' . \App\Models\User::CATEGORIES[$this->applicant->category] ?? $this->applicant->category)
            ->line('**Besoins spécifiques :** ' . ($this->applicant->needs ?: 'Aucun'))
            ->action('Voir la candidature', url('/admin/users/' . $this->applicant->id))
            ->line('Merci de traiter cette candidature dans les plus brefs délais.')
            ->salutation('Le système Hub Ivoire Tech');
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
