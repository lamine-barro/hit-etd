<?php

namespace App\Filament\Resources;

use App\Enums\PaymentStatus;
use App\Enums\RegistrationStatus;
use App\Filament\Resources\EventRegistrationResource\Pages;
use App\Filament\Resources\EventRegistrationResource\RelationManagers;
use App\Models\Event;
use App\Models\EventRegistration;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class EventRegistrationResource extends Resource
{
    protected static ?string $model = EventRegistration::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';
    
    protected static ?string $navigationLabel = 'Inscriptions';
    
    protected static ?string $modelLabel = 'Inscription';
    
    protected static ?string $pluralModelLabel = 'Inscriptions';
    
    protected static ?string $navigationGroup = 'Événements';
    
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informations du participant')
                    ->schema([
                        Forms\Components\TextInput::make('uuid')
                            ->label('Identifiant unique')
                            ->default(fn () => Str::uuid())
                            ->disabled()
                            ->dehydrated(),
                        Forms\Components\TextInput::make('name')
                            ->label('Nom complet')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('whatsapp')
                            ->label('WhatsApp')
                            ->tel()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('position')
                            ->label('Fonction/Position')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('organization')
                            ->label('Organisation')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('country')
                            ->label('Pays')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('actor_type')
                            ->label('Type d\'acteur')
                            ->maxLength(255),
                    ])->columns(2),
                    
                Forms\Components\Section::make('Informations de l\'événement')
                    ->schema([
                        Forms\Components\Select::make('event_id')
                            ->label('Événement')
                            ->relationship('event', 'title')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->label('Statut')
                            ->options(RegistrationStatus::options())
                            ->default(RegistrationStatus::PENDING->value)
                            ->required(),
                    ])->columns(2),
                    
                Forms\Components\Section::make('Informations de paiement')
                    ->schema([
                        Forms\Components\Select::make('payment_status')
                            ->label('Statut du paiement')
                            ->options(PaymentStatus::options())
                            ->default(PaymentStatus::PENDING->value)
                            ->required(),
                        Forms\Components\TextInput::make('amount_paid')
                            ->label('Montant payé')
                            ->numeric()
                            ->prefix('XOF')
                            ->default(0),
                        Forms\Components\TextInput::make('payment_reference')
                            ->label('Référence de paiement')
                            ->maxLength(255),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('uuid')
                    ->label('ID')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nom')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('event.title')
                    ->label('Événement')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (RegistrationStatus $state): string => $state->color())
                    ->formatStateUsing(fn (RegistrationStatus $state): string => $state->label())
                    ->icon(fn (RegistrationStatus $state): string => $state->icon()),
                Tables\Columns\TextColumn::make('payment_status')
                    ->label('Paiement')
                    ->badge()
                    ->color(fn (PaymentStatus $state): string => $state->color())
                    ->formatStateUsing(fn (PaymentStatus $state): string => $state->label())
                    ->icon(fn (PaymentStatus $state): string => $state->icon()),
                Tables\Columns\TextColumn::make('amount_paid')
                    ->label('Montant payé')
                    ->money('XOF')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date d\'inscription')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('event_id')
                    ->label('Événement')
                    ->relationship('event', 'title')
                    ->searchable()
                    ->preload(),
                Tables\Filters\SelectFilter::make('status')
                    ->label('Statut')
                    ->options(RegistrationStatus::options()),
                Tables\Filters\SelectFilter::make('payment_status')
                    ->label('Statut du paiement')
                    ->options(PaymentStatus::options()),
                Tables\Filters\Filter::make('created_at')
                    ->label('Date d\'inscription')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Depuis'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Jusqu\'à'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Voir'),
                Tables\Actions\EditAction::make()
                    ->label('Modifier'),
                Tables\Actions\DeleteAction::make()
                    ->label('Supprimer'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('updateStatus')
                        ->label('Mettre à jour le statut')
                        ->icon('heroicon-o-check-circle')
                        ->form([
                            Forms\Components\Select::make('status')
                                ->label('Statut')
                                ->options(RegistrationStatus::options())
                                ->required(),
                        ])
                        ->action(function (array $records, array $data): void {
                            foreach ($records as $record) {
                                $record->update(['status' => $data['status']]);
                            }
                        }),
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
            'index' => Pages\ListEventRegistrations::route('/'),
            'create' => Pages\CreateEventRegistration::route('/create'),
            'view' => Pages\ViewEventRegistration::route('/{record}'),
            'edit' => Pages\EditEventRegistration::route('/{record}/edit'),
        ];
    }
}
