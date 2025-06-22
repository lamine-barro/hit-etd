<?php

namespace App\Mail;

use App\Models\Audience;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewsletterSubscriptionAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(private Audience $audience) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('Nouvel abonné à la newsletter - Hub Ivoire Tech'),
            to: env('HIT_SUPPORT_EMAIL'),
            from: env('MAIL_FROM_ADDRESS'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.newsletter-subscription-admin',
            with: [
                'name' => $this->audience->name,
                'email' => $this->audience->email,
                'whatsapp' => $this->audience->whatsapp ?? null,
                'newsletter_email' => $this->audience->newsletter_email,
                'newsletter_whatsapp' => $this->audience->newsletter_whatsapp,
                'interests' => $this->audience->interests ?? [],
            ]
        );
    }
}
