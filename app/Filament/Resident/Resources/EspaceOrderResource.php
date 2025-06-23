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
use Illuminate\Database\Eloquent\Builder;

class EspaceOrderResource extends Resource
{
    protected static ?string $model = EspaceOrder::class;

    protected static ?string $navigationIcon = 'heroicon-s-ticket';

    protected static ?int $navigationSort = 2;

    protected static ?string $slug = 'espace-orders';

    protected static ?string $recordTitleAttribute = 'reference';

    public function getTitle(): string
    {
        return __('Mise à jour du profil');
    }

    public static function getModelLabel(): string
    {
        return __("Réservations d'espaces");
    }

    public static function getPluralModelLabel(): string
    {
        return __("Réservations d'espaces");
    }

    public static function getNavigationLabel(): string
    {
        return __("Réservations d'espaces");
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('Informations de réservation'))
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('notes')
                            ->helperText(__('Notes ou instructions spéciales pour la réservation'))
                            ->label(__('Notes')),

                        Forms\Components\Select::make('payment_method')
                            ->options(EspaceOrder::PAYMENT_METHODS)
                            ->helperText(__('Méthode de paiement utilisée pour cette réservation'))
                            ->label(__('Méthode de paiement')),
                    ]),

                Forms\Components\Section::make(__('Informations les espaces'))
                    ->description(__('Informations sur l\'espace réservé'))
                    ->schema([
                        Forms\Components\Repeater::make('espaces')
                            ->label(__('Espaces réservés'))
                            ->addActionLabel(__('Ajouter un espace'))
                            ->schema([
                                Forms\Components\Select::make('type')
                                    ->label(__("Type d'espace"))
                                    ->options(Espace::FR_TYPES)
                                    ->reactive()
                                    ->helperText(__("Type d'espace réservé"))
                                    ->required(),

                                Forms\Components\Select::make('espace_id')
                                    ->label(__('Espace'))
                                    ->reactive()
                                    ->disabled(fn (Forms\Get $get) => ! $get('type'))
                                    ->options(function (Forms\Get $get) {
                                        return Espace::where('type', $get('type'))
                                            ->where('is_active', true)
                                            ->pluck('name', 'id');
                                    })
                                    ->searchable()
                                    ->helperText(__("Sélectionnez l'espace à réserver"))
                                    ->required(),

                                Forms\Components\TextInput::make('quantity')
                                    ->label(__('Quantité'))
                                    ->disabled(fn (Forms\Get $get) => ! $get('espace_id'))
                                    ->numeric()
                                    ->reactive()
                                    ->minValue(1)
                                    ->default(1)
                                    ->required(),

                                Forms\Components\TextInput::make('number_of_people')
                                    ->numeric()
                                    ->disabled(fn (Forms\Get $get) => ! $get('type'))
                                    ->minValue(1)
                                    ->default(1)
                                    ->label(__('Nombre de personnes'))
                                    ->helperText(__('Nombre de personnes pouvant utiliser cet espace')),

                                Forms\Components\DateTimePicker::make('started_at')
                                    ->prefix(__('Début : '))
                                    ->reactive()
                                    ->required()
                                    ->disabled(fn (Forms\Get $get) => ! $get('type'))
                                    ->minDate(function (Forms\Get $get) {
                                        $espace = Espace::find($get('espace_id'));
                                        if ($espace && $espace->ended_at && $espace->ended_at->isFuture()) {
                                            return $espace->ended_at->addMonths(3);
                                        }

                                        return now();
                                    })
                                    ->helperText(__('Date et heure de début de la réservation'))
                                    ->label(__('Début')),

                                Forms\Components\DateTimePicker::make('ended_at')
                                    ->disabled(fn (Forms\Get $get) => ! $get('type'))
                                    ->reactive()
                                    ->required()
                                    ->prefix(__('Fin : '))
                                    ->minDate(function (Forms\Get $get) {
                                        $espace = Espace::find($get('espace_id'));
                                        if ($espace && $espace->ended_at && $espace->ended_at->isFuture()) {
                                            return $espace->ended_at->addMonths(3);
                                        }

                                        return now();
                                    })
                                    ->minDate(now())
                                    ->helperText(__('Date et heure de fin de la réservation'))
                                    ->label(__('Fin')),
                            ])->columns(3),
                    ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateDescription(__('Vous n\'avez aucune réservation en cours. Réservez un espace en cliquant sur le bouton ci-dessus "créer une réservation"'))
            ->columns([
                Tables\Columns\TextColumn::make('reference')
                    ->label(__('Référence'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->description(fn (EspaceOrder $record) => $record->user->email)
                    ->label(__('Utilisateur')),

                Tables\Columns\TextColumn::make('order_date')
                    ->label(__('Date de commande'))
                    ->dateTime('d/m/Y H:i'),

                Tables\Columns\TextColumn::make('status')
                    ->label(__('Statut'))
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
                    ->state(fn (EspaceOrder $record) => number_format($record->total_amount, 2, ',', ' '))
                    ->label(__('Montant total')),

                Tables\Columns\TextColumn::make('payment_method')
                    ->label(__('Méthode de paiement')),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Créé le'))
                    ->dateTime('d/m/Y H:i'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),

                Tables\Actions\EditAction::make()
                    ->disabled(fn (EspaceOrder $record) => ! $record->isPending()),

                Tables\Actions\DeleteAction::make()
                    ->label(__('Annuler'))
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

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('user_id', auth('web')->id())
            ->orderBy('created_at', 'desc');
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
