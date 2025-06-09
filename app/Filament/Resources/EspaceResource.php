<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EspaceResource\Pages;
use App\Filament\Resources\EspaceResource\RelationManagers\OrdersRelationManager;
use App\Models\Espace;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EspaceResource extends Resource
{
    protected static ?string $model = Espace::class;

    protected static ?string $navigationIcon = 'heroicon-c-arrows-pointing-in';

    protected static ?string $navigationLabel = 'Espaces';

    protected static ?string $modelLabel = 'Espace';

    protected static ?string $pluralModelLabel = 'Espaces';

    protected static ?string $navigationGroup = 'Résidents';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Infos espace')
                    ->description('Informations générales sur l\'espace')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label("Nom de l'espace")
                            ->required()
                            ->maxLength(255),

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

                        Forms\Components\TextInput::make('price')
                            ->label('Prix de location')
                            ->helperText('Prix par heure')
                            ->numeric()
                            ->required(),

                        Forms\Components\TextInput::make('minimum_duration')
                            ->label('Durée minimale de location (en heures)')
                            ->helperText('Durée minimale requise pour la location de cet espace')
                            ->numeric()
                            ->default(1)
                            ->required(),

                        Forms\Components\Select::make('floor')
                            ->options(Espace::FR_FLOORS)
                            ->label('Étage'),

                        Forms\Components\TextInput::make('location')
                            ->helperText('Emplacement de l\'espace dans le bâtiment')
                            ->label('Emplacement'),

                        Forms\Components\TextInput::make('number_of_rooms')
                            ->label('Nombre de pièces')
                            ->numeric()
                            ->default(0),
                    ]),

                Forms\Components\Section::make('Médias et métadonnées')
                    ->schema([
                        Forms\Components\FileUpload::make('illustration')
                            ->label('Image d\'illustration')
                            ->helperText('Recommandé : 1200x630px pour un affichage optimal sur les réseaux sociaux')
                            ->image()
                            ->imagePreviewHeight('250')
                            ->panelAspectRatio('16:9')
                            ->imageEditor()
                            ->panelLayout('integrated')
                            ->imageEditorAspectRatios([
                                '16:9',
                            ]),

                        Forms\Components\FileUpload::make('images')
                            ->label('Images supplémentaires')
                            ->multiple()
                            ->image()
                            ->imagePreviewHeight('120')
                            ->panelAspectRatio('16:9')
                            ->panelLayout('integrated')
                            ->imageEditor()
                            ->imageEditorAspectRatios([
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
                    ->searchable(),

                Tables\Columns\TextColumn::make('name')
                    ->label("Nom de l'espace")
                    ->searchable(),

                Tables\Columns\TextColumn::make('type')
                    ->state(function (Espace $record) {
                        return Espace::FR_TYPES[$record->type] ?? $record->type;
                    })
                    ->label('Type'),

                Tables\Columns\TextColumn::make('price')
                    ->label('Prix'),

                Tables\Columns\TextColumn::make('minimum_duration')
                    ->label('Durée minimale'),

                Tables\Columns\TextColumn::make('floor')
                    ->label('Étage'),

                Tables\Columns\TextColumn::make('location')
                    ->label('Emplacement'),

                Tables\Columns\TextColumn::make('number_of_rooms')
                    ->label('Nombre de pièces'),

                Tables\Columns\ImageColumn::make('illustration')
                    ->label('Illustration')
                    ->height(40),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime('d/m/Y H:i'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
            OrdersRelationManager::class,
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
