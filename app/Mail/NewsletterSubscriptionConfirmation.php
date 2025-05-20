<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterSubscriptionConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $subscriber;

    public function __construct($subscriber)
    {
        $this->subscriber = $subscriber;
    }

    public function build()
    {
        return $this->subject(__('Confirmation d\'inscription à la newsletter - Hub Ivoire Tech'))
            ->markdown('emails.newsletter-subscription-confirmation')
            ->with([
                'name' => $this->subscriber['name'],
                'newsletter_email' => $this->subscriber['newsletter_email'],
                'newsletter_whatsapp' => $this->subscriber['newsletter_whatsapp'],
                'interests' => $this->subscriber['interests'] ?? [],
            ]);
    }
}
