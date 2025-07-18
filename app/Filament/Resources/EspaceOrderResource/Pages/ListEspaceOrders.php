<?php

namespace App\Filament\Resources\EspaceOrderResource\Pages;

use App\Filament\Resources\EspaceOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEspaceOrders extends ListRecords
{
    protected static string $resource = EspaceOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return 'Réservations';
    }
}
