<?php

namespace App\Filament\Resources\EventRegistrationResource\Pages;

use App\Filament\Resources\EventRegistrationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewEventRegistration extends ViewRecord
{
    protected static string $resource = EventRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->label('Modifier'),
            Actions\DeleteAction::make()
                ->label('Supprimer')
                ->modalHeading('Supprimer l\'inscription')
                ->modalDescription('Êtes-vous sûr de vouloir supprimer cette inscription ? Cette action est irréversible.')
                ->modalSubmitActionLabel('Oui, supprimer'),
        ];
    }
}
