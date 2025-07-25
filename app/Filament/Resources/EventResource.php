<?php

namespace App\Filament\Resources;

use App\Enums\Currency;
use App\Enums\EventStatus;
use App\Enums\EventType;
use App\Enums\LanguageEnum;
use App\Filament\Resources\EventResource\Pages;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\App;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    protected static ?string $navigationLabel = 'Événements';

    protected static ?string $modelLabel = 'Événement';

    protected static ?string $pluralModelLabel = 'Événements';

    protected static ?string $navigationGroup = 'Événements';

    protected static ?int $navigationSort = 3;

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

                                        Forms\Components\Select::make('type')
                                            ->label('Type d\'événement')
                                            ->options(array_combine(EventType::values(), array_map(fn ($type) => EventType::from($type)->label(), EventType::values())))
                                            ->required(),

                                        // Le champ title a été supprimé car il est maintenant géré par les traductions

                                        Forms\Components\Select::make('status')
                                            ->label('Statut')
                                            ->options(array_combine(EventStatus::values(), array_map(fn ($status) => EventStatus::from($status)->label(), EventStatus::values())))
                                            ->default(EventStatus::DRAFT->value)
                                            ->columnSpanFull()
                                            ->required(),

                                        Forms\Components\Hidden::make('created_by')
                                            ->default(fn () => auth('admin')->id()) // Utilise automatiquement l'ID de l'utilisateur connecté
                                            ->dehydrated(true) // Assure que la valeur est envoyée au serveur
                                            ->required(),

                                        Forms\Components\FileUpload::make('illustration')
                                            ->label('Image d\'illustration')
                                            ->helperText('Recommandé : 1200x630px pour un affichage optimal sur les réseaux sociaux')
                                            ->image()
                                            ->imagePreviewHeight('250')
                                            ->imageEditor()
                                            ->panelLayout('integrated')
                                            ->imageEditorAspectRatios([
                                                '16:9',
                                            ])
                                            ->columnSpanFull(),
                                    ]),
                            ]),

                        // Onglets pour chaque langue disponible
                        ...collect($availableLocales)->map(function ($label, $locale) {
                            return Forms\Components\Tabs\Tab::make($label)
                                ->icon('heroicon-o-language')
                                ->schema([

                                    Forms\Components\Section::make('Contenu en '.$label)
                                        ->schema([
                                            Forms\Components\TextInput::make('translations.'.$locale.'.title')
                                                ->label('Titre')
                                                ->required(fn (callable $get) => $get('default_locale') === $locale)
                                                ->maxLength(255),

                                            Forms\Components\TextInput::make('translations.'.$locale.'.location')
                                                ->label('Lieu')
                                                ->required(fn (callable $get) => $get('default_locale') === $locale)
                                                ->maxLength(255),

                                            Forms\Components\RichEditor::make('translations.'.$locale.'.description')
                                                ->label('Description')
                                                ->required(fn (callable $get) => $get('default_locale') === $locale)
                                                ->fileAttachmentsDisk('public')
                                                ->fileAttachmentsDirectory('events')
                                                ->fileAttachmentsVisibility('public')
                                                ->helperText('Utilisez les outils de mise en forme pour structurer votre contenu')
                                                ->columnSpanFull(),

                                            Forms\Components\Toggle::make('show_seo_'.$locale)
                                                ->label('Afficher les options SEO')
                                                ->default(false)
                                                ->live()
                                                ->helperText('Activez cette option pour configurer les paramètres SEO spécifiques'),

                                            Forms\Components\Grid::make(2)
                                                ->schema([
                                                    Forms\Components\TextInput::make('translations.'.$locale.'.meta_title')
                                                        ->label('Titre SEO')
                                                        ->helperText('Laissez vide pour utiliser le titre de l\'événement'),

                                                    Forms\Components\Textarea::make('translations.'.$locale.'.meta_description')
                                                        ->label('Description SEO')
                                                        ->helperText('Laissez vide pour utiliser la description de l\'événement')
                                                        ->rows(2),

                                                    Forms\Components\TextInput::make('translations.'.$locale.'.meta_keywords')
                                                        ->label('Mots-clés SEO')
                                                        ->placeholder('mot-clé1, mot-clé2, mot-clé3')
                                                        ->helperText('Séparés par des virgules (important pour le référencement)'),

                                                    Forms\Components\Select::make('translations.'.$locale.'.og_type')
                                                        ->label('Type Open Graph')
                                                        ->options([
                                                            'event' => 'Événement',
                                                            'website' => 'Site web',
                                                            'article' => 'Article',
                                                        ])
                                                        ->default('event')
                                                        ->helperText('Type de contenu pour les réseaux sociaux'),
                                                ])
                                                ->columns(2)
                                                ->visible(fn (callable $get) => $get('show_seo_'.$locale))
                                                ->columnSpanFull(),
                                        ]),
                                ])
                                ->visible(fn (callable $get) => $get('default_locale') === $locale || static::shouldShowTranslation($locale));
                        })->toArray(),
                    ]),

                Forms\Components\Section::make('Dates et lieu')
                    ->schema([
                        Forms\Components\DateTimePicker::make('start_date')
                            ->label('Date de début')
                            ->required(),
                        Forms\Components\DateTimePicker::make('end_date')
                            ->label('Date de fin')
                            ->after('start_date'),
                        // Le champ location a été supprimé car il est maintenant géré par les traductions
                        Forms\Components\Toggle::make('is_remote')
                            ->label('En ligne')
                            ->helperText('Cochez si l\'événement se déroule en ligne')
                            ->default(false),
                        Forms\Components\TextInput::make('external_link')
                            ->label('Lien externe')
                            ->url()
                            ->maxLength(255)
                            ->visible(fn (Get $get): bool => $get('is_remote')),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Inscriptions')
                    ->schema([
                        Forms\Components\TextInput::make('max_participants')
                            ->label('Nombre maximum de participants')
                            ->required()
                            ->numeric()
                            ->minValue(1),
                        Forms\Components\DateTimePicker::make('registration_end_date')
                            ->label('Date limite d\'inscription')
                            ->required()
                            ->before('start_date'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Tarification')
                    ->schema([
                        Forms\Components\Toggle::make('is_paid')
                            ->label('Événement payant')
                            ->default(false)
                            ->live(),
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('price')
                                    ->label('Prix')
                                    ->numeric()
                                    ->minValue(0)
                                    ->required(fn (Get $get): bool => $get('is_paid'))
                                    ->visible(fn (Get $get): bool => $get('is_paid')),
                                Forms\Components\Select::make('currency')
                                    ->label('Devise')
                                    ->options(array_combine(Currency::values(), array_map(fn ($currency) => Currency::from($currency)->label().' ('.Currency::from($currency)->symbol().')', Currency::values())))
                                    ->default(Currency::XOF->value)
                                    ->required()
                                    ->visible(fn (Get $get): bool => $get('is_paid')),
                            ]),
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('early_bird_price')
                                    ->label('Prix early bird')
                                    ->helperText('Prix réduit pour les inscriptions anticipées')
                                    ->numeric()
                                    ->minValue(0)
                                    ->visible(fn (Get $get): bool => $get('is_paid')),
                                Forms\Components\DateTimePicker::make('early_bird_end_date')
                                    ->label('Date limite early bird')
                                    ->before('start_date')
                                    ->visible(fn (Get $get): bool => $get('is_paid') && $get('early_bird_price')),
                            ]),
                    ]),

                Forms\Components\Hidden::make('created_by')
                    ->dehydrateStateUsing(fn () => auth('admin')->user()->id ?? null)
                    ->default(fn () => auth('admin')->user()->id ?? null)
                    ->required()
                    ->visibleOn('create'),
            ]);
    }

    public static function table(Table $table): Table
    {
        $currentLocale = App::getLocale();

        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('illustration')
                    ->label('Image')
                    ->circular()
                    ->defaultImageUrl(fn () => asset('images/event-placeholder.jpg'))
                    ->width(50)
                    ->height(50),
                Tables\Columns\TextColumn::make('translations_title')
                    ->label('Titre')
                    ->state(function (Event $record) use ($currentLocale) {
                        // Récupérer directement la traduction depuis la relation
                        $translationModel = $record->translations()
                            ->where('locale', $currentLocale)
                            ->first();

                        // Si on a une traduction, utiliser son titre
                        if ($translationModel && ! empty($translationModel->title)) {
                            return $translationModel->title;
                        }

                        // Sinon, essayer de récupérer la traduction dans la langue par défaut
                        $defaultTranslation = $record->translations()
                            ->where('locale', $record->default_locale)
                            ->first();

                        if ($defaultTranslation && ! empty($defaultTranslation->title)) {
                            return $defaultTranslation->title;
                        }

                        // Si aucune traduction n'est trouvée, retourner un message
                        return '[Titre manquant]';
                    })
                    ->searchable()
                    ->sortable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('type')
                    ->label('Type')
                    ->formatStateUsing(fn (string $state): string => EventType::from($state)->label())
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        EventType::CONFERENCE->value => 'primary',
                        EventType::WORKSHOP->value => 'warning',
                        EventType::WEBINAR->value => 'info',
                        EventType::MEETUP->value => 'success',
                        EventType::TRAINING->value => 'danger',
                        EventType::HACKATHON->value => 'purple',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('start_date')
                    ->label('Date')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('translations_location')
                    ->label('Lieu')
                    ->state(function (Event $record) use ($currentLocale) {
                        // Récupérer directement la traduction depuis la relation
                        $translationModel = $record->translations()
                            ->where('locale', $currentLocale)
                            ->first();

                        // Si on a une traduction, utiliser son lieu
                        if ($translationModel && ! empty($translationModel->location)) {
                            return $translationModel->location;
                        }

                        // Sinon, essayer de récupérer la traduction dans la langue par défaut
                        $defaultTranslation = $record->translations()
                            ->where('locale', $record->default_locale)
                            ->first();

                        if ($defaultTranslation && ! empty($defaultTranslation->location)) {
                            return $defaultTranslation->location;
                        }

                        // Si aucune traduction n'est trouvée, retourner un message
                        return '[Lieu manquant]';
                    })
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\IconColumn::make('is_remote')
                    ->label('En ligne')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('max_participants')
                    ->label('Participants max')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('price')
                    ->label('Prix')
                    ->getStateUsing(function (Event $record): string {
                        if ($record->is_paid) {
                            return number_format($record->getCurrentPrice(), 0, ',', ' ').' '.Currency::from($record->currency)->symbol();
                        }

                        return 'Gratuit';
                    })
                    ->badge()
                    ->color(fn (Event $record): string => $record->is_paid ? 'warning' : 'success')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Statut')
                    ->formatStateUsing(fn (EventStatus $state): string => $state->label())
                    ->badge()
                    ->color(fn (EventStatus $state): string => match ($state) {
                        EventStatus::PUBLISHED => 'success',
                        EventStatus::DRAFT => 'gray',
                        EventStatus::CANCELLED => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('createdBy.first_name')
                    ->label('Créé par')
                    ->formatStateUsing(fn ($state, $record) => $record->createdBy ? $record->createdBy->first_name.' '.$record->createdBy->last_name : '-')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Mis à jour le')
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
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\SelectFilter::make('type')
                    ->label('Type d\'événement')
                    ->options(array_combine(EventType::values(), array_map(fn ($type) => EventType::from($type)->label(), EventType::values()))),
                Tables\Filters\SelectFilter::make('status')
                    ->label('Statut')
                    ->options(array_combine(EventStatus::values(), array_map(fn ($status) => EventStatus::from($status)->label(), EventStatus::values()))),
                Tables\Filters\Filter::make('is_paid')
                    ->label('Événements payants')
                    ->query(fn (Builder $query): Builder => $query->where('is_paid', true)),
                Tables\Filters\Filter::make('is_free')
                    ->label('Événements gratuits')
                    ->query(fn (Builder $query): Builder => $query->where('is_paid', false)),
                Tables\Filters\Filter::make('upcoming')
                    ->label('À venir')
                    ->query(fn (Builder $query): Builder => $query->where('start_date', '>=', now())),
                Tables\Filters\Filter::make('past')
                    ->label('Passés')
                    ->query(fn (Builder $query): Builder => $query->where('start_date', '<', now())),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->label('Supprimer'),
                Tables\Actions\ForceDeleteAction::make()
                    ->label('Supprimer définitivement'),
                Tables\Actions\RestoreAction::make()
                    ->label('Restaurer'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Supprimer la sélection'),
                    Tables\Actions\ForceDeleteBulkAction::make()
                        ->label('Supprimer définitivement la sélection'),
                    Tables\Actions\RestoreBulkAction::make()
                        ->label('Restaurer la sélection'),
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'view' => Pages\ViewEvent::route('/{record}'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->orderBy('created_at', 'desc')
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    /**
     * Détermine si une traduction doit être affichée dans le formulaire.
     *
     * @param  string  $locale  Code de la langue
     */
    public static function shouldShowTranslation(string $locale): bool
    {
        // Toujours afficher les traductions françaises et anglaises
        if (in_array($locale, [LanguageEnum::FRENCH->value, LanguageEnum::ENGLISH->value])) {
            return true;
        }

        // Pour les autres langues, on peut ajouter une logique spécifique si nécessaire
        return false;
    }

    /**
     * Badge de navigation indiquant le nombre d'événements
     */
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
