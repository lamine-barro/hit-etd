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
                Infolists\Components\Section::make('Détails de la commande')
                    ->schema([
                        Infolists\Components\TextEntry::make('reference')
                            ->label('Référence'),

                        Infolists\Components\TextEntry::make('user.email')
                            ->label('Utilisateur'),

                        Infolists\Components\TextEntry::make('order_date')
                            ->label('Date de commande')
                            ->dateTime('d/m/Y H:i'),

                        Infolists\Components\TextEntry::make('status')
                            ->label('Statut'),

                        Infolists\Components\TextEntry::make('total_amount')
                            ->label('Montant total'),

                        Infolists\Components\TextEntry::make('payment_method')
                            ->label('Méthode de paiement'),

                        Infolists\Components\TextEntry::make('started_at')
                            ->label('Début')
                            ->dateTime('d/m/Y H:i'),

                        Infolists\Components\TextEntry::make('ended_at')
                            ->label('Fin')
                            ->dateTime('d/m/Y H:i'),

                        Infolists\Components\TextEntry::make('created_at')
                            ->label('Créé le')
                            ->dateTime('d/m/Y H:i'),
                    ])->columns(3),
            ]);
    }
}
