<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Enums\ArticleStatus;
use App\Filament\Resources\ArticleResource;
use App\Models\Article;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class EditArticle extends EditRecord
{
    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()
                ->url(fn () => route('filament.admin.resources.articles.view', $this->record->id))
                ->label('Voir'),
            Actions\Action::make('publish')
                ->label('Publier')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->visible(fn (Article $record) => $record->status === ArticleStatus::DRAFT)
                ->action(function () {
                    $this->record->status = ArticleStatus::PUBLISHED;
                    $this->record->published_at = $this->record->published_at ?? now();
                    $this->record->save();
                    $this->refreshFormData(['status', 'published_at']);
                    $this->notify('success', 'L\'article a été publié avec succès.');
                }),
            Actions\Action::make('unpublish')
                ->label('Dépublier')
                ->icon('heroicon-o-arrow-uturn-left')
                ->color('gray')
                ->visible(fn (Article $record) => $record->status === ArticleStatus::PUBLISHED)
                ->action(function () {
                    $this->record->status = ArticleStatus::DRAFT;
                    $this->record->save();
                    $this->refreshFormData(['status']);
                    $this->notify('success', 'L\'article a été dépublié avec succès.');
                }),
            Actions\Action::make('duplicate')
                ->label('Dupliquer')
                ->icon('heroicon-o-document-duplicate')
                ->color('info')
                ->action(function () {
                    $duplicate = $this->record->replicate();
                    $duplicate->title = 'Copie de ' . $this->record->title;
                    $duplicate->slug = Str::slug($duplicate->title);
                    $duplicate->status = ArticleStatus::DRAFT;
                    $duplicate->views = 0;
                    $duplicate->published_at = null;
                    $duplicate->save();
                    
                    return redirect(ArticleResource::getUrl('edit', ['record' => $duplicate]));
                }),
            Actions\DeleteAction::make()
                ->label('Supprimer'),
            Actions\ForceDeleteAction::make()
                ->label('Supprimer définitivement'),
            Actions\RestoreAction::make()
                ->label('Restaurer'),
        ];
    }
    
    protected function getRedirectUrl(): string
    {
        // Rediriger vers la page de visualisation avec l'ID explicite de l'article
        return $this->getResource()::getUrl('view', ['record' => $this->record->id]);
    }
    
    protected function getSavedNotificationTitle(): ?string
    {
        return 'Article mis à jour avec succès';
    }
    
    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Extraire les données de traduction du formulaire
        $translations = $data['translations'] ?? [];
        $this->translations = $translations; // Stocker pour utilisation dans afterSave
        unset($data['translations']);
        
        // Si le temps de lecture n'est pas défini, on l'estime en fonction du contenu
        if (empty($data['reading_time']) && !empty($data['content'])) {
            // Estimation basée sur une vitesse moyenne de lecture de 200 mots par minute
            $wordCount = str_word_count(strip_tags($data['content']));
            $data['reading_time'] = max(1, ceil($wordCount / 200));
        }
        
        return $data;
    }
    
    /**
     * Gère l'enregistrement des traductions après la mise à jour de l'article.
     *
     * @return void
     */
    protected function afterSave(): void
    {
        // Récupérer l'article mis à jour
        $record = $this->record;
        
        // Récupérer les traductions temporaires
        $translations = $this->translations ?? [];
        
        // Enregistrer chaque traduction
        foreach ($translations as $locale => $translationData) {
            // S'assurer que les données de traduction contiennent au moins un champ non vide
            if (!empty($translationData)) {
                // S'assurer que la locale est définie
                if (!isset($translationData['locale'])) {
                    $translationData['locale'] = $locale;
                }
                
                // Créer ou mettre à jour la traduction
                $record->translations()->updateOrCreate(
                    ['locale' => $locale],
                    $translationData
                );
                
                // Log pour le débogage
                Log::info('Traduction mise à jour pour la langue: ' . $locale, [
                    'article_id' => $record->id,
                    'data' => $translationData
                ]);
            }
        }
    }
    
    /**
     * Propriété pour stocker temporairement les traductions
     *
     * @var array
     */
    protected array $translations = [];
    
    /**
     * Prépare les données du formulaire avant qu'il ne soit rempli.
     * Cette méthode charge les traductions dans le formulaire.
     *
     * @param array $data
     * @return array
     */
    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Récupérer toutes les traductions de l'article
        $translations = $this->record->translations()->get();
        
        // Préparer les données de traduction pour le formulaire
        $data['translations'] = [];
        
        foreach ($translations as $translation) {
            // Assurez-vous que la clé est une chaîne de caractères
            $locale = $translation->locale;
            
            // Si c'est un enum, convertissez-le en chaîne
            if ($locale instanceof \App\Enums\LanguageEnum) {
                $locale = $locale->value;
            }
            
            $data['translations'][$locale] = $translation->toArray();
        }
        
        return $data;
    }
}
