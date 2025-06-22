<?php

namespace App\Filament\Resident\Resources;

use App\Filament\Resident\Resources\EspaceOrderResource\Pages;
use App\Filament\Resources\EspaceOrderResource\RelationManagers\OrderItemRelationManager;
use App\Models\Espace;
use App\Models\EspaceOrder;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EspaceOrderResource extends Resource
{
    protected static ?string $model = EspaceOrder::class;

    protected static ?string $navigationIcon = 'heroicon-s-ticket';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Réservations d\'espaces';

    protected static ?string $modelLabel = 'Réservation d\'espace';

    protected static ?string $pluralModelLabel = 'Réservations d\'espaces';

    protected static ?string $slug = 'espace-orders';

    protected static ?string $recordTitleAttribute = 'reference';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informations de réservation')
                    ->columns(2)
                    ->schema([
                        Forms\Components\DateTimePicker::make('started_at')
                            ->prefix('Début : ')
                            ->minDate(now())
                            ->helperText('Date et heure de début de la réservation')
                            ->label('Début'),

                        Forms\Components\DateTimePicker::make('ended_at')
                            ->prefix('Fin : ')
                            ->minDate(now())
                            ->helperText('Date et heure de fin de la réservation')
                            ->label('Fin'),

                        Forms\Components\TextInput::make('notes')
                            ->helperText('Notes ou instructions spéciales pour la réservation')
                            ->label('Notes'),

                        Forms\Components\Select::make('payment_method')
                            ->options(EspaceOrder::PAYMENT_METHODS)
                            ->helperText('Méthode de paiement utilisée pour cette réservation')
                            ->label('Méthode de paiement'),
                    ]),

                Forms\Components\Section::make('Informations les espaces')
                    ->description('Informations sur l\'espace réservé')
                    ->schema([
                        Forms\Components\Repeater::make('espaces')
                            ->label('Espaces réservés')
                            ->addActionLabel('Ajouter un espace')
                            ->schema([
                                Forms\Components\Select::make('type')
                                    ->label('Type d\'espace')
                                    ->options(Espace::FR_TYPES)
                                    ->reactive()
                                    ->helperText('Type d\'espace réservé')
                                    ->required(),

                                Forms\Components\Select::make('espace_id')
                                    ->label('Espace')
                                    ->reactive()
                                    ->disabled(fn (Forms\Get $get) => ! $get('type'))
                                    ->options(function (Forms\Get $get) {
                                        return Espace::where('type', $get('type'))
                                            ->pluck('name', 'id');
                                    })
                                    ->searchable()
                                    ->helperText('Sélectionnez l\'espace à réserver')
                                    ->required(),

                                Forms\Components\TextInput::make('quantity')
                                    ->label('Quantité')
                                    ->disabled(fn (Forms\Get $get) => ! $get('espace_id'))
                                    ->numeric()
                                    ->reactive()
                                    ->minValue(1)
                                    ->default(1)
                                    ->required(),
                            ])->columns(3),
                    ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reference')
                    ->label('Référence')
                    ->searchable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->description(fn (EspaceOrder $record) => $record->user->email)
                    ->label('Utilisateur'),

                Tables\Columns\TextColumn::make('order_date')
                    ->label('Date de commande')
                    ->dateTime('d/m/Y H:i'),

                Tables\Columns\TextColumn::make('status')
                    ->label('Statut')
                    ->color(fn (EspaceOrder $record) => match ($record->status) {
                        'pending' => 'warning',
                        'confirmed' => 'success',
                        'cancelled' => 'danger',
                        default => 'secondary',
                    })
                    ->icon(fn (EspaceOrder $record) => match ($record->status) {
                        'pending' => 'heroicon-o-clock',
                        'confirmed' => 'heroicon-o-check-circle',
                        'rejected' => 'heroicon-o-x-circle',
                        default => 'heroicon-o-question-mark-circle',
                    }),

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
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Voir'),

                Tables\Actions\EditAction::make()
                    ->label('Modifier')
                    ->disabled(fn (EspaceOrder $record) => ! $record->isPending()),

                Tables\Actions\DeleteAction::make()
                    ->label('Annuler')
                    ->disabled(fn (EspaceOrder $record) => ! $record->isPending()),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
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
            'create' => Pages\CreateEspaceOrder::route('/create'),
            'edit' => Pages\EditEspaceOrder::route('/{record}/edit'),
            'view' => Pages\ViewEspaceOrder::route('/{record}'),
        ];
    }
}
