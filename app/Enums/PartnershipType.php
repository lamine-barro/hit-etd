<?php

namespace App\Enums;

enum PartnershipType: string
{
    case DONOR = 'donor';
    case FINANCIAL_PARTNER = 'financial_partner';
    case TECHNICAL_PARTNER = 'technical_partner';
    case STRATEGIC_PARTNER = 'strategic_partner';
    case OTHER = 'other';

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
