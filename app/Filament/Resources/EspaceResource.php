<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EspaceResource\Pages;
use App\Models\Espace;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EspaceResource extends Resource
{
    protected static ?string $model = Espace::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static ?string $navigationLabel = 'Espaces';

    protected static ?string $modelLabel = 'Espace';

    protected static ?string $pluralModelLabel = 'Espaces';

    protected static ?string $navigationGroup = 'Espaces';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informations générales')
                    ->description('Informations de base sur l\'espace')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nom de l\'espace')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('location')
                            ->label('Description')
                            ->helperText('Description détaillée de l\'espace')
                            ->maxLength(500)
                            ->rows(3)
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('code')
                            ->label('Code (unique)')
                            ->unique(Espace::class, 'code', fn ($record) => $record)
                            ->helperText('Un code unique pour identifier cet espace')
                            ->placeholder('ex: BUREAU-01')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Select::make('type')
                            ->label('Type d\'espace')
                            ->options(Espace::FR_TYPES)
                            ->required(),

                        Forms\Components\TextInput::make('price_per_hour')
                            ->label('Prix par heure (FCFA)')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(1000000)
                            ->required()
                            ->step(1000)
                            ->placeholder('Ex: 5000 (0 pour gratuit)')
                            ->helperText('Entrez 0 pour un espace gratuit'),

                        Forms\Components\TextInput::make('minimum_duration')
                            ->label('Durée minimale de location (en heures)')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(100)
                            ->default(1)
                            ->required(),

                        Forms\Components\Select::make('floor')
                            ->options(Espace::FR_FLOORS)
                            ->label('Étage'),

                        Forms\Components\TextInput::make('room_count')
                            ->label('Nombre de pièces')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(100)
                            ->default(1),
                    ]),

                Forms\Components\Section::make('Médias et métadonnées')
                    ->schema([
                        Forms\Components\FileUpload::make('illustration')
                            ->label('Image d\'illustration')
                            ->helperText('Recommandé : 1200x630px pour un affichage optimal')
                            ->image()
                            ->imagePreviewHeight('250')
                            ->panelAspectRatio('16:9')
                            ->imageEditor()
                            ->panelLayout('integrated')
                            ->imageEditorAspectRatios([
                                '4:3',
                                '16:9',
                            ])
                            ->directory('espaces')
                            ->visibility('public')
                            ->maxSize(5120)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp'])
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('images')
                            ->label('Images de l\'espace')
                            ->helperText('Uploadez jusqu\'à 5 images. Glissez-déposez pour réorganiser l\'ordre d\'affichage.')
                            ->multiple()
                            ->image()
                            ->maxFiles(5)
                            ->reorderable()
                            ->imagePreviewHeight('150')
                            ->panelAspectRatio('16:9')
                            ->imageEditor()
                            ->panelLayout('integrated')
                            ->directory('espaces')
                            ->visibility('public')
                            ->maxSize(5120)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp'])
                            ->columnSpanFull()
                            ->imageEditorAspectRatios([
                                '4:3',
                                '16:9',
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Code')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nom de l\'espace')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('type')
                    ->state(function (Espace $record) {
                        return Espace::FR_TYPES[$record->type] ?? $record->type;
                    })
                    ->label('Type')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('price_per_hour')
                    ->label('Prix/h')
                    ->money('XOF')
                    ->sortable(),

                Tables\Columns\TextColumn::make('floor')
                    ->label('Étage')
                    ->formatStateUsing(function ($state) {
                        return Espace::FR_FLOORS[$state] ?? $state;
                    })
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('room_count')
                    ->label('Pièces')
                    ->alignCenter()
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Statut')
                    ->color(fn (Espace $record) => match ($record->status) {
                        Espace::STATUS_AVAILABLE => 'success',
                        Espace::STATUS_UNAVAILABLE => 'danger',
                        Espace::STATUS_RESERVED => 'warning',
                        default => 'secondary',
                    })
                    ->icon(fn (Espace $record) => match ($record->status) {
                        Espace::STATUS_AVAILABLE => 'heroicon-o-check-circle',
                        Espace::STATUS_UNAVAILABLE => 'heroicon-o-x-circle',
                        Espace::STATUS_RESERVED => 'heroicon-o-clock',
                        default => 'heroicon-o-question-mark-circle',
                    })
                    ->searchable(),

                Tables\Columns\TextColumn::make('ended_at')
                    ->label('Disponibilité')
                    ->state(function (Espace $record) {
                        if (! $record->ended_at) {
                            return '-';
                        }
                        if ($record->ended_at->isPast()) {
                            return 'Précédente réservation terminée';
                        }

                        return $record->ended_at->diffForHumans(['syntax' => 'short']);
                    }),

                Tables\Columns\TextColumn::make('minimum_duration')
                    ->suffix(' heure(s)')
                    ->label('Durée minimale'),

                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Publier')
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime('d/m/Y H:i'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Modifier')
                    ->icon('heroicon-o-pencil'),

                Tables\Actions\ViewAction::make()
                    ->label('Voir')
                    ->icon('heroicon-o-eye'),

                Tables\Actions\DeleteAction::make()
                    ->label('Supprimer')
                    ->icon('heroicon-o-trash'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEspaces::route('/'),
            'create' => Pages\CreateEspace::route('/create'),
            'edit' => Pages\EditEspace::route('/{record}/edit'),
            'view' => Pages\ViewEspace::route('/{record}'),
        ];
    }
}
