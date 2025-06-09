<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EspaceResource\Pages;
use App\Models\Espace;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EspaceResource extends Resource
{
    protected static ?string $model = Espace::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Espaces';

    protected static ?string $modelLabel = 'Espace';

    protected static ?string $pluralModelLabel = 'Espaces';

    protected static ?string $navigationGroup = 'Résidents';

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
            'index' => Pages\ListEspaces::route('/'),
            'create' => Pages\CreateEspace::route('/create'),
            'edit' => Pages\EditEspace::route('/{record}/edit'),
        ];
    }
}
