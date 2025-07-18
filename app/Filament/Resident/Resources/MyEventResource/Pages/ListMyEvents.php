<?php

namespace App\Filament\Resident\Resources\MyEventResource\Pages;

use App\Filament\Resident\Resources\MyEventResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMyEvents extends ListRecords
{
    protected static string $resource = MyEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('explore_events')
                ->label(__('Explorer les événements'))
                ->icon('heroicon-o-magnifying-glass')
                ->url(route('events'))
                ->color('primary'),
        ];
    }

    public function getTitle(): string
    {
        return __('Mes inscriptions aux événements');
    }

    protected function getHeaderWidgets(): array
    {
        return [
            // Vous pouvez ajouter des widgets ici plus tard
        ];
    }
} 