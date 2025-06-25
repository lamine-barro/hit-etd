<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Booking;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Support\Enums\MaxWidth;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\BookingResource\Pages;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Demandes';

    public static function getModelLabel(): string
    {
        return 'Visite';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Demandes de visite';
    }

    public static function getNavigationLabel(): string
    {
        return 'Visites';
    }

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
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Nom et Prénom')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Statut')
                    ->color(fn ($record) => match ($record->status) {
                        'pending' => 'warning',
                        'confirmed' => 'success',
                        'cancelled' => 'danger',
                        default => 'secondary',
                    })
                    ->icon(fn ($record) => match ($record->status) {
                        'pending' => 'heroicon-o-clock',
                        'confirmed' => 'heroicon-o-check',
                        'cancelled' => 'heroicon-o-x',
                        default => 'heroicon-o-question-mark-circle',
                    })
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Téléphone')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('date')
                    ->label('Date')
                    ->date()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('time')
                    ->label('Heure')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('purpose')
                    ->label('Objectif')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('spaces')
                    ->label('Espaces')
                    // ->formatStateUsing(fn ($state) => implode(', ', $state))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('message')
                    ->label('Message')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Valider')
                    ->icon('heroicon-o-check')
                    ->form([
                        Select::make('status')
                            ->label('Statut')
                            ->options([
                                'confirmed' => 'Confirmée',
                                'cancelled' => 'Annulée',
                            ])
                            ->default('pending')
                            ->required(),
                    ])
                    ->modalHeading('Valider la demande de visite')
                    ->modalSubmitActionLabel('Valider')
                    ->modalWidth(MaxWidth::Small)
                    ->action(function ($record, array $data) {
                        $record->update(['status' => $data['status']]);
                    })->color('success'),

                Tables\Actions\DeleteAction::make()
                    ->label('Archiver')
                    ->icon('heroicon-o-trash')
                    ->requiresConfirmation()
                    ->color('danger')
                    ->disabled(fn ($record) => $record->status === 'confirmed')
                    ->action(function ($record) {
                        $record->delete();
                    }),
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
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            // 'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
