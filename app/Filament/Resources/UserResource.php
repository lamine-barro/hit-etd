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

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Résidents';

    protected static ?string $modelLabel = 'Résident';

    protected static ?string $pluralModelLabel = 'Résidents';

    protected static ?string $navigationGroup = 'Personnes';

    protected static ?int $navigationSort = 11;

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

                                Forms\Components\FileUpload::make('profile_picture')
                                    ->label('Photo de profil')
                                    ->image()
                                    ->directory('avatars/residents')
                                    ->visibility('public')
                                    ->columnSpanFull(),

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

                                Forms\Components\Textarea::make('needs')
                                    ->label('Besoins spécifiques')
                                    ->columnSpanFull()
                                    ->rows(3)
                                    ->placeholder('Décrivez les besoins spécifiques du résident...'),

                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('profile_picture')
                    ->label('Photo')
                    ->circular()
                    ->defaultImageUrl(fn ($record) => $record ? 'https://ui-avatars.com/api/?name=' . urlencode($record->name) . '&color=ea580c&background=fed7aa' : '')
                    ->size(50),

                Tables\Columns\TextColumn::make('name')
                    ->label('Résident')
                    ->description(fn ($record) => $record ? $record->email : '')
                    ->searchable(['name', 'email'])
                    ->sortable()
                    ->weight('medium'),

                Tables\Columns\TextColumn::make('phone')
                    ->label('Téléphone')
                    ->icon('heroicon-o-phone')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Numéro copié'),

                Tables\Columns\TextColumn::make('category')
                    ->label('Type')
                    ->badge()
                    ->color(fn ($state) => match($state) {
                        'startup' => 'success',
                        'professionnel' => 'info', 
                        'gestionnaire' => 'warning',
                        'structure_accompagnement' => 'primary',
                        default => 'gray'
                    })
                    ->formatStateUsing(fn ($state) => \App\Models\User::CATEGORIES[$state] ?? $state),

                Tables\Columns\TextColumn::make('account_status')
                    ->label('Statut')
                    ->badge()
                    ->getStateUsing(function ($record) {
                        if (!$record) return 'Inconnu';
                        if ($record->is_request) {
                            return 'En attente';
                        } elseif (!$record->is_active) {
                            return 'Inactif';
                        } else {
                            return 'Actif';
                        }
                    })
                    ->color(function ($record) {
                        if (!$record) return 'gray';
                        if ($record->is_request) {
                            return 'warning';
                        } elseif (!$record->is_active) {
                            return 'danger';
                        } else {
                            return 'success';
                        }
                    })
                    ->icon(function ($record) {
                        if (!$record) return 'heroicon-o-exclamation-triangle';
                        if ($record->is_request) {
                            return 'heroicon-o-clock';
                        } elseif (!$record->is_active) {
                            return 'heroicon-o-x-circle';
                        } else {
                            return 'heroicon-o-check-circle';
                        }
                    })
                    ->tooltip(function ($record) {
                        if (!$record) return 'Statut inconnu';
                        if ($record->is_request) {
                            return 'Candidature en attente de validation';
                        } elseif (!$record->is_active) {
                            return 'Compte désactivé';
                        } else {
                            return 'Résident actif et validé';
                        }
                    }),



                Tables\Columns\TextColumn::make('created_at')
                    ->label('Inscription')
                    ->dateTime('d/m/Y')
                    ->description(fn ($record) => $record ? $record->created_at->diffForHumans() : '')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('needs')
                    ->label('Besoins')
                    ->limit(30)
                    ->tooltip(fn ($record) => $record ? $record->needs : '')
                    ->placeholder('Aucun besoin spécifié')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Activer/Désactiver')
                    ->visible(fn ($record) => $record && !$record->is_request)
                    ->afterStateUpdated(function ($record, $state) {
                        if ($record && $record->is_active && $record->is_request) {
                            $record->is_request = false;
                            $record->save();
                            $record->notify(new \App\Notifications\WelcomeResidentNotification());
                        }
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('is_request')
                    ->label('Statut de candidature')
                    ->options([
                        '1' => '⏳ Candidatures en attente',
                        '0' => '✅ Résidents validés',
                    ])
                    ->placeholder('Tous les statuts'),
                
                Tables\Filters\SelectFilter::make('category')
                    ->label('Type de résident')
                    ->options(\App\Models\User::CATEGORIES)
                    ->placeholder('Tous les types'),

                Tables\Filters\SelectFilter::make('is_active')
                    ->label('État du compte')
                    ->options([
                        '1' => '🟢 Comptes actifs',
                        '0' => '🔴 Comptes inactifs',
                    ])
                    ->placeholder('Tous les états'),


            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Modifier'),

                Tables\Actions\Action::make('approve')
                    ->label('Valider')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn ($record) => $record && $record->is_request && !$record->is_active)
                    ->action(function ($record) {
                        if ($record) {
                            $record->update([
                                'is_active' => true,
                                'is_request' => false,
                            ]);
                            $record->notify(new \App\Notifications\WelcomeResidentNotification());
                        }
                    }),

                Tables\Actions\Action::make('reject')
                    ->label('Rejeter')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->visible(fn ($record) => $record && $record->is_request)
                    ->action(function ($record) {
                        if ($record) {
                            $record->delete();
                            // Ici on pourrait envoyer une notification de rejet si besoin
                        }
                    }),

                Tables\Actions\DeleteAction::make()
                    ->requiresConfirmation()
                    ->label('Supprimer')
                    ->visible(fn ($record) => $record && !$record->is_request)
                    ->action(function ($record) {
                        if ($record) {
                            $record->delete();
                            $record->notify(new \App\Notifications\ResidentAccountArchiveNotification);
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('validate_residents')
                        ->label('Valider les candidatures sélectionnées')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->modalHeading('Valider les candidatures')
                        ->modalDescription('Êtes-vous sûr de vouloir valider ces candidatures ? Les résidents recevront un email de bienvenue.')
                        ->action(function ($records) {
                            foreach ($records as $record) {
                                if ($record && $record->is_request) {
                                    $record->update([
                                        'is_active' => true,
                                        'is_request' => false,
                                    ]);
                                    $record->notify(new \App\Notifications\WelcomeResidentNotification());
                                }
                            }
                        })
                        ->visible(fn ($records) => $records && $records->contains('is_request', true))
                        ->deselectRecordsAfterCompletion(),

                    Tables\Actions\BulkAction::make('deactivate_residents')
                        ->label('Désactiver les comptes sélectionnés')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->action(function ($records) {
                            foreach ($records as $record) {
                                if ($record && !$record->is_request) {
                                    $record->update(['is_active' => false]);
                                }
                            }
                        })
                        ->visible(fn ($records) => $records && $records->contains('is_request', false))
                        ->deselectRecordsAfterCompletion(),
                ]),
            ])
            ->recordUrl(null)
            ->striped()
            ->paginated([10, 25, 50, 100]);
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

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('is_request', true)->count() ?: null;
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        $count = static::getModel()::where('is_request', true)->count();
        return $count > 0 ? 'warning' : null;
    }

    public static function getRelations(): array
    {
        return [
            // OrdersRelationManager::class,
        ];
    }
}
