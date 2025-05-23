<?php

namespace App\Enums;

use App\Traits\HasEnumTranslations;

enum ArticleCategory: string
{
    case TECH_ECOSYSTEM = 'tech_ecosystem';
    case DIGITAL_TRANSFORMATION = 'digital_transformation';
    case ARTIFICIAL_INTELLIGENCE = 'artificial_intelligence';
    case CYBERSECURITY = 'cybersecurity';
    case FINTECH = 'fintech';
    case ENTREPRENEURSHIP = 'entrepreneurship';
    case DIVERSITY_INCLUSION = 'diversity_inclusion';
    case WEB_DEVELOPMENT = 'web_development';
    case MOBILE = 'mobile';
    case CLOUD = 'cloud';
    case BLOCKCHAIN = 'blockchain';
    case OTHER = 'other';

    use HasEnumTranslations;
    
    /**
     * Récupère le libellé de la catégorie.
     */
    public function label(): string
    {
        return match($this) {
            self::TECH_ECOSYSTEM => 'Écosystème Tech',
            self::DIGITAL_TRANSFORMATION => 'Transformation Numérique',
            self::ARTIFICIAL_INTELLIGENCE => 'Intelligence Artificielle',
            self::CYBERSECURITY => 'Cybersécurité',
            self::FINTECH => 'Fintech',
            self::ENTREPRENEURSHIP => 'Entrepreneuriat',
            self::DIVERSITY_INCLUSION => 'Diversité & Inclusion',
            self::WEB_DEVELOPMENT => 'Développement Web',
            self::MOBILE => 'Mobile',
            self::CLOUD => 'Cloud',
            self::BLOCKCHAIN => 'Blockchain',
            self::OTHER => 'Autre',
        };
    }
    
    /**
     * Récupère les traductions disponibles pour cette catégorie
     */
    public function translations(): array
    {
        return match($this) {
            self::TECH_ECOSYSTEM => [
                'fr' => 'Écosystème Tech',
                'en' => 'Tech Ecosystem',
            ],
            self::DIGITAL_TRANSFORMATION => [
                'fr' => 'Transformation Numérique',
                'en' => 'Digital Transformation',
            ],
            self::ARTIFICIAL_INTELLIGENCE => [
                'fr' => 'Intelligence Artificielle',
                'en' => 'Artificial Intelligence',
            ],
            self::CYBERSECURITY => [
                'fr' => 'Cybersécurité',
                'en' => 'Cybersecurity',
            ],
            self::FINTECH => [
                'fr' => 'Fintech',
                'en' => 'Fintech',
            ],
            self::ENTREPRENEURSHIP => [
                'fr' => 'Entrepreneuriat',
                'en' => 'Entrepreneurship',
            ],
            self::DIVERSITY_INCLUSION => [
                'fr' => 'Diversité & Inclusion',
                'en' => 'Diversity & Inclusion',
            ],
            self::WEB_DEVELOPMENT => [
                'fr' => 'Développement Web',
                'en' => 'Web Development',
            ],
            self::MOBILE => [
                'fr' => 'Mobile',
                'en' => 'Mobile',
            ],
            self::CLOUD => [
                'fr' => 'Cloud',
                'en' => 'Cloud',
            ],
            self::BLOCKCHAIN => [
                'fr' => 'Blockchain',
                'en' => 'Blockchain',
            ],
            self::OTHER => [
                'fr' => 'Autre',
                'en' => 'Other',
            ],
        };
    }

    /**
     * Récupère la couleur associée à la catégorie.
     */
    public function color(): string
    {
        return match($this) {
            self::TECH_ECOSYSTEM => 'primary',
            self::DIGITAL_TRANSFORMATION => 'info',
            self::ARTIFICIAL_INTELLIGENCE => 'purple',
            self::CYBERSECURITY => 'danger',
            self::FINTECH => 'success',
            self::ENTREPRENEURSHIP => 'warning',
            self::DIVERSITY_INCLUSION => 'pink',
            self::WEB_DEVELOPMENT => 'blue',
            self::MOBILE => 'orange',
            self::CLOUD => 'sky',
            self::BLOCKCHAIN => 'indigo',
            self::OTHER => 'gray',
        };
    }

    /**
     * Récupère l'icône associée à la catégorie.
     */
    public function icon(): string
    {
        return match($this) {
            self::TECH_ECOSYSTEM => 'heroicon-o-globe-alt',
            self::DIGITAL_TRANSFORMATION => 'heroicon-o-arrow-path',
            self::ARTIFICIAL_INTELLIGENCE => 'heroicon-o-cpu-chip',
            self::CYBERSECURITY => 'heroicon-o-shield-check',
            self::FINTECH => 'heroicon-o-banknotes',
            self::ENTREPRENEURSHIP => 'heroicon-o-rocket-launch',
            self::DIVERSITY_INCLUSION => 'heroicon-o-users',
            self::WEB_DEVELOPMENT => 'heroicon-o-code-bracket',
            self::MOBILE => 'heroicon-o-device-phone-mobile',
            self::CLOUD => 'heroicon-o-cloud',
            self::BLOCKCHAIN => 'heroicon-o-link',
            self::OTHER => 'heroicon-o-question-mark-circle',
        };
    }

    /**
     * Récupère toutes les catégories sous forme de tableau associatif.
     */
    public static function options(): array
    {
        return [
            self::TECH_ECOSYSTEM->value => self::TECH_ECOSYSTEM->label(),
            self::DIGITAL_TRANSFORMATION->value => self::DIGITAL_TRANSFORMATION->label(),
            self::ARTIFICIAL_INTELLIGENCE->value => self::ARTIFICIAL_INTELLIGENCE->label(),
            self::CYBERSECURITY->value => self::CYBERSECURITY->label(),
            self::FINTECH->value => self::FINTECH->label(),
            self::ENTREPRENEURSHIP->value => self::ENTREPRENEURSHIP->label(),
            self::DIVERSITY_INCLUSION->value => self::DIVERSITY_INCLUSION->label(),
            self::WEB_DEVELOPMENT->value => self::WEB_DEVELOPMENT->label(),
            self::MOBILE->value => self::MOBILE->label(),
            self::CLOUD->value => self::CLOUD->label(),
            self::BLOCKCHAIN->value => self::BLOCKCHAIN->label(),
            self::OTHER->value => self::OTHER->label(),
        ];
    }

    /**
     * Récupère toutes les catégories.
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
