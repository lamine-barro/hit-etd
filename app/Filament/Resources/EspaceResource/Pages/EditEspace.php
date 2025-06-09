<?php

namespace App\Filament\Resources\EspaceResource\Pages;

use App\Filament\Resources\EspaceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEspace extends EditRecord
{
    protected static string $resource = EspaceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
