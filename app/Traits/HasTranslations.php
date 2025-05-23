<?php

namespace App\Traits;

use App\Enums\LanguageEnum;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\App;

trait HasTranslations
{
    /**
     * Obtenir toutes les traductions du modèle.
     */
    public function translations(): HasMany
    {
        return $this->hasMany($this->getTranslationModelName());
    }
    
    /**
     * Obtenir la traduction du modèle dans la langue spécifiée.
     *
     * @param string|null|LanguageEnum $locale
     * @return mixed
     */
    public function translation(string|LanguageEnum|null $locale = null)
    {
        if ($locale instanceof LanguageEnum) {
            $locale = $locale->value;
        } else {
            $locale = $locale ?: App::getLocale();
        }
        
        return $this->translations()->where('locale', $locale)->first();
    }
    
    /**
     * Obtenir ou créer une traduction dans la langue spécifiée.
     *
     * @param string|null|LanguageEnum $locale
     * @return mixed
     */
    public function getOrCreateTranslation(string|LanguageEnum|null $locale = null)
    {
        if ($locale instanceof LanguageEnum) {
            $locale = $locale->value;
        } else {
            $locale = $locale ?: App::getLocale();
        }
        
        $translation = $this->translation($locale);
        
        if (!$translation) {
            // Créer une nouvelle traduction basée sur la langue par défaut
            $defaultTranslation = $this->translation($this->default_locale);
            
            $data = ['locale' => $locale];
            
            foreach ($this->getTranslatableAttributes() as $attribute) {
                $data[$attribute] = $defaultTranslation && isset($defaultTranslation->$attribute) 
                    ? $defaultTranslation->$attribute 
                    : $this->getAttribute($attribute);
                
                // Cas spécial pour le slug, ajouter le code de langue
                if ($attribute === 'slug') {
                    $data[$attribute] = $data[$attribute] . '-' . $locale;
                }
            }
            
            $translation = $this->translations()->create($data);
        }
        
        return $translation;
    }
    
    /**
     * Obtenir l'attribut traduit dans la langue actuelle.
     *
     * @param string $key
     * @return mixed
     */
    public function getTranslatedAttribute(string $key)
    {
        if (!in_array($key, $this->getTranslatableAttributes())) {
            return $this->$key;
        }
        
        $translation = $this->translation();
        
        if ($translation && isset($translation->$key)) {
            return $translation->$key;
        }
        
        // Fallback à la langue par défaut
        $defaultTranslation = $this->translation($this->default_locale);
        
        if ($defaultTranslation && isset($defaultTranslation->$key)) {
            return $defaultTranslation->$key;
        }
        
        // Fallback aux attributs du modèle lui-même
        // Utiliser getAttribute pour accéder aux propriétés du modèle
        return $this->getAttribute($key);
    }
    
    /**
     * Définir l'attribut traduit dans la langue actuelle.
     *
     * @param string $key
     * @param mixed $value
     * @param string|null|LanguageEnum $locale
     * @return void
     */
    public function setTranslatedAttribute(string $key, $value, string|LanguageEnum|null $locale = null)
    {
        if (!in_array($key, $this->getTranslatableAttributes())) {
            $this->$key = $value;
            return;
        }
        
        if ($locale instanceof LanguageEnum) {
            $locale = $locale->value;
        } else {
            $locale = $locale ?: App::getLocale();
        }
        
        $translation = $this->getOrCreateTranslation($locale);
        $translation->$key = $value;
        $translation->save();
    }
    
    /**
     * Obtenir le nom du modèle de traduction.
     *
     * @return string
     */
    protected function getTranslationModelName(): string
    {
        return static::class . 'Translation';
    }
    
    /**
     * Obtenir les attributs traduisibles.
     *
     * @return array
     */
    public function getTranslatableAttributes(): array
    {
        return $this->translatable ?? [];
    }
    
    /**
     * Méthode magique pour accéder aux attributs traduits.
     *
     * @param string $key
     * @return mixed
     */
    public function __get($key)
    {
        if (in_array($key, $this->getTranslatableAttributes())) {
            return $this->getTranslatedAttribute($key);
        }
        
        return parent::__get($key);
    }
    
    /**
     * Méthode magique pour définir les attributs traduits.
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function __set($key, $value)
    {
        if (in_array($key, $this->getTranslatableAttributes())) {
            $this->setTranslatedAttribute($key, $value);
            return;
        }
        
        parent::__set($key, $value);
    }
}
