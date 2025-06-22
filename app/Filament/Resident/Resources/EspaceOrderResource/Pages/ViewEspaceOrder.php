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

                        Infolists\Components\TextEntry::make('user.email')
                            ->label(__('Utilisateur')),

                        Infolists\Components\TextEntry::make('order_date')
                            ->label(__('Date de la commande'))
                            ->dateTime('d/m/Y H:i'),

                        Infolists\Components\TextEntry::make('status')
                            ->label(__('Statut')),

                        Infolists\Components\TextEntry::make('total_amount')
                            ->label(__('Montant total')),

                        Infolists\Components\TextEntry::make('payment_method')
                            ->label(__('Méthode de paiement')),

                        Infolists\Components\TextEntry::make('started_at')
                            ->label(__('Début'))
                            ->dateTime('d/m/Y H:i'),

                        Infolists\Components\TextEntry::make('ended_at')
                            ->label(__('Fin'))
                            ->dateTime('d/m/Y H:i'),

                        Infolists\Components\TextEntry::make('created_at')
                            ->label(__('Créé le'))
                            ->dateTime('d/m/Y H:i'),
                    ])->columns(3),
            ]);
    }
}
