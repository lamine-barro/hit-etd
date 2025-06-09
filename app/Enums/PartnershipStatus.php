<?php

namespace App\Enums;

use App\Traits\HasEnumTranslations;

enum PartnershipStatus: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
    case IN_DISCUSSION = 'in_discussion';

    use HasEnumTranslations;

    /**
     * Récupère le libellé du statut.
     */
    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'En attente',
            self::APPROVED => 'Approuvé',
            self::REJECTED => 'Refusé',
            self::IN_DISCUSSION => 'En discussion',
        };
    }

    /**
     * Récupère les traductions disponibles pour ce statut de partenariat
     */
    public function translations(): array
    {
        return match ($this) {
            self::PENDING => [
                'fr' => 'En attente',
                'en' => 'Pending',
            ],
            self::APPROVED => [
                'fr' => 'Approuvé',
                'en' => 'Approved',
            ],
            self::REJECTED => [
                'fr' => 'Refusé',
                'en' => 'Rejected',
            ],
            self::IN_DISCUSSION => [
                'fr' => 'En discussion',
                'en' => 'In Discussion',
            ],
        };
    }

    /**
     * Récupère la couleur associée au statut.
     */
    public function color(): string
    {
        return match ($this) {
            self::PENDING => 'warning',
            self::APPROVED => 'success',
            self::REJECTED => 'danger',
            self::IN_DISCUSSION => 'info',
        };
    }

    /**
     * Récupère l'icône associée au statut.
     */
    public function icon(): string
    {
        return match ($this) {
            self::PENDING => 'heroicon-o-clock',
            self::APPROVED => 'heroicon-o-check-circle',
            self::REJECTED => 'heroicon-o-x-circle',
            self::IN_DISCUSSION => 'heroicon-o-chat-bubble-left-right',
        };
    }

    /**
     * Récupère tous les statuts sous forme de tableau associatif.
     */
    public static function options(): array
    {
        return [
            self::PENDING->value => self::PENDING->label(),
            self::APPROVED->value => self::APPROVED->label(),
            self::REJECTED->value => self::REJECTED->label(),
            self::IN_DISCUSSION->value => self::IN_DISCUSSION->label(),
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
