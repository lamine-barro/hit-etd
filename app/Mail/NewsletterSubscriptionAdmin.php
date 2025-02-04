<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterSubscriptionAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public $subscriber;

    public function __construct($subscriber)
    {
        $this->subscriber = $subscriber;
    }

    public function build()
    {
        return $this->subject('Nouvel abonné à la newsletter - Hub Ivoire Tech')
            ->markdown('emails.newsletter-subscription-admin')
            ->with([
                'name' => $this->subscriber['name'],
                'email' => $this->subscriber['email'],
                'whatsapp' => $this->subscriber['whatsapp'] ?? null,
                'newsletter_email' => $this->subscriber['newsletter_email'],
                'newsletter_whatsapp' => $this->subscriber['newsletter_whatsapp'],
                'interests' => $this->subscriber['interests'] ?? [],
            ]);
    }
}
