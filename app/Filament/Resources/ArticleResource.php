<?php

namespace App\Filament\Resources;

use App\Enums\ArticleCategory;
use App\Enums\ArticleStatus;
use App\Enums\LanguageEnum;
use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Models\Article;
use App\Models\ArticleTranslation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    
    protected static ?string $navigationLabel = 'Articles';
    
    protected static ?string $modelLabel = 'Article';
    
    protected static ?string $pluralModelLabel = 'Articles';
    
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        // Langues disponibles
        $availableLocales = LanguageEnum::toArray();
        $currentLocale = App::getLocale();
        
        return $form
            ->columns(1)
            ->schema([
                Forms\Components\Tabs::make('Langues')
                    ->tabs([
                        // Onglet principal pour les informations générales (non traduites)
                        Forms\Components\Tabs\Tab::make('Informations générales')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                            Forms\Components\Grid::make(2)
                                ->schema([
                                        Forms\Components\Select::make('default_locale')
                                            ->label('Langue principale')
                                            ->options($availableLocales)
                                            ->default(LanguageEnum::FRENCH->value)
                                            ->required()
                                            ->reactive(),
                                            
                                        Forms\Components\Select::make('category')
                                            ->label('Catégorie')
                                            ->options(function () {
                                                $locale = App::getLocale();
                                                $categories = [];
                                                
                                                foreach (ArticleCategory::cases() as $category) {
                                                    $categories[$category->value] = $category->getTranslatedLabel($locale);
                                                }
                                                
                                                return $categories;
                                            })
                                            ->required()
                                            ->enum(ArticleCategory::class)
                                            ->searchable()
                                            ->native(false)
                                            ->prefixIcon('heroicon-o-tag'),
                                            
                                        Forms\Components\TextInput::make('title')
                                            ->label('Titre (langue par défaut)')
                                            ->required()
                                            ->maxLength(255)
                                            ->columnSpanFull(),
                                        
                                    Forms\Components\Select::make('author_id')
                                        ->label('Auteur')
                                        ->relationship('author', 'first_name', fn (Builder $query) => $query->orderBy('first_name'))
                                        ->getOptionLabelFromRecordUsing(fn ($record) => $record->first_name . ' ' . $record->last_name)
                                        ->searchable()
                                        ->hidden()
                                        ->visibleOn('create')
                                        ->required(),
                                        
                                    Forms\Components\Select::make('status')
                                        ->label('Statut')
                                        ->required()
                                        ->options(ArticleStatus::options())
                                        ->enum(ArticleStatus::class)
                                        ->default(ArticleStatus::DRAFT)
                                        ->native(false)
                                        ->prefixIcon('heroicon-o-document-check')
                                        ->columnSpanFull()
                                        ->live(),
                                    ]),
                            ]),
                            
                        // Onglets pour chaque langue disponible
                        ...collect($availableLocales)->map(function ($label, $locale) {
                            return Forms\Components\Tabs\Tab::make($label)
                                ->icon('heroicon-o-language')
                                ->schema([
                                    Forms\Components\Hidden::make('translations.' . $locale . '.locale')
                                        ->default($locale),
                                        
                                    Forms\Components\Section::make('Contenu en ' . $label)
                                        ->schema([
                                            Forms\Components\TextInput::make('translations.' . $locale . '.title')
                                                ->label('Titre')
                                                ->required(fn (callable $get) => $get('default_locale') === $locale)
                                                ->maxLength(255),
                                                
                                            Forms\Components\Textarea::make('translations.' . $locale . '.excerpt')
                                                ->label('Extrait')
                                                ->helperText('Un résumé court et accrocheur de l\'article (important pour le SEO)')
                                                ->rows(3)
                                                ->required(fn (callable $get) => $get('default_locale') === $locale),
                                                
                                            Forms\Components\RichEditor::make('translations.' . $locale . '.content')
                                                ->label('Contenu')
                                                ->required(fn (callable $get) => $get('default_locale') === $locale)
                                                ->fileAttachmentsDisk('public')
                                                ->fileAttachmentsDirectory('articles')
                                                ->fileAttachmentsVisibility('public')
                                                ->helperText('Utilisez les outils de mise en forme pour structurer votre contenu'),
                                                
                                            Forms\Components\Toggle::make('show_seo_' . $locale)
                                                ->label('Afficher les options SEO')
                                                ->default(false)
                                                ->live()
                                                ->helperText('Activez cette option pour configurer les paramètres SEO spécifiques'),
                                                
                                            Forms\Components\Grid::make(2)
                                                ->schema([
                                                    Forms\Components\TextInput::make('translations.' . $locale . '.meta_title')
                                                        ->label('Titre SEO')
                                                        ->helperText('Laissez vide pour utiliser le titre de l\'article'),
                                                        
                                                    Forms\Components\Textarea::make('translations.' . $locale . '.meta_description')
                                                        ->label('Description SEO')
                                                        ->helperText('Laissez vide pour utiliser l\'extrait de l\'article')
                                                        ->rows(2),
                                                    
                                                    Forms\Components\TextInput::make('translations.' . $locale . '.meta_keywords')
                                                        ->label('Mots-clés SEO')
                                                        ->placeholder('mot-clé1, mot-clé2, mot-clé3')
                                                        ->helperText('Séparés par des virgules (important pour le référencement)'),
                                                        
                                                    Forms\Components\Select::make('translations.' . $locale . '.og_type')
                                                        ->label('Type Open Graph')
                                                        ->options([
                                                            'article' => 'Article',
                                                            'website' => 'Site web',
                                                            'blog' => 'Blog'
                                                        ])
                                                        ->default('article')
                                                        ->helperText('Type de contenu pour les réseaux sociaux')
                                                ])
                                                ->columns(2)
                                                ->visible(fn (callable $get) => $get('show_seo_' . $locale))
                                                ->columnSpanFull()
                                        ])
                                ])
                                ->visible(fn (callable $get) => $get('default_locale') === $locale || static::shouldShowTranslation($locale));
                        })->toArray()
                    ]),
                    
                    Forms\Components\Section::make('Médias et métadonnées')
                        ->schema([


                            Forms\Components\FileUpload::make('illustration')
                                ->label('Image d\'illustration')
                                ->helperText('Recommandé : 1200x630px pour un affichage optimal sur les réseaux sociaux')
                                ->image()
                                ->disk('public')
                                ->directory('articles/illustrations')
                                ->visibility('public')
                                ->imagePreviewHeight('250')
                                ->panelAspectRatio('16:9')
                                ->panelLayout('integrated')
                                ->columnSpanFull(),
                                
                            Forms\Components\TagsInput::make('tags')
                                ->label('Tags')
                                ->helperText('Séparez les tags par des points-virgules')
                                ->separator(';')
                                ->columnSpanFull()
                                ->afterStateHydrated(function (Forms\Components\TagsInput $component, $state) {
                                    if (is_string($state)) {
                                        $component->state(json_decode($state, true) ?? []);
                                    }
                                })
                                ->dehydrateStateUsing(fn (array $state) => json_encode($state)),
                            Forms\Components\Grid::make(2)
                                ->schema([
                                    Forms\Components\Toggle::make('featured')
                                        ->label('Mettre en avant')
                                        ->helperText('Les articles mis en avant apparaîtront sur la page d\'accueil')
                                        ->default(false),
                                ]),
                        ]),
                    ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('illustration')
                    ->label('Image')
                    ->circular(false)
                    ->defaultImageUrl(fn (Article $record): string => $record->illustration ?? 'https://placehold.co/600x400?text=Article')
                    ->square(),
                    
                Tables\Columns\TextColumn::make('title')
                    ->label('Titre')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                    
                Tables\Columns\TextColumn::make('category')
                    ->label('Catégorie')
                    ->formatStateUsing(fn (ArticleCategory $state): string => $state->label())
                    ->badge()
                    ->icon(fn (ArticleCategory $state): string => $state->icon())
                    ->color(fn (ArticleCategory $state): string => $state->color())
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('author.first_name')
                    ->label('Auteur')
                    ->formatStateUsing(fn (Article $record) => $record->author ? $record->author->first_name . ' ' . $record->author->last_name : 'Non assigné')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                Tables\Columns\IconColumn::make('featured')
                    ->label('En avant')
                    ->boolean()
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('heroicon-o-star')
                    ->trueColor('warning')
                    ->falseColor('gray')
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                Tables\Columns\TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->formatStateUsing(fn (ArticleStatus $state): string => $state->label())
                    ->icon(fn (ArticleStatus $state): string => $state->icon())
                    ->color(fn (ArticleStatus $state): string => $state->color())
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Date de publication')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                Tables\Columns\TextColumn::make('views')
                    ->label('Vues')
                    ->numeric()
                    ->sortable()
                    ->alignCenter(),
                    
                Tables\Columns\TextColumn::make('reading_time')
                    ->label('Lecture')
                    ->formatStateUsing(fn (Article $record) => $record->reading_time . ' min')
                    ->numeric()
                    ->sortable()
                    ->alignCenter()
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Modifié le')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                Tables\Columns\TextColumn::make('deleted_at')
                    ->label('Supprimé le')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make()
                    ->label('Articles supprimés')
                    ->trueLabel('Afficher uniquement les articles supprimés')
                    ->falseLabel('Masquer les articles supprimés')
                    ->placeholder('Tous les articles'),
                    
                Tables\Filters\SelectFilter::make('status')
                    ->label('Statut')
                    ->options(ArticleStatus::options())
                    ->multiple(),
                    
                Tables\Filters\SelectFilter::make('category')
                    ->label('Catégorie')
                    ->options(ArticleCategory::options())
                    ->multiple()
                    ->searchable(),
                    
                Tables\Filters\SelectFilter::make('author_id')
                    ->label('Auteur')
                    ->relationship('author', 'first_name', fn (Builder $query) => $query->orderBy('first_name'))
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->first_name . ' ' . $record->last_name)
                    ->searchable()
                    ->preload(),
                    
                Tables\Filters\Filter::make('featured')
                    ->label('Articles mis en avant')
                    ->query(fn (Builder $query): Builder => $query->where('featured', true))
                    ->toggle(),
                    
                Tables\Filters\Filter::make('published_at')
                    ->label('Publiés récemment')
                    ->query(fn (Builder $query): Builder => $query->where('published_at', '>=', now()->subDays(30)))
                    ->toggle(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->url(fn (Article $record) => route('filament.admin.resources.articles.view', $record->id))
                        ->label('Voir'),
                    Tables\Actions\EditAction::make()
                        ->label('Modifier'),
                    Tables\Actions\Action::make('publish')
                        ->label('Publier')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->visible(fn (Article $record) => $record->status === ArticleStatus::DRAFT)
                        ->action(function (Article $record) {
                            $record->status = ArticleStatus::PUBLISHED;
                            $record->published_at = $record->published_at ?? now();
                            $record->save();
                        }),
                    Tables\Actions\Action::make('unpublish')
                        ->label('Dépublier')
                        ->icon('heroicon-o-arrow-uturn-left')
                        ->color('gray')
                        ->visible(fn (Article $record) => $record->status === ArticleStatus::PUBLISHED)
                        ->action(function (Article $record) {
                            $record->status = ArticleStatus::DRAFT;
                            $record->save();
                        }),
                    Tables\Actions\Action::make('duplicate')
                        ->label('Dupliquer')
                        ->icon('heroicon-o-document-duplicate')
                        ->color('info')
                        ->action(function (Article $record) {
                            $duplicate = $record->replicate();
                            $duplicate->title = 'Copie de ' . $record->title;
                            $duplicate->slug = Str::slug($duplicate->title);
                            $duplicate->status = 'draft';
                            $duplicate->views = 0;
                            $duplicate->published_at = null;
                            $duplicate->save();
                            
                            return redirect(ArticleResource::getUrl('edit', ['record' => $duplicate]));
                        }),
                    Tables\Actions\DeleteAction::make()
                        ->label('Supprimer'),
                    Tables\Actions\RestoreAction::make()
                        ->label('Restaurer'),
                    Tables\Actions\ForceDeleteAction::make()
                        ->label('Supprimer définitivement'),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'view' => Pages\ViewArticle::route('/{record}'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
    
    /**
     * Détermine si une traduction doit être affichée dans le formulaire.
     *
     * @param string $locale
     * @return bool
     */
    protected static function shouldShowTranslation(string $locale): bool
    {
        // Par défaut, on affiche toutes les traductions
        // Vous pouvez personnaliser cette logique selon vos besoins
        return true;
    }
    
    /**
     * Gère l'enregistrement des données du formulaire, y compris les traductions.
     *
     * @param array $data
     * @param Article $record
     * @return void
     */
    public static function mutateFormDataBeforeCreate(array $data): array
    {
        // Extraire les données de traduction du formulaire
        $translations = $data['translations'] ?? [];
        unset($data['translations']);
        
        // Stocker les traductions dans une propriété temporaire pour les récupérer après la création
        static::$pendingTranslations = $translations;
        
        return $data;
    }
    
    /**
     * Gère l'enregistrement des traductions après la création de l'article.
     *
     * @param Article $record
     * @param array $data
     * @return void
     */
    public static function afterCreate(Article $record, array $data): void
    {
        // Récupérer les traductions temporaires
        $translations = static::$pendingTranslations ?? [];
        
        // Enregistrer chaque traduction
        foreach ($translations as $locale => $translationData) {
            if (!empty($translationData) && isset($translationData['locale'])) {
                $record->translations()->updateOrCreate(
                    ['locale' => $locale],
                    $translationData
                );
            }
        }
    }
    
    /**
     * Gère la mise à jour des données du formulaire, y compris les traductions.
     *
     * @param array $data
     * @return array
     */
    public static function mutateFormDataBeforeSave(array $data): array
    {
        // Extraire les données de traduction du formulaire
        $translations = $data['translations'] ?? [];
        unset($data['translations']);
        
        // Stocker les traductions dans une propriété temporaire pour les récupérer après la sauvegarde
        static::$pendingTranslations = $translations;
        
        return $data;
    }
    
    /**
     * Gère l'enregistrement des traductions après la mise à jour de l'article.
     *
     * @param Article $record
     * @param array $data
     * @return void
     */
    public static function afterSave(Article $record, array $data): void
    {
        // Récupérer les traductions temporaires
        $translations = static::$pendingTranslations ?? [];
        
        // Enregistrer chaque traduction
        foreach ($translations as $locale => $translationData) {
            if (!empty($translationData) && isset($translationData['locale'])) {
                $record->translations()->updateOrCreate(
                    ['locale' => $locale],
                    $translationData
                );
            }
        }
    }
    
    /**
     * Propriété statique pour stocker temporairement les traductions pendant le processus de sauvegarde.
     *
     * @var array
     */
    protected static $pendingTranslations = [];
}
