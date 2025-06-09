<?php

namespace App\Enums;

use App\Traits\HasEnumTranslations;

enum EventType: string
{
    case CONFERENCE = 'conference';
    case WORKSHOP = 'workshop';
    case WEBINAR = 'webinar';
    case MEETUP = 'meetup';
    case TRAINING = 'training';
    case HACKATHON = 'hackathon';
    case OTHER = 'other';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    use HasEnumTranslations;

    public function label(): string
    {
        return match ($this) {
            self::CONFERENCE => 'Conférence',
            self::WORKSHOP => 'Atelier',
            self::WEBINAR => 'Webinaire',
            self::MEETUP => 'Meetup',
            self::TRAINING => 'Formation',
            self::HACKATHON => 'Hackathon',
            self::OTHER => 'Autre',
        };
    }

    /**
     * Récupère les traductions disponibles pour ce type d'événement
     */
    public function translations(): array
    {
        return match ($this) {
            self::CONFERENCE => [
                'fr' => 'Conférence',
                'en' => 'Conference',
            ],
            self::WORKSHOP => [
                'fr' => 'Atelier',
                'en' => 'Workshop',
            ],
            self::WEBINAR => [
                'fr' => 'Webinaire',
                'en' => 'Webinar',
            ],
            self::MEETUP => [
                'fr' => 'Meetup',
                'en' => 'Meetup',
            ],
            self::TRAINING => [
                'fr' => 'Formation',
                'en' => 'Training',
            ],
            self::HACKATHON => [
                'fr' => 'Hackathon',
                'en' => 'Hackathon',
            ],
            self::OTHER => [
                'fr' => 'Autre',
                'en' => 'Other',
            ],
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::CONFERENCE => 'heroicon-o-presentation-chart-bar',
            self::WORKSHOP => 'heroicon-o-beaker',
            self::WEBINAR => 'heroicon-o-computer-desktop',
            self::MEETUP => 'heroicon-o-user-group',
            self::TRAINING => 'heroicon-o-academic-cap',
            self::HACKATHON => 'heroicon-o-code-bracket',
            self::OTHER => 'heroicon-o-question-mark-circle',
        };
    }
}
