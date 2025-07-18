<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdministratorResource\Pages;
use App\Models\Administrator;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class AdministratorResource extends Resource
{
    protected static ?string $model = Administrator::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?string $navigationLabel = 'Administrateurs';

    protected static ?string $modelLabel = 'Administrateur';

    protected static ?string $pluralModelLabel = 'Administrateurs';

    protected static ?string $navigationGroup = 'Personnes';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    protected static ?int $navigationSort = 13;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informations personnelles')
                    ->schema([
                        Forms\Components\TextInput::make('first_name')
                            ->label('Prénom')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('last_name')
                            ->label('Nom')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone_number')
                            ->label('Numéro de téléphone')
                            ->tel()
                            ->maxLength(255),
                        Forms\Components\FileUpload::make('avatar_url')
                            ->label('Photo de profil')
                            ->image()
                            ->directory('avatars/administrators')
                            ->visibility('public'),
                    ])->columns(2),

                Forms\Components\Section::make('Informations système')
                    ->schema([
                        Forms\Components\DateTimePicker::make('email_verified_at')
                            ->label('Email vérifié le')
                            ->hidden(fn (string $operation): bool => $operation === 'create'),
                        Forms\Components\DateTimePicker::make('last_login_at')
                            ->label('Dernière connexion')
                            ->disabled()
                            ->hidden(fn (string $operation): bool => $operation === 'create'),
                        Forms\Components\TextInput::make('login_ip')
                            ->label('Dernière IP de connexion')
                            ->disabled()
                            ->hidden(fn (string $operation): bool => $operation === 'create'),
                    ])->columns(3)
                    ->collapsible(),

                Forms\Components\Section::make('Métadonnées')
                    ->schema([
                        Forms\Components\Select::make('created_by')
                            ->label('Créé par')
                            ->relationship('author', 'first_name')
                            ->disabled()
                            ->hidden(fn (string $operation): bool => $operation === 'create'),
                    ])
                    ->hidden(fn (string $operation): bool => $operation === 'create')
                    ->collapsible(),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('avatar_url')
                    ->label('Photo')
                    ->circular()
                    ->defaultImageUrl(fn () => 'https://ui-avatars.com/api/?name=Admin&color=ea580c&background=fed7aa'),

                Tables\Columns\TextColumn::make('full_name')
                    ->label('Admin')
                    ->description(fn ($record) => $record ? $record->email : '')
                    ->searchable(['first_name', 'last_name', 'email'])
                    ->sortable()
                    ->weight('medium'),

                Tables\Columns\TextColumn::make('phone_number')
                    ->label('Téléphone')
                    ->icon('heroicon-o-phone')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Téléphone copié')
                    ->placeholder('Non renseigné'),

                Tables\Columns\TextColumn::make('last_login_at')
                    ->label('Connexion')
                    ->dateTime('d/m/Y')
                    ->description(fn ($record) => $record && $record->last_login_at ? $record->last_login_at->diffForHumans() : 'Jamais connecté')
                    ->placeholder('Jamais connecté')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Création')
                    ->dateTime('d/m/Y')
                    ->description(fn ($record) => $record ? $record->created_at->diffForHumans() : '')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('created_by')
                    ->label('Créé par')
                    ->formatStateUsing(function ($state, $record) {
                        if (!$record || !$record->author) {
                            return 'Système';
                        }
                        return $record->author->first_name . ' ' . $record->author->last_name;
                    })
                    ->placeholder('Système')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                
                Tables\Filters\TernaryFilter::make('email_verified_at')
                    ->label('Email vérifié')
                    ->placeholder('Tous')
                    ->trueLabel('✅ Emails vérifiés')
                    ->falseLabel('❌ Emails non vérifiés')
                    ->nullable(),

                Tables\Filters\Filter::make('recent_login')
                    ->label('Connecté récemment (30 jours)')
                    ->query(fn ($query) => $query->where('last_login_at', '>=', now()->subDays(30)))
                    ->toggle(),

                Tables\Filters\Filter::make('never_logged_in')
                    ->label('Jamais connecté')
                    ->query(fn ($query) => $query->whereNull('last_login_at'))
                    ->toggle(),
            ])
            ->defaultSort('last_login_at', 'desc')
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('verify_emails')
                        ->label('Marquer emails comme vérifiés')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(function ($records) {
                            foreach ($records as $record) {
                                if ($record && !$record->email_verified_at) {
                                    $record->update(['email_verified_at' => now()]);
                                }
                            }
                        })
                        ->visible(fn ($records) => $records && $records->contains(fn ($r) => !$r->email_verified_at))
                        ->deselectRecordsAfterCompletion(),

                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                ]),
            ])
            ->striped()
            ->paginated([10, 25, 50]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageAdministrators::route('/'),
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
