<?php

namespace App\Filament\Resources\ExpertResource\Pages;

use App\Filament\Resources\ExpertResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Grid;
use App\Models\Expert;
use Filament\Support\Colors\Color;

class ViewExpert extends ViewRecord
{
    protected static string $resource = ExpertResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Informations personnelles')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('full_name')
                                    ->label('Nom et prénoms'),
                                
                                TextEntry::make('email')
                                    ->label('Email')
                                    ->copyable(),
                                
                                TextEntry::make('phone')
                                    ->label('Téléphone')
                                    ->copyable(),
                                
                                TextEntry::make('organization')
                                    ->label('Organisation'),
                                
                                TextEntry::make('position')
                                    ->label('Poste'),
                                
                                TextEntry::make('linkedin')
                                    ->label('LinkedIn')
                                    ->url(fn ($state) => $state)
                                    ->openUrlInNewTab(),
                            ]),
                    ]),

                Section::make('Compétences et formations')
                    ->schema([
                        TextEntry::make('specialties')
                            ->label('Spécialités')
                            ->badge()
                            ->formatStateUsing(function ($state) {
                                if (!$state) return ['Aucune'];
                                
                                // Si c'est une chaîne, la décoder comme JSON
                                if (is_string($state)) {
                                    $state = json_decode($state, true) ?? [];
                                }
                                
                                // Vérifier que c'est bien un tableau
                                if (!is_array($state)) {
                                    return ['Aucune'];
                                }
                                
                                if (empty($state)) {
                                    return ['Aucune'];
                                }
                                
                                $labels = array_map(function($specialty) {
                                    return Expert::SPECIALTIES[$specialty] ?? $specialty;
                                }, $state);
                                
                                return $labels;
                            }),
                        
                        TextEntry::make('specialty_other')
                            ->label('Autre spécialité')
                            ->formatStateUsing(fn ($state) => $state ?: 'Aucune')
                            ->placeholder('Aucune'),
                        
                        TextEntry::make('training_types')
                            ->label('Types de formation')
                            ->badge()
                            ->formatStateUsing(function ($state) {
                                if (!$state) return ['Aucun'];
                                
                                // Si c'est une chaîne, la décoder comme JSON
                                if (is_string($state)) {
                                    $state = json_decode($state, true) ?? [];
                                }
                                
                                // Vérifier que c'est bien un tableau
                                if (!is_array($state)) {
                                    return ['Aucun'];
                                }
                                
                                if (empty($state)) {
                                    return ['Aucun'];
                                }
                                
                                $labels = array_map(function($type) {
                                    return Expert::TRAINING_TYPES[$type] ?? $type;
                                }, $state);
                                
                                return $labels;
                            }),
                        
                        TextEntry::make('pedagogical_methods')
                            ->label('Méthodes pédagogiques')
                            ->badge()
                            ->formatStateUsing(function ($state) {
                                if (!$state) return ['Aucune'];
                                
                                // Si c'est une chaîne, la décoder comme JSON
                                if (is_string($state)) {
                                    $state = json_decode($state, true) ?? [];
                                }
                                
                                // Vérifier que c'est bien un tableau
                                if (!is_array($state)) {
                                    return ['Aucune'];
                                }
                                
                                if (empty($state)) {
                                    return ['Aucune'];
                                }
                                
                                $labels = array_map(function($method) {
                                    return Expert::PEDAGOGICAL_METHODS[$method] ?? $method;
                                }, $state);
                                
                                return $labels;
                            }),
                        
                        TextEntry::make('target_audiences')
                            ->label('Public cible')
                            ->badge()
                            ->formatStateUsing(function ($state) {
                                if (!$state) return ['Aucun'];
                                
                                // Si c'est une chaîne, la décoder comme JSON
                                if (is_string($state)) {
                                    $state = json_decode($state, true) ?? [];
                                }
                                
                                // Vérifier que c'est bien un tableau
                                if (!is_array($state)) {
                                    return ['Aucun'];
                                }
                                
                                if (empty($state)) {
                                    return ['Aucun'];
                                }
                                
                                $labels = array_map(function($audience) {
                                    return Expert::TARGET_AUDIENCES[$audience] ?? $audience;
                                }, $state);
                                
                                return $labels;
                            }),
                    ]),

                Section::make('Disponibilités')
                    ->schema([
                        TextEntry::make('intervention_frequencies')
                            ->label('Fréquence d\'intervention')
                            ->badge()
                            ->formatStateUsing(function ($state) {
                                if (!$state) return ['Aucune'];
                                
                                // Si c'est une chaîne, la décoder comme JSON
                                if (is_string($state)) {
                                    $state = json_decode($state, true) ?? [];
                                }
                                
                                // Vérifier que c'est bien un tableau
                                if (!is_array($state)) {
                                    return ['Aucune'];
                                }
                                
                                if (empty($state)) {
                                    return ['Aucune'];
                                }
                                
                                $labels = array_map(function($frequency) {
                                    return Expert::INTERVENTION_FREQUENCIES[$frequency] ?? $frequency;
                                }, $state);
                                
                                return $labels;
                            }),
                        
                        TextEntry::make('preferred_days_detailed')
                            ->label('Jours préférés')
                            ->badge()
                            ->formatStateUsing(function ($state) {
                                if (!$state) return ['Aucun'];
                                
                                // Si c'est une chaîne, la décoder comme JSON
                                if (is_string($state)) {
                                    $state = json_decode($state, true) ?? [];
                                }
                                
                                // Vérifier que c'est bien un tableau
                                if (!is_array($state)) {
                                    return ['Aucun'];
                                }
                                
                                if (empty($state)) {
                                    return ['Aucun'];
                                }
                                
                                $labels = array_map(function($day) {
                                    return Expert::PREFERRED_DAYS[$day] ?? $day;
                                }, $state);
                                
                                return $labels;
                            }),
                        
                        TextEntry::make('time_slots')
                            ->label('Créneaux horaires')
                            ->badge()
                            ->formatStateUsing(function ($state) {
                                if (!$state) return ['Aucun'];
                                
                                // Si c'est une chaîne, la décoder comme JSON
                                if (is_string($state)) {
                                    $state = json_decode($state, true) ?? [];
                                }
                                
                                // Vérifier que c'est bien un tableau
                                if (!is_array($state)) {
                                    return ['Aucun'];
                                }
                                
                                if (empty($state)) {
                                    return ['Aucun'];
                                }
                                
                                $labels = array_map(function($slot) {
                                    return Expert::TIME_SLOTS[$slot] ?? $slot;
                                }, $state);
                                
                                return $labels;
                            }),
                    ]),

                Section::make('Documents et traitement')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('cv_path')
                                    ->label('CV')
                                    ->formatStateUsing(fn ($state) => $state ? 'Téléchargé' : 'Non fourni')
                                    ->color(fn ($state) => $state ? Color::Green : Color::Gray)
                                    ->badge(),
                                
                                TextEntry::make('status')
                                    ->label('Statut')
                                    ->badge()
                                    ->formatStateUsing(fn ($state) => Expert::STATUSES[$state] ?? $state)
                                    ->color(fn ($state) => match ($state) {
                                        'pending' => Color::Amber,
                                        'approved' => Color::Green,
                                        'rejected' => Color::Red,
                                        default => Color::Gray,
                                    }),
                                
                                TextEntry::make('created_at')
                                    ->label('Date de candidature')
                                    ->dateTime('d/m/Y H:i'),
                            ]),
                        
                        TextEntry::make('processed_at')
                            ->label('Date de traitement')
                            ->dateTime('d/m/Y H:i')
                            ->placeholder('Non traité'),
                        
                        TextEntry::make('admin_notes')
                            ->label('Notes administratives')
                            ->placeholder('Aucune note')
                            ->columnSpanFull(),
                    ]),

                Section::make('Données brutes (Debug)')
                    ->collapsed()
                    ->schema([
                        TextEntry::make('specialties')
                            ->label('Spécialités (brut)')
                            ->formatStateUsing(fn ($state) => is_array($state) ? json_encode($state) : (string) $state)
                            ->copyable(),
                        
                        TextEntry::make('training_types')
                            ->label('Types de formation (brut)')
                            ->formatStateUsing(fn ($state) => is_array($state) ? json_encode($state) : (string) $state)
                            ->copyable(),
                        
                        TextEntry::make('pedagogical_methods')
                            ->label('Méthodes pédagogiques (brut)')
                            ->formatStateUsing(fn ($state) => is_array($state) ? json_encode($state) : (string) $state)
                            ->copyable(),
                        
                        TextEntry::make('target_audiences')
                            ->label('Public cible (brut)')
                            ->formatStateUsing(fn ($state) => is_array($state) ? json_encode($state) : (string) $state)
                            ->copyable(),
                        
                        TextEntry::make('intervention_frequencies')
                            ->label('Fréquence d\'intervention (brut)')
                            ->formatStateUsing(fn ($state) => is_array($state) ? json_encode($state) : (string) $state)
                            ->copyable(),
                        
                        TextEntry::make('preferred_days_detailed')
                            ->label('Jours préférés (brut)')
                            ->formatStateUsing(fn ($state) => is_array($state) ? json_encode($state) : (string) $state)
                            ->copyable(),
                        
                        TextEntry::make('time_slots')
                            ->label('Créneaux horaires (brut)')
                            ->formatStateUsing(fn ($state) => is_array($state) ? json_encode($state) : (string) $state)
                            ->copyable(),
                    ])->columns(2),
            ]);
    }
} 