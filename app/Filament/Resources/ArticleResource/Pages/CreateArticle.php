<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Enums\ArticleStatus;
use App\Filament\Resources\ArticleResource;
use App\Models\Article;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Log;

class CreateArticle extends CreateRecord
{
    protected static string $resource = ArticleResource::class;

    /**
     * Propriété pour stocker temporairement les traductions
     */
    protected array $translations = [];

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Article créé avec succès';
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Extraire les données de traduction du formulaire
        $translations = $data['translations'] ?? [];
        $this->translations = $translations; // Stocker pour utilisation dans afterCreate
        unset($data['translations']);

        // Si le temps de lecture n'est pas défini, on l'estime en fonction du contenu
        if (empty($data['reading_time']) && ! empty($data['content'])) {
            // Estimation basée sur une vitesse moyenne de lecture de 200 mots par minute
            $wordCount = str_word_count(strip_tags($data['content']));
            $data['reading_time'] = max(1, ceil($wordCount / 200));
        }

        // Si l'article est publié, on définit la date de publication
        if (isset($data['status']) && $data['status'] === ArticleStatus::PUBLISHED->value && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        return $data;
    }

    /**
     * Gère l'enregistrement des traductions après la création de l'article.
     */
    protected function afterCreate(): void
    {
        // Récupérer l'article créé
        $record = $this->record;

        // Récupérer les traductions temporaires
        $translations = $this->translations ?? [];

        // Enregistrer chaque traduction
        foreach ($translations as $locale => $translationData) {
            // S'assurer que les données de traduction contiennent au moins un champ non vide
            if (! empty($translationData)) {
                // S'assurer que la locale est définie
                if (! isset($translationData['locale'])) {
                    $translationData['locale'] = $locale;
                }

                // Créer ou mettre à jour la traduction
                $record->translations()->updateOrCreate(
                    ['locale' => $locale],
                    $translationData
                );

                // Log pour le débogage
                Log::info('Traduction créée pour la langue: '.$locale, [
                    'article_id' => $record->id,
                    'data' => $translationData,
                ]);
            }
        }
    }
}
