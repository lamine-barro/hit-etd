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
                Forms\Components\Section::make('Informations de réservation')
                    ->columns(2)
                    ->schema([
                        Forms\Components\DateTimePicker::make('started_at')
                            ->prefix('Début : ')
                            ->minDate(now())
                            ->helperText('Date et heure de début de la réservation')
                            ->label('Début'),

                        Forms\Components\DateTimePicker::make('ended_at')
                            ->prefix('Fin : ')
                            ->minDate(now())
                            ->helperText('Date et heure de fin de la réservation')
                            ->label('Fin'),

                        Forms\Components\TextInput::make('notes')
                            ->helperText('Notes ou instructions spéciales pour la réservation')
                            ->label('Notes'),

                        Forms\Components\Select::make('payment_method')
                            ->options(EspaceOrder::PAYMENT_METHODS)
                            ->helperText('Méthode de paiement utilisée pour cette réservation')
                            ->label('Méthode de paiement'),
                    ]),

                Forms\Components\Section::make('Informations les espaces')
                    ->description('Informations sur l\'espace réservé')
                    ->schema([
                        Forms\Components\Repeater::make('items')
                            ->relationship('items')
                            ->label('Espaces réservés')
                            ->addActionLabel('Ajouter un espace')
                            ->schema([
                                Forms\Components\Select::make('type')
                                    ->label('Type d\'espace')
                                    ->default(fn ($record) => $record->espace?->type ?? null)
                                    ->options(Espace::FR_TYPES)
                                    ->reactive()
                                    ->helperText('Type d\'espace réservé')
                                    ->required(),

                                Forms\Components\Select::make('espace_id')
                                    ->label('Espace')
                                    ->default(fn ($record) => $record->espace?->id ?? null)
                                    ->reactive()
                                    ->disabled(fn (Forms\Get $get) => ! $get('type'))
                                    ->options(function (Forms\Get $get) {
                                        return Espace::where('type', $get('type'))
                                            ->pluck('name', 'id');
                                    })
                                    ->searchable()
                                    ->helperText('Sélectionnez l\'espace à réserver')
                                    ->required(),

                                Forms\Components\TextInput::make('quantity')
                                    ->label('Quantité')
                                    ->disabled(fn (Forms\Get $get) => ! $get('espace_id'))
                                    ->numeric()
                                    ->reactive()
                                    ->minValue(1)
                                    ->default(1)
                                    ->required(),
                            ])->columns(3),
                    ])->columns(1),
            ]);
    }

    public function getRelationManagers(): array
    {
        return [];
    }
}
