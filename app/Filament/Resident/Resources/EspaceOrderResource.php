<?php

namespace App\Filament\Resident\Resources;

use App\Filament\Resident\Resources\EspaceOrderResource\Pages;
use App\Models\EspaceOrder;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EspaceOrderResource extends Resource
{
    protected static ?string $model = EspaceOrder::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEspaceOrders::route('/'),
            'create' => Pages\CreateEspaceOrder::route('/create'),
            'edit' => Pages\EditEspaceOrder::route('/{record}/edit'),
        ];
    }
}
