<?php

namespace App\Filament\Resources\EspaceOrderResource\Pages;

use App\Filament\Resources\EspaceOrderResource;
use App\Models\Espace;
use App\Models\EspaceOrder;
use Filament\Actions;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Enums\MaxWidth;

class ViewEspaceOrder extends ViewRecord
{
    protected static string $resource = EspaceOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('edit')
                ->label('Traiter la commande')
                ->icon('heroicon-o-check')
                ->disabled(fn () => ! $this->record->isPending())
                ->action(function ($data) {
                    $this->record->update($data);
                    $this->record->espaces->each(function ($item) use ($data) {
                        $item->update($data);
                        if ($data['status'] === EspaceOrder::STATUS_CONFIRMED) {
                            $item->espace->update([
                                'status' => Espace::STATUS_RESERVED,
                                'started_at' => $item->started_at,
                                'ended_at' => $item->ended_at,
                            ]);
                            $this->record->user->notify(new \App\Notifications\EspaceOrderConfirmedNotification($this->record));
                            Notification::make()
                                ->title(__('Commande confirmée'))
                                ->success()
                                ->body(__('La commande a été confirmée avec succès.'))
                                ->sendToDatabase($this->record->user);
                        } elseif ($data['status'] === EspaceOrder::STATUS_PENDING) {
                            $item->espace->update(['status' => Espace::STATUS_AVAILABLE]);
                        } elseif ($data['status'] === EspaceOrder::STATUS_CANCELLED) {
                            $item->espace->update(['status' => Espace::STATUS_AVAILABLE]);
                            Notification::make()
                                ->title(__('Commande annulée'))
                                ->success()
                                ->body(__('La commande a été annulée, Veillez fait une autre commande.'))
                                ->sendToDatabase($this->record->user);
                        }
                    });
                })
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

    public function getTitle(): string
    {
        return 'Détails de la réservation';
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Détails de la commande')
                    ->schema([
                        Infolists\Components\TextEntry::make('reference')
                            ->label('Référence'),

                        Infolists\Components\TextEntry::make('user.name')
                            ->label('Résident'),

                        Infolists\Components\TextEntry::make('order_date')
                            ->label('Date de commande')
                            ->dateTime('d/m/Y H:i'),

                        Infolists\Components\TextEntry::make('status')
                            ->label('Statut')
                            ->color(fn ($record) => match ($record->status) {
                                'pending' => 'warning',
                                'confirmed' => 'success',
                                'cancelled' => 'danger',
                                default => 'secondary',
                            })
                            ->icon(fn ($record) => match ($record->status) {
                                'pending' => 'heroicon-o-clock',
                                'confirmed' => 'heroicon-o-check-circle',
                                'cancelled' => 'heroicon-o-x-circle',
                                default => 'heroicon-o-question-mark-circle',
                            }),

                        Infolists\Components\TextEntry::make('total_amount')
                            ->money('XOF')
                            ->label(__('Montant total')),

                        Infolists\Components\TextEntry::make('payment_method')
                            ->label('Méthode de paiement'),
                    ])->columns(3),
            ]);
    }
}
