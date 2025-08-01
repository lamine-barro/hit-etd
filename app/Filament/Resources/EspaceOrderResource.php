<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EspaceOrderResource\Pages;
use App\Filament\Resources\EspaceOrderResource\RelationManagers\OrderItemRelationManager;
use App\Models\EspaceOrder;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EspaceOrderResource extends Resource
{
    protected static ?string $model = EspaceOrder::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?string $navigationLabel = 'Réservations';

    protected static ?string $modelLabel = 'Réservation';

    protected static ?string $pluralModelLabel = 'Réservations';

    protected static ?string $navigationGroup = 'Espaces';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'pending')->count();
    }

    protected static ?int $navigationSort = 7;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reference')
                    ->label('Référence')
                    ->searchable(),

                Tables\Columns\TextColumn::make('user.email')
                    ->description(fn ($record) => $record->user->full_name)
                    ->label('Utilisateur'),

                Tables\Columns\TextColumn::make('order_date')
                    ->label('Date de commande')
                    ->dateTime('d/m/Y H:i'),

                Tables\Columns\TextColumn::make('status')
                    ->label('Statut')
                    ->color(fn ($state) => match ($state) {
                        'pending' => 'warning',
                        'confirmed' => 'success',
                        'cancelled' => 'danger',
                        default => 'secondary',
                    })
                    ->icon(fn ($state) => match ($state) {
                        'pending' => 'heroicon-o-clock',
                        'confirmed' => 'heroicon-o-check-circle',
                        'cancelled' => 'heroicon-o-x-circle',
                        default => 'heroicon-o-question-mark-circle',
                    }),

                Tables\Columns\TextColumn::make('total_amount')
                    ->money('XOF')
                    ->label('Montant total'),

                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Méthode de paiement'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime('d/m/Y H:i'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->disabled(fn ($record) => ! $record->isPending())
                    ->label('Modifier'),

                Tables\Actions\DeleteAction::make()
                    ->label('Supprimer'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                    ->label('Supprimer la sélection'),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            OrderItemRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEspaceOrders::route('/'),
            // 'create' => Pages\CreateEspaceOrder::route('/create'),
            // 'edit' => Pages\EditEspaceOrder::route('/{record}/edit'),
            'view' => Pages\ViewEspaceOrder::route('/{record}'),
        ];
    }
}
