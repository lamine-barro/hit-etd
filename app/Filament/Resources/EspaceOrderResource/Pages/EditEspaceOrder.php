<?php

namespace App\Filament\Resources\EspaceOrderResource\Pages;

use App\Filament\Resources\EspaceOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEspaceOrder extends EditRecord
{
    protected static string $resource = EspaceOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->disabled(fn ($record) => !$record->isPending()),
        ];
    }
}
