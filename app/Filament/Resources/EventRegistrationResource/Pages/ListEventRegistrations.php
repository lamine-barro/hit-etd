<?php

namespace App\Filament\Resources\EventRegistrationResource\Pages;

use App\Enums\RegistrationStatus;
use App\Filament\Resources\EventRegistrationResource;
use App\Models\EventRegistration;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Filters\Indicator;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Components\Tab;

class ListEventRegistrations extends ListRecords
{
    protected static string $resource = EventRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Nouvelle inscription'),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make()
                ->label('Tous')
                ->icon('heroicon-o-rectangle-stack'),
            'pending' => Tab::make()
                ->label('En attente')
                ->icon(RegistrationStatus::PENDING->icon())
                ->badge(EventRegistration::where('status', RegistrationStatus::PENDING->value)->count())
                ->badgeColor(RegistrationStatus::PENDING->color())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', RegistrationStatus::PENDING->value)),
            'confirmed' => Tab::make()
                ->label('Confirmés')
                ->icon(RegistrationStatus::CONFIRMED->icon())
                ->badge(EventRegistration::where('status', RegistrationStatus::CONFIRMED->value)->count())
                ->badgeColor(RegistrationStatus::CONFIRMED->color())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', RegistrationStatus::CONFIRMED->value)),
            'cancelled' => Tab::make()
                ->label('Annulés')
                ->icon(RegistrationStatus::CANCELLED->icon())
                ->badge(EventRegistration::where('status', RegistrationStatus::CANCELLED->value)->count())
                ->badgeColor(RegistrationStatus::CANCELLED->color())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', RegistrationStatus::CANCELLED->value)),
            'attended' => Tab::make()
                ->label('Participants')
                ->icon(RegistrationStatus::ATTENDED->icon())
                ->badge(EventRegistration::where('status', RegistrationStatus::ATTENDED->value)->count())
                ->badgeColor(RegistrationStatus::ATTENDED->color())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', RegistrationStatus::ATTENDED->value)),
        ];
    }
}
