<?php

namespace App\Filament\Resources\AudienceResource\Pages;

use App\Filament\Resources\AudienceResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use App\Exports\SubscribersExport;
use Filament\Actions\ExportAction;
use Maatwebsite\Excel\Facades\Excel;

class ManageAudiences extends ManageRecords
{
    protected static string $resource = AudienceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
                ->label('Exporter les abonnés')
                ->exporter(SubscribersExport::class)
                ->color('primary')
                ->icon('heroicon-o-arrow-down-tray'),

        ];
    }

    public function getTitle(): string
    {
        return 'Audiences';
    }
}
