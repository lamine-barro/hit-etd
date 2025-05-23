<?php

namespace App\Enums;

enum LanguageEnum: string
{
    case FRENCH = 'fr';
    case ENGLISH = 'en';

    /**
     * Récupère le nom complet de la langue
     */
    public function label(): string
    {
        return match($this) {
            self::FRENCH => 'Français',
            self::ENGLISH => 'Anglais',
        };
    }

    /**
     * Récupère toutes les langues sous forme de tableau associatif
     */
    public static function toArray(): array
    {
        return [
            self::FRENCH->value => self::FRENCH->label(),
            self::ENGLISH->value => self::ENGLISH->label(),
        ];
    }

    /**
     * Récupère toutes les langues disponibles
     */
    public static function getAvailableLanguages(): array
    {
        return self::cases();
    }

    /**
     * Vérifie si un code de langue est valide
     */
    public static function isValid(string $locale): bool
    {
        return in_array($locale, array_column(self::cases(), 'value'));
    }

    /**
     * Récupère l'instance d'enum à partir d'un code de langue
     */
    public static function fromLocale(string $locale): ?self
    {
        foreach (self::cases() as $case) {
            if ($case->value === $locale) {
                return $case;
            }
        }
        
        return null;
    }
}
