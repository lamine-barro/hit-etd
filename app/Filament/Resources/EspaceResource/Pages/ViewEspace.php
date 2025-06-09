<?php

namespace App\Filament\Resources\EspaceResource\Pages;

use App\Filament\Resources\EspaceResource;
use App\Models\Espace;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewEspace extends ViewRecord
{
    protected static string $resource = EspaceResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Détails de l\'espace')
                    ->columns(3)
                    ->schema([
                        Infolists\Components\TextEntry::make('type')
                            ->state(function (Espace $record) {
                                return Espace::FR_TYPES[$record->type] ?? $record->type;
                            })
                            ->label('Type d\'espace'),

                        Infolists\Components\TextEntry::make('name')
                            ->label('Nom'),

                        Infolists\Components\TextEntry::make('code')
                            ->label('Code'),

                        Infolists\Components\TextEntry::make('location')
                            ->label('Emplacement'),

                        Infolists\Components\TextEntry::make('price')
                            ->label('Prix de location'),

                        Infolists\Components\TextEntry::make('floor')
                            ->label('Étage'),

                        Infolists\Components\TextEntry::make('minimum_duration')
                            ->label('Durée minimale')
                            ->helperText('Durée minimale de location en heures'),

                        Infolists\Components\TextEntry::make('created_at')
                            ->label('Créé le')
                            ->dateTime(),

                        Infolists\Components\TextEntry::make('updated_at')
                            ->label('Mis à jour le')
                            ->dateTime(),
                    ]),

                Infolists\Components\Section::make('Images et illustration')
                    ->description('Les images et l\'illustration de l\'espace')
                    ->collapsed()
                    ->columns(1)
                    ->schema([
                        Infolists\Components\ImageEntry::make('illustration')
                            ->label('Illustration')
                            ->height(120),

                        Infolists\Components\ImageEntry::make('images')
                            ->label('Images supplémentaires')
                            ->height(120),
                    ]),
            ])->columns(2);
    }
}
