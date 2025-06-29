<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers\OrdersRelationManager;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Résidents';

    protected static ?string $modelLabel = 'Résident';

    protected static ?string $pluralModelLabel = 'Résidents';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Hub';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informations personnelles')
                    ->description('Informations de base de l\'utilisateur')
                    ->icon('heroicon-o-user')
                    ->schema([
                        Grid::make()
                            ->schema([
                                Forms\Components\Select::make('category')
                                    ->label('Categorie')
                                    ->required()
                                    ->options(User::CATEGORIES),

                                Forms\Components\TextInput::make('name')
                                    ->label('Nom Startup')
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('email')
                                    ->unique(ignoreRecord: true)
                                    ->label('Adresse email')
                                    ->email()
                                    ->required(),

                                Forms\Components\TextInput::make('phone')
                                    ->required()
                                    ->label('Téléphone')
                                    ->tel()
                                    ->maxLength(255),

                                Forms\Components\Checkbox::make('with_responsible')
                                    ->columnSpan(2)
                                    ->reactive()
                                    ->label('Informations du responsable'),

                                Forms\Components\TextInput::make('responsible_name')
                                    ->reactive()
                                    ->disabled(fn (Forms\Get $get) => ! $get('with_responsible'))
                                    ->label('Nom et prénom du responsable')
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('responsible_phone')
                                    ->reactive()
                                    ->disabled(fn (Forms\Get $get) => ! $get('with_responsible'))
                                    ->label('Numéro de téléphone du responsable')
                                    ->required()
                                    ->maxLength(255),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('phone')
                    ->label('Téléphone')
                    ->searchable(),

                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Actif')
                    ->afterStateUpdated(function ($record, $state) {
                        if ($record->is_active && $record->is_request && !$record->password) {
                            $password = uniqid();
                            $record->password = bcrypt($password);
                            $record->save();
                            $record->notify(new \App\Notifications\WelcomeResidentNotification($password));
                        }
                    }),

                Tables\Columns\IconColumn::make('email_verified_at')
                    ->label('Email vérifié')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Mis à jour le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Modifier'),

                Tables\Actions\DeleteAction::make()
                    ->requiresConfirmation()
                    ->label('Archiver')
                    ->action(function ($record) {
                        $record->delete();
                        $record->notify(new \App\Notifications\ResidentAccountArchiveNotification);
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make()
                    //     ->label('Supprimer la sélection'),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
            'create' => Pages\CreateUser::route('/create'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->orderBy('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            // OrdersRelationManager::class,
        ];
    }
}
