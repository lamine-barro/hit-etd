<?php

namespace App\Mail;

use App\Models\Audience;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewsletterPreferencesUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(private Audience $audience) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('Mise à jour de vos préférences newsletter - Hub Ivoire Tech'),
            to: $this->audience->email,
            from: env('HIT_SUPPORT_EMAIL'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.newsletter-preferences-updated',
            with: [
                'name' => $this->audience->name,
                'email' => $this->audience->email,
                'newsletter_email' => $this->audience->newsletter_email,
                'newsletter_whatsapp' => $this->audience->newsletter_whatsapp,
                'interests' => $this->audience->interests ?? [],
            ]
        );
    }
} 