<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExpertResource\Pages;
use App\Models\Expert;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ExpertResource extends Resource
{
    protected static ?string $model = Expert::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Demandes';

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
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Nom et prénoms')->searchable(),

                Tables\Columns\TextColumn::make('last_name')->label('Last Name')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('phone')->searchable(),
                Tables\Columns\TextColumn::make('organization')->searchable(),
                Tables\Columns\TextColumn::make('specialties')->label('Specialties'),
                Tables\Columns\TextColumn::make('specialty_other')->label('Other Specialty'),
                Tables\Columns\TextColumn::make('training_types')->label('Training Types'),
                Tables\Columns\TextColumn::make('training_details')->label('Training Details'),
                Tables\Columns\TextColumn::make('target_audience')->label('Target Audience'),
                Tables\Columns\TextColumn::make('intervention_frequency')->label('Intervention Frequency'),
                Tables\Columns\TextColumn::make('intervention_other')->label('Other Intervention'),
                Tables\Columns\TextColumn::make('preferred_days')->label('Preferred Days'),
                Tables\Columns\TextColumn::make('preferred_times')->label('Preferred Times'),
                Tables\Columns\TextColumn::make('remarks')->label('Remarks')->limit(30),
                Tables\Columns\TextColumn::make('cv_path')->label('CV Path')->limit(20),
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
            'index' => Pages\ListExperts::route('/'),
            'create' => Pages\CreateExpert::route('/create'),
            'edit' => Pages\EditExpert::route('/{record}/edit'),
        ];
    }
}
