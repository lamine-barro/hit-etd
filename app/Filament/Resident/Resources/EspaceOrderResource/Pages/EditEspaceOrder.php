<?php

namespace App\Filament\Resident\Resources\EspaceOrderResource\Pages;

use App\Filament\Resident\Resources\EspaceOrderResource;
use App\Models\Espace;
use App\Models\EspaceOrder;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;

class EditEspaceOrder extends EditRecord
{
    protected static string $resource = EspaceOrderResource::class;

    protected function getHeaderActions(): array
    {
        $record = $this->getRecord();

        return [
            Actions\DeleteAction::make()
                ->requiresConfirmation()
                ->disabled(fn () => ! $record->isPending()),
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('Informations de réservation'))
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('notes')
                            ->helperText(__('Notes ou instructions spéciales pour la réservation'))
                            ->label(__('Notes')),

                        Forms\Components\Select::make('payment_method')
                            ->options(EspaceOrder::PAYMENT_METHODS)
                            ->helperText(__('Méthode de paiement utilisée pour cette réservation'))
                            ->label(__('Méthode de paiement')),
                    ]),

                Forms\Components\Section::make(__('Informations les espaces'))
                    ->description(__('Informations sur l\'espace réservé'))
                    ->schema([
                        Forms\Components\Repeater::make('espaces')
                            ->label(__('Espaces réservés'))
                            ->addActionLabel(__('Ajouter un espace'))
                            ->relationship('espaces')
                            ->schema([
                                Forms\Components\DateTimePicker::make('started_at')
                                    ->prefix(__('Début : '))
                                    ->minDate(now())
                                    ->helperText(__('Date et heure de début de la réservation'))
                                    ->label(__('Début')),

                                Forms\Components\DateTimePicker::make('ended_at')
                                    ->prefix(__('Fin : '))
                                    ->minDate(now())
                                    ->helperText(__('Date et heure de fin de la réservation'))
                                    ->label(__('Fin')),

                                Forms\Components\Select::make('type')
                                    ->label(__("Type d'espace"))
                                    ->options(Espace::FR_TYPES)
                                    ->reactive()
                                    ->helperText(__("Type d'espace réservé"))
                                    ->required(),

                                Forms\Components\Select::make('espace_id')
                                    ->label(__('Espace'))
                                    ->reactive()
                                    ->disabled(fn (Forms\Get $get) => ! $get('type'))
                                    ->options(function (Forms\Get $get) {
                                        return Espace::where('type', $get('type'))
                                            ->leftJoin('espace_order_items', 'espace_order_items.espace_id', '=', 'espaces.id')
                                            ->leftJoin('espace_orders', 'espace_orders.id', '=', 'espace_order_items.espace_order_id')
                                            ->where(function ($query) {
                                                $query->whereNull('espace_orders.id')
                                                    ->orWhere(function ($query) {
                                                        $query->where('espace_orders.ended_at', '<', now())
                                                            ->where('espace_orders.status', 'confirmed');
                                                    });
                                            })
                                            ->pluck('espaces.name', 'espaces.id');
                                    })
                                    ->searchable()
                                    ->helperText(__("Sélectionnez l'espace à réserver"))
                                    ->required(),

                                Forms\Components\TextInput::make('quantity')
                                    ->label(__('Quantité'))
                                    ->disabled(fn (Forms\Get $get) => ! $get('espace_id'))
                                    ->numeric()
                                    ->reactive()
                                    ->minValue(1)
                                    ->default(1)
                                    ->required(),

                                Forms\Components\TextInput::make('notes')
                                    ->helperText(__('Notes ou instructions spéciales pour la réservation'))
                                    ->label(__('Notes')),
                            ])->columns(3),
                    ])->columns(1), ]);
    }

    public function getRelationManagers(): array
    {
        return [];
    }
}
