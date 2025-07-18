<?php

namespace App\Notifications;

use App\Models\Audience;
use Filament\Notifications\Notification as FilamentNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewNewsletterSubscriberNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(private Audience $audience) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('Un nouveau membre s\'est inscrit à la newsletter.')
            ->action('Voir les détails', url('/admin'))
            ->line('Merci d\'utiliser notre plateforme !');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Nouvel abonné newsletter',
            'body' => "Nouveau membre : {$this->audience->name} ({$this->audience->email})",
            'icon' => 'heroicon-o-envelope',
            'iconColor' => 'success',
            'audience_id' => $this->audience->id,
            'audience_name' => $this->audience->name,
            'audience_email' => $this->audience->email,
            'interests' => $this->audience->interests ?? [],
            'newsletter_email' => $this->audience->newsletter_email,
            'newsletter_whatsapp' => $this->audience->newsletter_whatsapp,
        ];
    }

    /**
     * Get the Filament notification representation.
     */
    public function toFilament(): FilamentNotification
    {
        return FilamentNotification::make()
            ->title('Nouvel abonné newsletter')
            ->body("Nouveau membre : {$this->audience->name} ({$this->audience->email})")
            ->icon('heroicon-o-envelope')
            ->iconColor('success')
            ->actions([
                \Filament\Notifications\Actions\Action::make('view')
                    ->label('Voir les détails')
                    ->url('/admin/audiences/' . $this->audience->id)
                    ->button(),
            ]);
    }
} 