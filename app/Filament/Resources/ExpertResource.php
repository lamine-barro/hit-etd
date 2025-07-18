<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Expert;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ExpertResource\Pages;
use Filament\Forms;
use Illuminate\Support\Collection;

class ExpertResource extends Resource
{
    protected static ?string $model = Expert::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationGroup = 'Personnes';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'pending')->count();
    }

    protected static ?int $navigationSort = 12;

    protected static ?string $navigationLabel = 'Experts';

    protected static ?string $modelLabel = 'Expert';

    protected static ?string $pluralModelLabel = 'Experts';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informations personnelles')
                    ->schema([
                        Forms\Components\TextInput::make('full_name')
                            ->label('Nom et prénoms')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->maxLength(255),

                        Forms\Components\FileUpload::make('profile_picture')
                            ->label('Photo de profil')
                            ->image()
                            ->directory('avatars/experts')
                            ->visibility('public')
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('phone')
                            ->label('Téléphone')
                            ->tel()
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('organization')
                            ->label('Organisation')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('position')
                            ->label('Poste')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('linkedin')
                            ->label('LinkedIn')
                            ->url()
                            ->maxLength(255),
                    ])->columns(2),

                Forms\Components\Section::make('Compétences et formation')
                    ->schema([
                        Forms\Components\CheckboxList::make('specialties')
                            ->label('Spécialités')
                            ->options(Expert::SPECIALTIES)
                            ->columns(3),

                        Forms\Components\TextInput::make('specialty_other')
                            ->label('Autre spécialité')
                            ->maxLength(255),

                        Forms\Components\CheckboxList::make('training_types')
                            ->label('Types de formation')
                            ->options(Expert::TRAINING_TYPES)
                            ->columns(3),

                        Forms\Components\CheckboxList::make('pedagogical_methods')
                            ->label('Méthodes pédagogiques')
                            ->options(Expert::PEDAGOGICAL_METHODS)
                            ->columns(3),

                        Forms\Components\CheckboxList::make('target_audiences')
                            ->label('Public cible')
                            ->options(Expert::TARGET_AUDIENCES)
                            ->columns(2),

                        Forms\Components\CheckboxList::make('intervention_frequencies')
                            ->label('Fréquence d\'intervention')
                            ->options(Expert::INTERVENTION_FREQUENCIES)
                            ->columns(2),

                        Forms\Components\CheckboxList::make('preferred_days_detailed')
                            ->label('Jours préférés')
                            ->options(Expert::PREFERRED_DAYS)
                            ->columns(3),

                        Forms\Components\CheckboxList::make('time_slots')
                            ->label('Créneaux horaires')
                            ->options(Expert::TIME_SLOTS)
                            ->columns(3),
                    ]),

                Forms\Components\Section::make('Traitement')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->label('Statut')
                            ->options(Expert::STATUSES)
                            ->default('pending')
                            ->required(),

                        Forms\Components\Textarea::make('admin_notes')
                            ->label('Notes administratives')
                            ->rows(3),

                        Forms\Components\FileUpload::make('cv_path')
                            ->label('CV')
                            ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                            ->maxSize(5120),
                    ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('profile_picture')
                    ->label('Photo')
                    ->circular()
                    ->defaultImageUrl(fn ($record) => $record ? 'https://ui-avatars.com/api/?name=' . urlencode($record->full_name) . '&color=ea580c&background=fed7aa' : '')
                    ->size(50),

                Tables\Columns\TextColumn::make('full_name')
                    ->label('Expert')
                    ->description(fn ($record) => $record ? $record->email : '')
                    ->searchable(['full_name', 'email'])
                    ->sortable()
                    ->weight('medium'),

                Tables\Columns\TextColumn::make('phone')
                    ->label('Téléphone')
                    ->icon('heroicon-o-phone')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Téléphone copié'),

                Tables\Columns\TextColumn::make('organization')
                    ->label('Organisation')
                    ->description(fn ($record) => $record ? $record->position : '')
                    ->searchable(['organization', 'position'])
                    ->sortable()
                    ->placeholder('Non spécifiée'),

                Tables\Columns\TextColumn::make('specialties')
                    ->label('Expertises')
                    ->formatStateUsing(function ($state) {
                        if (!$state) return 'Aucune spécialité';
                        
                        // Si c'est une chaîne, la décoder comme JSON
                        if (is_string($state)) {
                            $state = json_decode($state, true) ?? [];
                        }
                        
                        // Vérifier que c'est bien un tableau
                        if (!is_array($state)) {
                            return 'Aucune spécialité';
                        }
                        
                        if (empty($state)) {
                            return 'Aucune spécialité';
                        }
                        
                        $specialties = array_slice(array_map(function($specialty) {
                            return Expert::SPECIALTIES[$specialty] ?? $specialty;
                        }, $state), 0, 3); // Limite à 3 spécialités affichées
                        
                        $result = implode(', ', $specialties);
                        if (count($state) > 3) {
                            $result .= ' (+' . (count($state) - 3) . ')';
                        }
                        
                        return $result;
                    })
                    ->tooltip(function ($record) {
                        if (!$record || !$record->specialties) return 'Aucune spécialité';
                        
                        $state = $record->specialties;
                        if (is_string($state)) {
                            $state = json_decode($state, true) ?? [];
                        }
                        
                        if (!is_array($state) || empty($state)) {
                            return 'Aucune spécialité';
                        }
                        
                        $allSpecialties = array_map(function($specialty) {
                            return Expert::SPECIALTIES[$specialty] ?? $specialty;
                        }, $state);
                        
                        return 'Spécialités: ' . implode(', ', $allSpecialties);
                    })
                    ->searchable(),

                Tables\Columns\TextColumn::make('account_status')
                    ->label('Statut')
                    ->badge()
                    ->getStateUsing(function ($record) {
                        if (!$record) return 'Inconnu';
                        return Expert::STATUSES[$record->status] ?? $record->status;
                    })
                    ->color(function ($record) {
                        if (!$record) return 'gray';
                        return match($record->status) {
                            'pending' => 'warning',
                            'approved' => 'success', 
                            'rejected' => 'danger',
                            default => 'gray'
                        };
                    })
                    ->icon(function ($record) {
                        if (!$record) return 'heroicon-o-exclamation-triangle';
                        return match($record->status) {
                            'pending' => 'heroicon-o-clock',
                            'approved' => 'heroicon-o-check-circle',
                            'rejected' => 'heroicon-o-x-circle',
                            default => 'heroicon-o-question-mark-circle'
                        };
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Candidature')
                    ->dateTime('d/m/Y')
                    ->description(fn ($record) => $record ? $record->created_at->diffForHumans() : '')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('training_topics')
                    ->label('Formations proposées')
                    ->limit(30)
                    ->tooltip(fn ($record) => $record ? $record->training_topics : '')
                    ->placeholder('Aucune formation')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('training_types')
                    ->label('Types de formation')
                    ->formatStateUsing(function ($state) {
                        if (!$state) return 'Aucun type';
                        
                        // Si c'est une chaîne, la décoder comme JSON
                        if (is_string($state)) {
                            $state = json_decode($state, true) ?? [];
                        }
                        
                        // Vérifier que c'est bien un tableau
                        if (!is_array($state)) {
                            return 'Aucun type';
                        }
                        
                        if (empty($state)) {
                            return 'Aucun type';
                        }
                        
                        $types = array_map(function($type) {
                            return Expert::TRAINING_TYPES[$type] ?? $type;
                        }, $state);
                        
                        return implode(', ', $types);
                    })
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('pedagogical_methods')
                    ->label('Méthodes pédagogiques')
                    ->formatStateUsing(function ($state) {
                        if (!$state) return 'Aucune méthode';
                        
                        // Si c'est une chaîne, la décoder comme JSON
                        if (is_string($state)) {
                            $state = json_decode($state, true) ?? [];
                        }
                        
                        // Vérifier que c'est bien un tableau
                        if (!is_array($state)) {
                            return 'Aucune méthode';
                        }
                        
                        if (empty($state)) {
                            return 'Aucune méthode';
                        }
                        
                        $methods = array_map(function($method) {
                            return Expert::PEDAGOGICAL_METHODS[$method] ?? $method;
                        }, $state);
                        
                        return implode(', ', $methods);
                    })
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('target_audiences')
                    ->label('Public cible')
                    ->formatStateUsing(function ($state) {
                        if (!$state) return 'Aucun public';
                        
                        // Si c'est une chaîne, la décoder comme JSON
                        if (is_string($state)) {
                            $state = json_decode($state, true) ?? [];
                        }
                        
                        // Vérifier que c'est bien un tableau
                        if (!is_array($state)) {
                            return 'Aucun public';
                        }
                        
                        if (empty($state)) {
                            return 'Aucun public';
                        }
                        
                        $audiences = array_map(function($audience) {
                            return Expert::TARGET_AUDIENCES[$audience] ?? $audience;
                        }, $state);
                        
                        return implode(', ', $audiences);
                    })
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('intervention_frequencies')
                    ->label('Fréquence d\'intervention')
                    ->formatStateUsing(function ($state) {
                        if (!$state) return 'Aucune fréquence';
                        
                        // Si c'est une chaîne, la décoder comme JSON
                        if (is_string($state)) {
                            $state = json_decode($state, true) ?? [];
                        }
                        
                        // Vérifier que c'est bien un tableau
                        if (!is_array($state)) {
                            return 'Aucune fréquence';
                        }
                        
                        if (empty($state)) {
                            return 'Aucune fréquence';
                        }
                        
                        $frequencies = array_map(function($frequency) {
                            return Expert::INTERVENTION_FREQUENCIES[$frequency] ?? $frequency;
                        }, $state);
                        
                        return implode(', ', $frequencies);
                    })
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('preferred_days_detailed')
                    ->label('Jours préférés')
                    ->formatStateUsing(function ($state) {
                        if (!$state) return 'Aucun jour';
                        
                        // Si c'est une chaîne, la décoder comme JSON
                        if (is_string($state)) {
                            $state = json_decode($state, true) ?? [];
                        }
                        
                        // Vérifier que c'est bien un tableau
                        if (!is_array($state)) {
                            return 'Aucun jour';
                        }
                        
                        if (empty($state)) {
                            return 'Aucun jour';
                        }
                        
                        $days = array_map(function($day) {
                            return Expert::PREFERRED_DAYS[$day] ?? $day;
                        }, $state);
                        
                        return implode(', ', $days);
                    })
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('time_slots')
                    ->label('Heures préférées')
                    ->formatStateUsing(function ($state) {
                        if (!$state) return 'Aucune heure';
                        
                        // Si c'est une chaîne, la décoder comme JSON
                        if (is_string($state)) {
                            $state = json_decode($state, true) ?? [];
                        }
                        
                        // Vérifier que c'est bien un tableau
                        if (!is_array($state)) {
                            return 'Aucune heure';
                        }
                        
                        if (empty($state)) {
                            return 'Aucune heure';
                        }
                        
                        $slots = array_map(function($slot) {
                            return Expert::TIME_SLOTS[$slot] ?? $slot;
                        }, $state);
                        
                        return implode(', ', $slots);
                    })
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('cv_path')
                    ->label('CV')
                    ->formatStateUsing(fn ($state) => $state ? 'Téléchargé' : 'Non fourni')
                    ->color(fn ($state) => $state ? 'success' : 'gray')
                    ->toggleable(isToggledHiddenByDefault: true),



                Tables\Columns\TextColumn::make('processed_at')
                    ->label('Date de traitement')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Statut de candidature')
                    ->options([
                        'pending' => '⏳ En attente',
                        'approved' => '✅ Approuvé',
                        'rejected' => '❌ Rejeté',
                    ])
                    ->placeholder('Tous les statuts'),

                Tables\Filters\SelectFilter::make('specialties')
                    ->label('Spécialité')
                    ->options(Expert::SPECIALTIES)
                    ->placeholder('Toutes les spécialités'),

                Tables\Filters\Filter::make('has_cv')
                    ->label('CV fourni uniquement')
                    ->query(fn (Builder $query) => $query->whereNotNull('cv_path'))
                    ->toggle(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                
                Tables\Actions\Action::make('approve')
                    ->label('Approuver')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn ($record) => $record && $record->status === 'pending')
                    ->action(function ($record) {
                        if ($record) {
                            $record->update([
                                'status' => 'approved',
                                'processed_at' => now(),
                            ]);
                        }
                    }),

                Tables\Actions\Action::make('reject')
                    ->label('Rejeter')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->visible(fn ($record) => $record && $record->status === 'pending')
                    ->action(function ($record) {
                        if ($record) {
                            $record->update([
                                'status' => 'rejected',
                                'processed_at' => now(),
                            ]);
                        }
                    }),

                Tables\Actions\DeleteAction::make()
                    ->visible(fn ($record) => $record && $record->status !== 'pending'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('approve')
                        ->label('Approuver les candidatures sélectionnées')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->modalHeading('Approuver les candidatures')
                        ->modalDescription('Êtes-vous sûr de vouloir approuver ces candidatures d\'experts ?')
                        ->action(function (Collection $records) {
                            $records->each(function ($record) {
                                if ($record && $record->status === 'pending') {
                                    $record->update([
                                        'status' => 'approved',
                                        'processed_at' => now(),
                                    ]);
                                }
                            });
                        })
                        ->visible(fn ($records) => $records && $records->contains('status', 'pending'))
                        ->deselectRecordsAfterCompletion(),

                    Tables\Actions\BulkAction::make('reject')
                        ->label('Rejeter les candidatures sélectionnées')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->modalHeading('Rejeter les candidatures')
                        ->modalDescription('Êtes-vous sûr de vouloir rejeter ces candidatures d\'experts ?')
                        ->action(function (Collection $records) {
                            $records->each(function ($record) {
                                if ($record && $record->status === 'pending') {
                                    $record->update([
                                        'status' => 'rejected',
                                        'processed_at' => now(),
                                    ]);
                                }
                            });
                        })
                        ->visible(fn ($records) => $records && $records->contains('status', 'pending'))
                        ->deselectRecordsAfterCompletion(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->orderBy('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExperts::route('/'),
            'create' => Pages\CreateExpert::route('/create'),
            'view' => Pages\ViewExpert::route('/{record}'),
            'edit' => Pages\EditExpert::route('/{record}/edit'),
        ];
    }
}
