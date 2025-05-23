<?php

namespace App\Enums;

use App\Traits\HasEnumTranslations;

enum EventStatus: string
{
    case DRAFT = 'draft';
    case PUBLISHED = 'published';
    case CANCELLED = 'cancelled';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    use HasEnumTranslations;
    
    public function label(): string
    {
        return match($this) {
            self::DRAFT => 'Brouillon',
            self::PUBLISHED => 'Publié',
            self::CANCELLED => 'Annulé',
        };
    }
    
    /**
     * Récupère les traductions disponibles pour ce statut d'événement
     */
    public function translations(): array
    {
        return match($this) {
            self::DRAFT => [
                'fr' => 'Brouillon',
                'en' => 'Draft',
            ],
            self::PUBLISHED => [
                'fr' => 'Publié',
                'en' => 'Published',
            ],
            self::CANCELLED => [
                'fr' => 'Annulé',
                'en' => 'Cancelled',
            ],
        };
    }
    
    public function icon(): string
    {
        return match($this) {
            self::DRAFT => 'heroicon-o-document-text',
            self::PUBLISHED => 'heroicon-o-check-circle',
            self::CANCELLED => 'heroicon-o-x-circle',
        };
    }
}
