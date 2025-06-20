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
            ->where('started_at', '>=', $fetchInfo['start'])
            ->where('ended_at', '<=', $fetchInfo['end'])
            ->get()
            ->map(
                function (EspaceOrder $event) {
                    $data = [
                        'title' => "{$event->reference}/{$event->notes}/{$event->status}",
                        'start' => $event->started_at,
                        'end' => $event->ended_at,
                    ];

                    $data['color'] = match ($event->status) {
                        'pending' => 'yellow',
                        'processing' => 'blue',
                        'completed' => 'green',
                        'cancelled' => 'red',
                        default => 'gray',
                    };

                    $data['shouldOpenUrlInNewTab'] = true;
                    $data['url'] = EspaceOrderResource::getUrl(name: 'view', parameters: ['record' => $event]);

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
