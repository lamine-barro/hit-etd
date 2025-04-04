<?php

namespace App\Filament\Resources\AudienceResource\Pages;

use App\Filament\Resources\AudienceResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAudiences extends ManageRecords
{
    protected static string $resource = AudienceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
