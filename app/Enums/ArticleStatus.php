<?php

namespace App\Enums;

enum ArticleStatus: string
{
    case DRAFT = 'draft';
    case PUBLISHED = 'published';
    case ARCHIVED = 'archived';

    /**
     * Récupère le libellé de l'état.
     */
    public function label(): string
    {
        return match($this) {
            self::DRAFT => 'Brouillon',
            self::PUBLISHED => 'Publié',
            self::ARCHIVED => 'Archivé',
        };
    }

    /**
     * Récupère la couleur associée à l'état.
     */
    public function color(): string
    {
        return match($this) {
            self::DRAFT => 'gray',
            self::PUBLISHED => 'success',
            self::ARCHIVED => 'danger',
        };
    }

    /**
     * Récupère l'icône associée à l'état.
     */
    public function icon(): string
    {
        return match($this) {
            self::DRAFT => 'heroicon-o-pencil',
            self::PUBLISHED => 'heroicon-o-check-circle',
            self::ARCHIVED => 'heroicon-o-archive-box',
        };
    }

    /**
     * Récupère tous les états sous forme de tableau associatif.
     */
    public static function options(): array
    {
        return [
            self::DRAFT->value => self::DRAFT->label(),
            self::PUBLISHED->value => self::PUBLISHED->label(),
            self::ARCHIVED->value => self::ARCHIVED->label(),
        ];
    }

    /**
     * Récupère tous les états.
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
