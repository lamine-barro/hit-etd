<?php

namespace App\Enums;

use App\Traits\HasEnumTranslations;

enum PartnershipType: string
{
    case DONOR = 'donor';
    case FINANCIAL_PARTNER = 'financial_partner';
    case TECHNICAL_PARTNER = 'technical_partner';
    case STRATEGIC_PARTNER = 'strategic_partner';
    case OTHER = 'other';

    use HasEnumTranslations;
    
    /**
     * Récupère le libellé du type de partenariat.
     */
    public function label(): string
    {
        return match($this) {
            self::DONOR => 'Donateur',
            self::FINANCIAL_PARTNER => 'Partenaire financier',
            self::TECHNICAL_PARTNER => 'Partenaire technique',
            self::STRATEGIC_PARTNER => 'Partenaire stratégique',
            self::OTHER => 'Autre',
        };
    }
    
    /**
     * Récupère les traductions disponibles pour ce type de partenariat
     */
    public function translations(): array
    {
        return match($this) {
            self::DONOR => [
                'fr' => 'Donateur',
                'en' => 'Donor',
            ],
            self::FINANCIAL_PARTNER => [
                'fr' => 'Partenaire financier',
                'en' => 'Financial Partner',
            ],
            self::TECHNICAL_PARTNER => [
                'fr' => 'Partenaire technique',
                'en' => 'Technical Partner',
            ],
            self::STRATEGIC_PARTNER => [
                'fr' => 'Partenaire stratégique',
                'en' => 'Strategic Partner',
            ],
            self::OTHER => [
                'fr' => 'Autre',
                'en' => 'Other',
            ],
        };
    }

    /**
     * Récupère la couleur associée au type de partenariat.
     */
    public function color(): string
    {
        return match($this) {
            self::DONOR => 'success',
            self::FINANCIAL_PARTNER => 'primary',
            self::TECHNICAL_PARTNER => 'info',
            self::STRATEGIC_PARTNER => 'warning',
            self::OTHER => 'gray',
        };
    }

    /**
     * Récupère l'icône associée au type de partenariat.
     */
    public function icon(): string
    {
        return match($this) {
            self::DONOR => 'heroicon-o-heart',
            self::FINANCIAL_PARTNER => 'heroicon-o-banknotes',
            self::TECHNICAL_PARTNER => 'heroicon-o-wrench-screwdriver',
            self::STRATEGIC_PARTNER => 'heroicon-o-puzzle-piece',
            self::OTHER => 'heroicon-o-question-mark-circle',
        };
    }

    /**
     * Récupère tous les types de partenariat sous forme de tableau associatif.
     */
    public static function options(): array
    {
        return [
            self::DONOR->value => self::DONOR->label(),
            self::FINANCIAL_PARTNER->value => self::FINANCIAL_PARTNER->label(),
            self::TECHNICAL_PARTNER->value => self::TECHNICAL_PARTNER->label(),
            self::STRATEGIC_PARTNER->value => self::STRATEGIC_PARTNER->label(),
            self::OTHER->value => self::OTHER->label(),
        ];
    }

    /**
     * Récupère tous les types de partenariat.
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
