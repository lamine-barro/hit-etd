<?php

namespace App\Filament\Resources\EspaceResource\Pages;

use App\Filament\Resources\EspaceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEspaces extends ListRecords
{
    protected static string $resource = EspaceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Nouvel espace'),
        ];
    }

    public function getTitle(): string
    {
        return 'Espaces';
    }
}
