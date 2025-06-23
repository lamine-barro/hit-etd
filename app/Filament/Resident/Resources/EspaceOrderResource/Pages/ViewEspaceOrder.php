<?php

namespace App\Filament\Resident\Resources\EspaceOrderResource\Pages;

use App\Filament\Resident\Resources\EspaceOrderResource;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewEspaceOrder extends ViewRecord
{
    protected static string $resource = EspaceOrderResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make(__('Détails de la commande'))
                    ->schema([
                        Infolists\Components\TextEntry::make('reference')
                            ->label('Référence'),

                        Infolists\Components\TextEntry::make('user.name')
                            ->label('Résident'),

                        Infolists\Components\TextEntry::make('order_date')
                            ->label(__('Date de la commande'))
                            ->dateTime('d/m/Y H:i'),

                        Infolists\Components\TextEntry::make('status')
                            ->label(__('Statut'))
                            ->color(fn ($record) => match ($record->status) {
                                'pending' => 'warning',
                                'confirmed' => 'success',
                                'cancelled' => 'danger',
                                default => 'secondary',
                            }),

                        Infolists\Components\TextEntry::make('total_amount')
                            ->label(__('Montant total')),

                        Infolists\Components\TextEntry::make('payment_method')
                            ->label(__('Méthode de paiement')),
                    ])->columns(3),
            ]);
    }
}
