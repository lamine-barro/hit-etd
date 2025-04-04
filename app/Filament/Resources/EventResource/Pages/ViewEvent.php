<?php

namespace App\Filament\Resources\EventResource\Pages;

use App\Enums\Currency;
use App\Enums\EventStatus;
use App\Enums\EventType;
use App\Filament\Resources\EventResource;
use App\Models\Event;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Enums\FontWeight;
use Illuminate\Support\HtmlString;

class ViewEvent extends ViewRecord
{
    protected static string $resource = EventResource::class;

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
                Split::make([
                    Grid::make(2)
                        ->schema([
                            Section::make()
                                ->schema([
                                    ImageEntry::make('illustration')
                                        ->label('')
                                        ->height(300)
                                        ->extraImgAttributes(['class' => 'object-cover w-full rounded-xl']),
                                    
                                    TextEntry::make('title')
                                        ->label('')
                                        ->weight(FontWeight::Bold)
                                        ->size(TextEntry\TextEntrySize::Large)
                                        ->columnSpanFull(),
                                    
                                    Grid::make(2)
                                        ->schema([
                                            TextEntry::make('type')
                                                ->label('Type d\'événement')
                                                ->formatStateUsing(fn (string $state): string => EventType::from($state)->label())
                                                ->icon(fn (string $state): string => EventType::from($state)->icon())
                                                ->badge()
                                                ->color(fn (string $state): string => match($state) {
                                                    EventType::CONFERENCE->value => 'primary',
                                                    EventType::WORKSHOP->value => 'warning',
                                                    EventType::WEBINAR->value => 'info',
                                                    EventType::MEETUP->value => 'success',
                                                    EventType::TRAINING->value => 'danger',
                                                    EventType::HACKATHON->value => 'purple',
                                                    default => 'gray',
                                                }),
                                                
                                            TextEntry::make('status')
                                                ->label('Statut')
                                                ->formatStateUsing(fn (string $state): string => EventStatus::from($state)->label())
                                                ->icon(fn (string $state): string => EventStatus::from($state)->icon())
                                                ->badge()
                                                ->color(fn (string $state): string => match($state) {
                                                    EventStatus::PUBLISHED->value => 'success',
                                                    EventStatus::DRAFT->value => 'gray',
                                                    EventStatus::CANCELLED->value => 'danger',
                                                    default => 'gray',
                                                }),
                                        ]),
                                    
                                    TextEntry::make('description')
                                        ->label('Description')
                                        ->html()
                                        ->columnSpanFull(),
                                ]),
                        ])
                        ->columnSpan(['lg' => 1]),
                    
                    Grid::make(1)
                        ->schema([
                            
                            \Filament\Infolists\Components\Tabs::make('Détails')
                                ->tabs([
                                    \Filament\Infolists\Components\Tabs\Tab::make('Informations pratiques')
                                        ->icon('heroicon-o-information-circle')
                                        ->schema([
                                            Group::make([
                                                TextEntry::make('start_date')
                                                    ->label('Date de début')
                                                    ->formatStateUsing(fn ($state) => Carbon::parse($state)->format('d/m/Y H:i')),
                                                    
                                                TextEntry::make('end_date')
                                                    ->label('Date de fin')
                                                    ->formatStateUsing(fn ($state) => $state ? Carbon::parse($state)->format('d/m/Y H:i') : 'Non définie'),
                                            ])->columns(2),
                                            
                                            Group::make([
                                                TextEntry::make('location')
                                                    ->label('Lieu'),
                                                    
                                                TextEntry::make('is_remote')
                                                    ->label('Format')
                                                    ->formatStateUsing(fn (bool $state): string => $state ? 'En ligne' : 'Présentiel'),
                                                    
                                                TextEntry::make('external_link')
                                                    ->label('Lien externe')
                                                    ->formatStateUsing(fn ($state, Event $record) => $record->external_link ? new HtmlString('<a href="' . $record->external_link . '" target="_blank" class="text-primary-600 hover:underline">' . $record->external_link . '</a>') : 'Non disponible')
                                                    ->visible(fn (Event $record): bool => $record->is_remote),
                                            ])->columns(2),

                                            Group::make([
                                                TextEntry::make('duration')
                                                    ->label('Durée')
                                                    ->state(function (Event $record): string {
                                                        if (!$record->end_date) return 'Non définie';
                                                        
                                                        $start = Carbon::parse($record->start_date);
                                                        $end = Carbon::parse($record->end_date);
                                                        $diffInHours = $start->diffInHours($end);
                                                        
                                                        if ($diffInHours < 24) {
                                                            return $diffInHours . ' heure' . ($diffInHours > 1 ? 's' : '');
                                                        } else {
                                                            $diffInDays = $start->diffInDays($end);
                                                            return $diffInDays . ' jour' . ($diffInDays > 1 ? 's' : '');
                                                        }
                                                    })
                                                    ->icon('heroicon-o-clock'),

                                                TextEntry::make('max_participants')
                                                    ->label('Nombre maximum de participants'),
                                                    
                                                TextEntry::make('registration_end_date')
                                                    ->label('Date limite d\'inscription')
                                                    ->formatStateUsing(fn ($state) => Carbon::parse($state)->format('d/m/Y H:i')),

                                                    TextEntry::make('registrations_count')
                                                    ->label('Nombre d\'inscrits')
                                                    ->state(function (Event $record): string {
                                                        $count = $record->registrations()->count();
                                                        return $count . ' / ' . $record->max_participants;
                                                    }),
                                                    
                                                TextEntry::make('remaining_spots')
                                                    ->label('Places restantes')
                                                    ->state(function (Event $record): string {
                                                        $count = $record->registrations()->count();
                                                        $remaining = $record->max_participants - $count;
                                                        return $remaining > 0 ? $remaining : 'Complet';
                                                    })
                                                    ->color(function (Event $record): string {
                                                        $count = $record->registrations()->count();
                                                        $remaining = $record->max_participants - $count;
                                                        return $remaining > 0 ? 'success' : 'danger';
                                                    }),

                                                    TextEntry::make('is_paid')
                                                    ->label('Type d\'événement')
                                                    ->formatStateUsing(fn (bool $state): string => $state ? 'Payant' : 'Gratuit')
                                                    ->color(fn (bool $state): string => $state ? 'warning' : 'success'),
                                                    
                                                TextEntry::make('price')
                                                    ->label('Prix standard')
                                                    ->formatStateUsing(function ($state, Event $record) {
                                                        if (!$record->is_paid) return 'Gratuit';
                                                        return number_format($state, 0, ',', ' ') . ' ' . Currency::from($record->currency)->symbol();
                                                    })
                                                    ->visible(fn (Event $record): bool => $record->is_paid),
                                            ])->columns(2),

                                            
                                        ]),
                                        
                                    \Filament\Infolists\Components\Tabs\Tab::make('Métadonnées')
                                        ->icon('heroicon-o-information-circle')
                                        ->schema([
                                            Group::make([
                                                TextEntry::make('createdBy.first_name')
                                                    ->label('Créé par')
                                                    ->formatStateUsing(fn ($state, Event $record) => $record->createdBy ? $record->createdBy->first_name . ' ' . $record->createdBy->last_name : '-')
                                                    ->icon('heroicon-o-user'),
                                                    
                                                TextEntry::make('created_at')
                                                    ->label('Créé le')
                                                    ->dateTime('d/m/Y H:i'),
                                            ])->columns(2),
                                            
                                            Group::make([
                                                TextEntry::make('updated_at')
                                                    ->label('Dernière mise à jour')
                                                    ->dateTime('d/m/Y H:i'),
                                                    
                                                TextEntry::make('slug')
                                                    ->label('Slug'),
                                            ])->columns(2),
                                        ]),
                                ]),
                        ])
                        ->columnSpan(['lg' => 2]),
                ])->columnSpanFull()
                ->from('lg'),

            ]);
    }
}
