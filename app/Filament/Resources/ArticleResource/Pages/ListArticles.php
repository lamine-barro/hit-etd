<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Enums\ArticleStatus;
use App\Filament\Resources\ArticleResource;
use App\Models\Article;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListArticles extends ListRecords
{
    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Créer un article'),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make()
                ->label('Tous')
                ->icon('heroicon-o-rectangle-stack'),
            'published' => Tab::make()
                ->label('Publiés')
                ->icon('heroicon-o-check-circle')
                ->badge(Article::where('status', ArticleStatus::PUBLISHED->value)->count())
                ->badgeColor('success')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', ArticleStatus::PUBLISHED->value)),
            'draft' => Tab::make()
                ->label('Brouillons')
                ->icon('heroicon-o-pencil')
                ->badge(Article::where('status', ArticleStatus::DRAFT->value)->count())
                ->badgeColor('warning')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', ArticleStatus::DRAFT->value)),
            'archived' => Tab::make()
                ->label('Archivés')
                ->icon('heroicon-o-archive-box')
                ->badge(Article::where('status', ArticleStatus::ARCHIVED->value)->count())
                ->badgeColor('gray')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', ArticleStatus::ARCHIVED->value)),
        ];
    }

    protected function getTableEmptyStateActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Créer votre premier article'),
        ];
    }

    protected function getTableEmptyStateIcon(): ?string
    {
        return 'heroicon-o-document-text';
    }

    protected function getTableEmptyStateHeading(): ?string
    {
        return 'Aucun article trouvé';
    }

    protected function getTableEmptyStateDescription(): ?string
    {
        return 'Vous pouvez créer un article en cliquant sur le bouton ci-dessous.';
    }

    protected function getDefaultTableSortColumn(): ?string
    {
        return 'created_at';
    }

    protected function getDefaultTableSortDirection(): ?string
    {
        return 'desc';
    }

    protected function getTableRecordsPerPageSelectOptions(): array
    {
        return [10, 25, 50, 100];
    }
}
