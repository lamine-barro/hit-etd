<?php

namespace App\Filament\Resources\EspaceOrderResource\RelationManagers;

use App\Models\EspaceOrderItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class OrderItemRelationManager extends RelationManager
{
    protected static string $relationship = 'espaces';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->heading('')
            ->columns([
                Tables\Columns\TextColumn::make('espace.code')
                    ->label('#Référence')
                    ->searchable(),

                Tables\Columns\TextColumn::make('espace.name')
                    ->label('Nom de l\'espace'),

                Tables\Columns\TextColumn::make('price')
                    ->money('XOF')
                    ->label('Prix'),

                Tables\Columns\TextColumn::make('quantity')
                    ->label('Quantité'),

                Tables\Columns\TextColumn::make('total_amount')
                    ->money('XOF')
                    ->state(fn ($record) => $record->price * $record->quantity)
                    ->label('Montant total'),

                Tables\Columns\TextColumn::make('status')
                    ->label(__('Statut'))
                    ->color(fn (EspaceOrderItem $record) => match ($record->status) {
                        'pending' => 'warning',
                        'confirmed' => 'success',
                        'cancelled' => 'danger',
                        default => 'secondary',
                    })
                    ->icon(fn (EspaceOrderItem $record) => match ($record->status) {
                        'pending' => 'heroicon-o-clock',
                        'confirmed' => 'heroicon-o-check-circle',
                        'rejected' => 'heroicon-o-x-circle',
                        default => 'heroicon-o-question-mark-circle',
                    }),

                Tables\Columns\TextColumn::make('started_at')
                    ->label('Début')
                    ->dateTime('d/m/Y H:i'),

                Tables\Columns\TextColumn::make('ended_at')
                    ->label('Fin')
                    ->dateTime('d/m/Y H:i'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime('d/m/Y H:i'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Modifier')
                    ->disabled(fn ($record) => $record->espace->isPending()),

                Tables\Actions\DeleteAction::make()
                    ->label('Supprimer')
                    ->disabled(fn ($record) => $record->espace->isPending())
                    ->requiresConfirmation(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
