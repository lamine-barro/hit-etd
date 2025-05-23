<?php

namespace App\Traits;

use App\Enums\LanguageEnum;
use Illuminate\Support\Facades\App;

trait HasEnumTranslations
{
    /**
     * Récupère le libellé traduit de l'enum dans la langue spécifiée
     */
    public function getTranslatedLabel(?string $locale = null): string
    {
        $locale = $locale ?: App::getLocale();
        
        // Récupérer les traductions disponibles
        $translations = $this->translations();
        
        // Si la traduction existe pour la langue demandée, la retourner
        if (isset($translations[$locale])) {
            return $translations[$locale];
        }
        
        // Sinon, retourner la traduction par défaut (français)
        return $translations[LanguageEnum::FRENCH->value] ?? $this->label();
    }
    
    /**
     * Méthode abstraite à implémenter dans chaque enum
     * pour définir les traductions disponibles
     */
    abstract public function translations(): array;
}
