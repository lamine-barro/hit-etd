<?php

namespace App\Filament\Resident\Widgets;

use App\Filament\Resident\Resources\EspaceOrderResource;
use App\Models\EspaceOrder;
use Filament\Actions;
use Filament\Forms;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class CalendarWidget extends FullCalendarWidget
{
    public function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('label'),
            Forms\Components\Grid::make()
                ->schema([
                    Forms\Components\DateTimePicker::make('starts_at'),
                    Forms\Components\DateTimePicker::make('ends_at'),
                ]),
        ];
    }

    public function fetchEvents(array $fetchInfo): array
    {
        return EspaceOrder::query()
            ->where('created_at', '>=', $fetchInfo['start'])
            ->where('updated_at', '<=', $fetchInfo['end'])
            ->get()
            ->map(
                function (EspaceOrder $event) {
                    $data = [
                        'title' => $event->label ?? $event->type,
                        'start' => $event->starts_at,
                        'end' => $event->ends_at,
                    ];
                    if ($event->driver_id) {
                        $data['shouldOpenUrlInNewTab'] = true;
                        $data['url'] = EspaceOrderResource::getUrl(name: 'view', parameters: ['record' => $event]);
                    }

                    return $data;
                }
            )
            ->all();
    }

    protected function headerActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
