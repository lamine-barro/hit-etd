<?php

namespace App\Enums;

use App\Traits\HasEnumTranslations;

enum BookingStatus: string
{
    case UNTREATED = 'untreated';
    case TREATED = 'treated';
    case ARCHIVED = 'archived';

    use HasEnumTranslations;

    /**
     * Récupère le libellé du statut.
     */
    public function label(): string
    {
        return match ($this) {
            self::UNTREATED => 'Non traité',
            self::TREATED => 'Traité',
            self::ARCHIVED => 'Archivé',
        };
    }

    /**
     * Récupère les traductions disponibles pour ce statut de réservation
     */
    public function translations(): array
    {
        return match ($this) {
            self::UNTREATED => [
                'fr' => 'Non traité',
                'en' => 'Untreated',
            ],
            self::TREATED => [
                'fr' => 'Traité',
                'en' => 'Treated',
            ],
            self::ARCHIVED => [
                'fr' => 'Archivé',
                'en' => 'Archived',
            ],
        };
    }

    /**
     * Récupère la couleur associée au statut.
     */
    public function color(): string
    {
        return match ($this) {
            self::UNTREATED => 'warning',
            self::TREATED => 'success',
            self::ARCHIVED => 'gray',
        };
    }

    /**
     * Récupère l'icône associée au statut.
     */
    public function icon(): string
    {
        return match ($this) {
            self::UNTREATED => 'heroicon-o-clock',
            self::TREATED => 'heroicon-o-check-circle',
            self::ARCHIVED => 'heroicon-o-archive-box',
        };
    }

    /**
     * Récupère tous les statuts sous forme de tableau associatif.
     */
    public static function options(): array
    {
        return [
            self::UNTREATED->value => self::UNTREATED->label(),
            self::TREATED->value => self::TREATED->label(),
            self::ARCHIVED->value => self::ARCHIVED->label(),
        ];
    }

    /**
     * Récupère tous les statuts.
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
