<?php

namespace App\Filament\Resources;

use App\Enums\ArticleCategory;
use App\Enums\ArticleStatus;
use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
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
        return $form
            ->columns(1)
            ->schema([
                Forms\Components\Wizard::make([
                    Forms\Components\Wizard\Step::make('Informations générales')
                        ->icon('heroicon-o-information-circle')
                        ->description('Détails de base de l\'article')
                        ->schema([
                            Forms\Components\Grid::make(2)
                                ->schema([
                                    Forms\Components\TextInput::make('title')
                                        ->label('Titre')
                                        ->required()
                                        ->maxLength(255)
                                        ->columnSpanFull(),
                                    Forms\Components\Select::make('category')
                                        ->label('Catégorie')
                                        ->required()
                                        ->options(ArticleCategory::options())
                                        ->enum(ArticleCategory::class)
                                        ->searchable()
                                        ->native(false)
                                        ->prefixIcon('heroicon-o-tag'),
                                        
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
                                        ->live(),
                                ]),
                        ]),
                        
                    Forms\Components\Wizard\Step::make('Contenu')
                        ->icon('heroicon-o-document-text')
                        ->description('Rédaction de l\'article')
                        ->schema([
                            Forms\Components\Textarea::make('excerpt')
                                ->label('Extrait')
                                ->helperText('Un résumé court et accrocheur de l\'article (important pour le SEO)')
                                ->rows(3)
                                ->required()
                                ->columnSpanFull(),
                                
                            Forms\Components\RichEditor::make('content')
                                ->label('Contenu')
                                ->required()
                                ->columnSpanFull()
                                ->fileAttachmentsDisk('public')
                                ->fileAttachmentsDirectory('articles')
                                ->fileAttachmentsVisibility('public')
                                ->helperText('Utilisez les outils de mise en forme pour structurer votre contenu'),
                        ]),
                        
                    Forms\Components\Wizard\Step::make('Médias et métadonnées')
                        ->icon('heroicon-o-photo')
                        ->description('Images et informations complémentaires')
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
                ])
                ->skippable()
                ->persistStepInQueryString()
                ->submitAction(new HtmlString('<button type="submit" class="fi-btn fi-btn-primary fi-btn-size-md relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg fi-color-custom fi-btn-color-primary gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-primary-600 text-white hover:bg-primary-500 dark:bg-primary-500 dark:hover:bg-primary-400 focus-visible:ring-primary-500/50 dark:focus-visible:ring-primary-400/50 fi-ac-btn-action">Enregistrer l\'article</button>')),
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
}
