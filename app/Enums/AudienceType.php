<?php

namespace App\Enums;

enum AudienceType: string
{
    case STARTUPS = 'startups';
    case TECH = 'tech';
    case EVENTS = 'events';
    case FORMATION = 'formation';
    
    /**
     * Retourne le libellé associé au type d'audience
     *
     * @return string
     */
    public function label(): string
    {
        return match($this) {
            self::STARTUPS => 'Startups',
            self::TECH => 'Tech',
            self::EVENTS => 'Événements',
            self::FORMATION => 'Formation',
        };
    }
    
    /**
     * Retourne l'icône SVG associée au type d'audience
     *
     * @return string
     */
    public function icon(): string
    {
        return match($this) {
            self::STARTUPS => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />',
            self::TECH => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />',
            self::EVENTS => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />',
            self::FORMATION => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />',
        };
    }
    
    /**
     * Retourne tous les types d'audience sous forme de tableau
     *
     * @return array
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
