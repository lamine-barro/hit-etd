<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\EventResource;
use App\Models\Event;
use App\Enums\EventStatus;
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
        return Event::query()
            ->where('start_date', '>=', $fetchInfo['start'])
            ->where('start_date', '<=', $fetchInfo['end'])
            ->with('translations')
            ->get()
            ->map(
                function (Event $event) {
                    // Récupérer le titre de l'événement dans la langue actuelle
                    $currentLocale = app()->getLocale();
                    $translation = $event->translations()
                        ->where('locale', $currentLocale)
                        ->first();
                    
                    $title = $translation ? $translation->title : $event->slug;
                    
                    $data = [
                        'title' => $title,
                        'start' => $event->start_date,
                        'end' => $event->end_date,
                    ];

                    $data['color'] = match ($event->status) {
                        EventStatus::PUBLISHED => 'green',
                        EventStatus::DRAFT => 'orange',
                        EventStatus::CANCELLED => 'red',
                        default => 'gray',
                    };

                    $data['shouldOpenUrlInNewTab'] = true;
                    $data['url'] = EventResource::getUrl(name: 'view', parameters: ['record' => $event->id], panel: 'admin');

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
