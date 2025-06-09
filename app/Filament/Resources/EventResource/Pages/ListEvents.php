<?php

namespace App\Filament\Resources\EventResource\Pages;

use App\Enums\EventStatus;
use App\Filament\Resources\EventResource;
use App\Models\Event;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListEvents extends ListRecords
{
    protected static string $resource = EventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make()
                ->label('Tous')
                ->icon('heroicon-o-rectangle-stack'),
            'published' => Tab::make()
                ->label('Publiés')
                ->icon('heroicon-o-check-circle')
                ->badge(Event::where('status', EventStatus::PUBLISHED->value)->count())
                ->badgeColor('success')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', EventStatus::PUBLISHED->value)),
            'draft' => Tab::make()
                ->label('Brouillons')
                ->icon('heroicon-o-pencil')
                ->badge(Event::where('status', EventStatus::DRAFT->value)->count())
                ->badgeColor('warning')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', EventStatus::DRAFT->value)),
        ];
    }

    protected function getTableEmptyStateActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Créer votre premier événement'),
        ];
    }
}
