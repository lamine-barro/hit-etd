<?php

namespace App\Filament\Resources\EspaceResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class OrdersRelationManager extends RelationManager
{
    protected static string $relationship = 'orders';

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
                Tables\Columns\TextColumn::make('reference')
                    ->label('Référence')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.email')
                    ->label('Utilisateur'),
                Tables\Columns\TextColumn::make('order_date')
                    ->label('Date de commande')
                    ->dateTime('d/m/Y H:i'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Statut'),
                Tables\Columns\TextColumn::make('total_amount')
                    ->label('Montant total'),
                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Méthode de paiement'),
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
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
