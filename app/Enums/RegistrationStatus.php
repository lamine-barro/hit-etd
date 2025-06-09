<?php

namespace App\Enums;

use App\Traits\HasEnumTranslations;

enum RegistrationStatus: string
{
    case PENDING = 'pending';
    case CONFIRMED = 'confirmed';
    case CANCELLED = 'cancelled';
    case ATTENDED = 'attended';

    use HasEnumTranslations;

    /**
     * Récupère le libellé du statut.
     */
    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'En attente',
            self::CONFIRMED => 'Confirmé',
            self::CANCELLED => 'Annulé',
            self::ATTENDED => 'A participé',
        };
    }

    /**
     * Récupère les traductions disponibles pour ce statut d'inscription
     */
    public function translations(): array
    {
        return match ($this) {
            self::PENDING => [
                'fr' => 'En attente',
                'en' => 'Pending',
            ],
            self::CONFIRMED => [
                'fr' => 'Confirmé',
                'en' => 'Confirmed',
            ],
            self::CANCELLED => [
                'fr' => 'Annulé',
                'en' => 'Cancelled',
            ],
            self::ATTENDED => [
                'fr' => 'A participé',
                'en' => 'Attended',
            ],
        };
    }

    /**
     * Récupère la couleur associée au statut.
     */
    public function color(): string
    {
        return match ($this) {
            self::PENDING => 'gray',
            self::CONFIRMED => 'success',
            self::CANCELLED => 'danger',
            self::ATTENDED => 'info',
        };
    }

    /**
     * Récupère l'icône associée au statut.
     */
    public function icon(): string
    {
        return match ($this) {
            self::PENDING => 'heroicon-o-clock',
            self::CONFIRMED => 'heroicon-o-check-circle',
            self::CANCELLED => 'heroicon-o-x-circle',
            self::ATTENDED => 'heroicon-o-user-circle',
        };
    }

    /**
     * Récupère tous les statuts sous forme de tableau associatif.
     */
    public static function options(): array
    {
        return [
            self::PENDING->value => self::PENDING->label(),
            self::CONFIRMED->value => self::CONFIRMED->label(),
            self::CANCELLED->value => self::CANCELLED->label(),
            self::ATTENDED->value => self::ATTENDED->label(),
        ];
    }

    /**
     * Récupère tous les statuts.
     */
    public static function values(): array
    {
        return [
            self::PENDING,
            self::CONFIRMED,
            self::CANCELLED,
            self::ATTENDED,
        ];
    }
}
