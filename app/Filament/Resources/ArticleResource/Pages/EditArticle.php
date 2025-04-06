<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Enums\ArticleStatus;
use App\Filament\Resources\ArticleResource;
use App\Models\Article;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Str;

class EditArticle extends EditRecord
{
    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()
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
        return $this->getResource()::getUrl('index');
    }
    
    protected function getSavedNotificationTitle(): ?string
    {
        return 'Article mis à jour avec succès';
    }
    
    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Si le temps de lecture n'est pas défini, on l'estime en fonction du contenu
        if (empty($data['reading_time']) && !empty($data['content'])) {
            // Estimation basée sur une vitesse moyenne de lecture de 200 mots par minute
            $wordCount = str_word_count(strip_tags($data['content']));
            $data['reading_time'] = max(1, ceil($wordCount / 200));
        }
        
        return $data;
    }
}
