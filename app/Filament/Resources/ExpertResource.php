<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Expert;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ExpertResource\Pages;

class ExpertResource extends Resource
{
    protected static ?string $model = Expert::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Hub';

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
                    ->label('Nom et prénoms')
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),

                Tables\Columns\TextColumn::make('phone')->label('Téléphone')->searchable(),

                Tables\Columns\TextColumn::make('organization')->searchable(),

                Tables\Columns\TextColumn::make('specialties')->label('Spécialités')
                    ->badge()
                    ->searchable(),

                Tables\Columns\TextColumn::make('specialty_other')->label('Autre Spécialité')
                    ->formatStateUsing(fn ($state) => $state ?: 'Aucune'),

                Tables\Columns\TextColumn::make('training_types')->label('Types de Formation')
                    ->badge()
                    ->searchable(),

                Tables\Columns\TextColumn::make('training_details')->label('Détails de la Formation')
                    ->limit(30),

                Tables\Columns\TextColumn::make('target_audience')->label('Public Cible')
                    ->badge()
                    ->searchable(),

                Tables\Columns\TextColumn::make('intervention_frequency')->label('Fréquence d\'Intervention')
                    ->badge()
                    ->searchable(),

                Tables\Columns\TextColumn::make('intervention_other')->label('Autre Fréquence')
                    ->formatStateUsing(fn ($state) => $state ?: 'Aucune'),

                Tables\Columns\TextColumn::make('preferred_days')->label('Jours Préférés')
                    ->searchable(),

                Tables\Columns\TextColumn::make('preferred_times')->label('Heures Préférées')
                    ->badge()
                    ->searchable(),

                Tables\Columns\TextColumn::make('remarks')
                    ->label('Remarques')->limit(30),

                Tables\Columns\TextColumn::make('cv_path')
                    ->label('CV')->limit(20),
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

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->orderBy('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExperts::route('/'),
            // 'create' => Pages\CreateExpert::route('/create'),
            // 'edit' => Pages\EditExpert::route('/{record}/edit'),
        ];
    }
}
