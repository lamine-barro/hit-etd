<?php

namespace App\Filament\Resources\EspaceResource\Pages;

use App\Filament\Resources\EspaceResource;
use App\Models\Espace;
use Filament\Resources\Pages\CreateRecord;

class CreateEspace extends CreateRecord
{
    protected static string $resource = EspaceResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['status'] = Espace::STATUS_AVAILABLE;

        return $data;
    }

    public function getTitle(): string
    {
        return 'Créer un espace';
    }
}
