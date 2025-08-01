<?php

namespace App\Filament\Resources\PartnershipResource\Pages;

use App\Filament\Resources\PartnershipResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePartnership extends CreateRecord
{
    protected static string $resource = PartnershipResource::class;

    public function getTitle(): string
    {
        return 'Créer un partenariat';
    }
}
