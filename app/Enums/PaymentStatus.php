<?php

namespace App\Enums;

enum PaymentStatus: string
{
    case PENDING = 'pending';
    case PAID = 'paid';
    case FAILED = 'failed';
    case REFUNDED = 'refunded';

    /**
     * Récupère le libellé du statut.
     */
    public function label(): string
    {
        return match($this) {
            self::PENDING => 'En attente',
            self::PAID => 'Payé',
            self::FAILED => 'Échoué',
            self::REFUNDED => 'Remboursé',
        };
    }

    /**
     * Récupère la couleur associée au statut.
     */
    public function color(): string
    {
        return match($this) {
            self::PENDING => 'warning',
            self::PAID => 'success',
            self::FAILED => 'danger',
            self::REFUNDED => 'info',
        };
    }

    /**
     * Récupère l'icône associée au statut.
     */
    public function icon(): string
    {
        return match($this) {
            self::PENDING => 'heroicon-o-clock',
            self::PAID => 'heroicon-o-banknotes',
            self::FAILED => 'heroicon-o-x-circle',
            self::REFUNDED => 'heroicon-o-arrow-path',
        };
    }

    /**
     * Récupère tous les statuts sous forme de tableau associatif.
     */
    public static function options(): array
    {
        return [
            self::PENDING->value => self::PENDING->label(),
            self::PAID->value => self::PAID->label(),
            self::FAILED->value => self::FAILED->label(),
            self::REFUNDED->value => self::REFUNDED->label(),
        ];
    }

    /**
     * Récupère tous les statuts.
     */
    public static function values(): array
    {
        return [
            self::PENDING,
            self::PAID,
            self::FAILED,
            self::REFUNDED,
        ];
    }
}
