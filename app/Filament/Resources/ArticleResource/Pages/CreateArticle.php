<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Enums\ArticleStatus;
use App\Filament\Resources\ArticleResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateArticle extends CreateRecord
{
    protected static string $resource = ArticleResource::class;
    
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
        // Si le temps de lecture n'est pas défini, on l'estime en fonction du contenu
        if (empty($data['reading_time']) && !empty($data['content'])) {
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
}
