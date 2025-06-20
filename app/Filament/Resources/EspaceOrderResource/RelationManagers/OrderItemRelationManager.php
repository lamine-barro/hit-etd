<?php

namespace App\Filament\Resources\EspaceOrderResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class OrderItemRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

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
                    ->label('Référence de l\'espace')
                    ->searchable(),

                Tables\Columns\TextColumn::make('espace.name')
                    ->label('Nom de l\'espace'),

                Tables\Columns\TextColumn::make('price')
                    ->formatStateUsing(fn ($state) => number_format($state, 2, ',', ' '))
                    ->label('Prix'),

                Tables\Columns\TextColumn::make('quantity')
                    ->label('Quantité'),

                Tables\Columns\TextColumn::make('total_amount')
                    ->formatStateUsing(fn ($state) => number_format($state, 2, ',', ' '))
                    ->state(fn ($record) => $record->price * $record->quantity)
                    ->label('Montant total'),

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
