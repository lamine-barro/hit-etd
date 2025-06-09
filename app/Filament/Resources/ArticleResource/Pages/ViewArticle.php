<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Enums\ArticleCategory;
use App\Enums\ArticleStatus;
use App\Filament\Resources\ArticleResource;
use App\Models\Article;
use Filament\Actions;
use Filament\Infolists;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\HtmlString;

class ViewArticle extends ViewRecord
{
    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->url(fn () => route('filament.admin.resources.articles.edit', $this->record->id))
                ->label('Modifier'),
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
                    $duplicate->title = 'Copie de '.$this->record->title;
                    $duplicate->slug = \Illuminate\Support\Str::slug($duplicate->title);
                    $duplicate->status = 'draft';
                    $duplicate->views = 0;
                    $duplicate->published_at = null;
                    $duplicate->save();

                    return redirect(ArticleResource::getUrl('edit', ['record' => $duplicate]));
                }),
            Actions\DeleteAction::make()
                ->label('Supprimer'),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        // Récupérer la langue actuelle
        $currentLocale = app()->getLocale();

        // Récupérer toutes les langues disponibles
        $availableLocales = \App\Enums\LanguageEnum::toArray();

        return $infolist
            ->schema([
                Section::make('Informations générales')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('default_locale')
                                    ->label('Langue principale')
                                    ->formatStateUsing(function ($state) {
                                        // Convertir le code de langue en nom complet
                                        return \App\Enums\LanguageEnum::fromLocale($state)?->label() ?? $state;
                                    })
                                    ->badge()
                                    ->color('primary'),

                                TextEntry::make('category')
                                    ->label('Catégorie')
                                    ->formatStateUsing(function (ArticleCategory $state) use ($currentLocale) {
                                        // Utiliser la méthode getTranslatedLabel pour avoir le nom de la catégorie dans la langue actuelle
                                        return $state->getTranslatedLabel($currentLocale);
                                    })
                                    ->badge()
                                    ->icon(fn (ArticleCategory $state): string => $state->icon())
                                    ->color(fn (ArticleCategory $state): string => $state->color()),

                                TextEntry::make('status')
                                    ->label('Statut')
                                    ->badge()
                                    ->formatStateUsing(fn (ArticleStatus $state): string => $state->label())
                                    ->icon(fn (ArticleStatus $state): string => $state->icon())
                                    ->color(fn (ArticleStatus $state): string => $state->color()),

                                TextEntry::make('published_at')
                                    ->label('Date de publication')
                                    ->dateTime('d/m/Y H:i')
                                    ->visible(fn (Article $record) => $record->published_at !== null),
                            ]),
                    ]),

                // Onglets pour chaque langue disponible
                Infolists\Components\Tabs::make('Langues')
                    ->columns(1)
                    ->columnSpanFull()
                    ->tabs([
                        // Créer un onglet pour chaque langue disponible
                        ...collect($availableLocales)->map(function ($label, $locale) {
                            return Infolists\Components\Tabs\Tab::make($label)
                                ->icon('heroicon-o-language')
                                ->schema([
                                    Grid::make(3)
                                        ->schema([
                                            TextEntry::make('translations')
                                                ->label('Titre')
                                                ->state(function (Article $record) use ($locale) {
                                                    // Récupérer la traduction pour cette langue
                                                    $translationModel = $record->translations()
                                                        ->where('locale', $locale)
                                                        ->first();

                                                    // Si on a une traduction, utiliser son titre
                                                    if ($translationModel && ! empty($translationModel->title)) {
                                                        return $translationModel->title;
                                                    }

                                                    // Sinon, utiliser le titre par défaut si c'est la langue par défaut
                                                    if ($locale === $record->default_locale) {
                                                        return $record->title;
                                                    }

                                                    return 'Non traduit';
                                                }),

                                            TextEntry::make('slug')
                                                ->label('Slug')
                                                ->state(function (Article $record) use ($locale) {
                                                    // Récupérer la traduction pour cette langue
                                                    $translationModel = $record->translations()
                                                        ->where('locale', $locale)
                                                        ->first();

                                                    // Si on a une traduction, utiliser son slug
                                                    if ($translationModel && ! empty($translationModel->slug)) {
                                                        return $translationModel->slug;
                                                    }

                                                    // Sinon, utiliser le slug par défaut si c'est la langue par défaut
                                                    if ($locale === $record->default_locale) {
                                                        return $record->slug;
                                                    }

                                                    return 'Non traduit';
                                                }),

                                            TextEntry::make('excerpt')
                                                ->label('Extrait')
                                                ->state(function (Article $record) use ($locale) {
                                                    // Récupérer la traduction pour cette langue
                                                    $translationModel = $record->translations()
                                                        ->where('locale', $locale)
                                                        ->first();

                                                    // Si on a une traduction, utiliser son extrait
                                                    if ($translationModel && ! empty($translationModel->excerpt)) {
                                                        return $translationModel->excerpt;
                                                    }

                                                    // Sinon, utiliser l'extrait par défaut si c'est la langue par défaut
                                                    if ($locale === $record->default_locale) {
                                                        return $record->excerpt;
                                                    }

                                                    return 'Non traduit';
                                                }),

                                            TextEntry::make('content')
                                                ->label('Contenu')
                                                ->state(function (Article $record) use ($locale) {
                                                    // Récupérer la traduction pour cette langue
                                                    $translationModel = $record->translations()
                                                        ->where('locale', $locale)
                                                        ->first();

                                                    // Si on a une traduction, utiliser son contenu
                                                    if ($translationModel && ! empty($translationModel->content)) {
                                                        return $translationModel->content;
                                                    }

                                                    // Sinon, utiliser le contenu par défaut si c'est la langue par défaut
                                                    if ($locale === $record->default_locale) {
                                                        return $record->content;
                                                    }

                                                    return 'Non traduit';
                                                })
                                                ->html()
                                                ->columnSpanFull(),
                                        ]),
                                ]);
                        })->toArray(),
                    ]),

                Section::make('Médias et métadonnées')
                    ->schema([
                        ImageEntry::make('illustration')
                            ->label('Image d\'illustration')
                            ->defaultImageUrl('https://placehold.co/600x400?text=Article')
                            ->columnSpanFull(),

                        Grid::make(3)
                            ->schema([
                                TextEntry::make('tags')
                                    ->label('Tags')
                                    ->formatStateUsing(function ($state) {
                                        if (empty($state)) {
                                            return 'Aucun tag';
                                        }

                                        // S'assurer que $state est un tableau
                                        if (! is_array($state)) {
                                            // Tenter de décoder JSON si c'est une chaîne
                                            if (is_string($state)) {
                                                $state = json_decode($state, true) ?? [];
                                            } else {
                                                return 'Format de tags non valide';
                                            }
                                        }

                                        $tagsHtml = '';
                                        foreach ($state as $tag) {
                                            $tagsHtml .= "<span class='fi-badge fi-color-primary rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset me-1 mb-1 inline-block'>$tag</span>";
                                        }

                                        return new HtmlString($tagsHtml);
                                    }),

                                TextEntry::make('featured')
                                    ->label('Mis en avant')
                                    ->formatStateUsing(fn (bool $state): string => $state ? 'Oui' : 'Non')
                                    ->badge()
                                    ->color(fn (bool $state): string => $state ? 'warning' : 'gray'),

                                TextEntry::make('views')
                                    ->label('Nombre de vues')
                                    ->numeric(),

                                TextEntry::make('reading_time')
                                    ->label('Temps de lecture')
                                    ->formatStateUsing(fn ($state) => $state.' min'),
                            ]),
                    ]),

                Section::make('Informations système')
                    ->collapsed()
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('author.first_name')
                                    ->label('Auteur')
                                    ->formatStateUsing(fn (Article $record) => $record->author ? $record->author->first_name.' '.$record->author->last_name : 'Non assigné'),
                                TextEntry::make('created_at')
                                    ->label('Créé le')
                                    ->dateTime('d/m/Y H:i'),
                                TextEntry::make('updated_at')
                                    ->label('Dernière modification')
                                    ->dateTime('d/m/Y H:i'),
                                TextEntry::make('deleted_at')
                                    ->label('Supprimé le')
                                    ->dateTime('d/m/Y H:i')
                                    ->visible(fn (Article $record) => $record->deleted_at !== null),
                            ]),
                    ]),
            ]);
    }
}
