<?php

namespace App\Filament\Resources\EspaceOrderResource\Pages;

use App\Filament\Resources\EspaceOrderResource;
use Filament\Actions;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Enums\MaxWidth;

class ViewEspaceOrder extends ViewRecord
{
    protected static string $resource = EspaceOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('edit')
                ->label('Valider la commande')
                ->icon('heroicon-o-check')
                ->disabled(fn () => $this->record->status !== 'pending')
                ->action(fn () => $this->record->update(['status' => 'confirmed']))
                ->requiresConfirmation()
                ->modalWidth(MaxWidth::Small)
                ->modalHeading('Modifier le statut de la commande')
                ->form([
                    \Filament\Forms\Components\Select::make('status')
                        ->label('Statut de la commande')
                        ->options([
                            'confirmed' => 'Confirmée',
                            'cancelled' => 'Annulée',
                        ])
                        ->default('pending')
                        ->required(),
                ]),
            Actions\Action::make('delete')
                ->label('Supprimer')
                ->color('danger')
                ->icon('heroicon-o-trash')
                ->requiresConfirmation()
                ->action(fn () => $this->record->delete()),
        ];
    }

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
