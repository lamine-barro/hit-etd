<?php

namespace App\Enums;

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

    public function label(): string
    {
        return match($this) {
            self::CONFERENCE => 'Conférence',
            self::WORKSHOP => 'Atelier',
            self::WEBINAR => 'Webinaire',
            self::MEETUP => 'Meetup',
            self::TRAINING => 'Formation',
            self::HACKATHON => 'Hackathon',
            self::OTHER => 'Autre',
        };
    }
    
    public function icon(): string
    {
        return match($this) {
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
