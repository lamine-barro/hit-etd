<?php

namespace App\Filament\Resident\Resources\EspaceOrderResource\Pages;

use App\Filament\Resident\Resources\EspaceOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEspaceOrders extends ListRecords
{
    protected static string $resource = EspaceOrderResource::class;

    protected static ?string $navigationGroup = 'Espace';

    protected static ?int $navigationSort = 2;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label(__('Créer une réservation'))
                ->icon('heroicon-o-plus')
                ->color('primary'),
        ];
    }
}
