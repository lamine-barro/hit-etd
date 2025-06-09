<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\ViewRecord;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;

    /**
     * Langue actuellement sélectionnée pour l'affichage
     */
    public ?string $currentLocale = null;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
