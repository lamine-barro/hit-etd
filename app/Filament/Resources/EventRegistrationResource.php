<?php

namespace App\Filament\Resources;

use App\Enums\PaymentStatus;
use App\Enums\RegistrationStatus;
use App\Filament\Resources\EventRegistrationResource\Pages;
use App\Models\Event;
use App\Models\EventRegistration;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;

class EventRegistrationResource extends Resource
{
    protected static ?string $model = EventRegistration::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-plus';

    protected static ?string $navigationLabel = 'Inscriptions';

    protected static ?string $modelLabel = 'Inscription';

    protected static ?string $pluralModelLabel = 'Inscriptions';

    protected static ?string $navigationGroup = 'Événements';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public static function table(Table $table): Table
    {
        $currentLocale = App::getLocale();

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
                Tables\Columns\TextColumn::make('translations_title')
                    ->label('Événement')
                    ->state(function (EventRegistration $record) use ($currentLocale) {
                        // Récupérer directement la traduction depuis la relation
                        $translationModel = $record->event->translations()
                            ->where('locale', $currentLocale)
                            ->first();

                        // Si on a une traduction, utiliser son titre
                        if ($translationModel && ! empty($translationModel->title)) {
                            return $translationModel->title;
                        }

                        // Sinon, essayer de récupérer la traduction dans la langue par défaut
                        $defaultTranslation = $record->translations()
                            ->where('locale', $record->default_locale)
                            ->first();

                        if ($defaultTranslation && ! empty($defaultTranslation->title)) {
                            return $defaultTranslation->title;
                        }

                        // Si aucune traduction n'est trouvée, retourner un message
                        return '[Titre manquant]';
                    })
                    ->searchable()
                    ->sortable()
                    ->limit(40),
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
                    ->options(function () {
                        // Récupérer les événements avec leurs traductions dans la langue actuelle
                        $currentLocale = App::getLocale();
                        $events = Event::with(['translations' => function ($query) use ($currentLocale) {
                            $query->where('locale', $currentLocale);
                        }])->get();

                        // Créer un tableau d'options avec l'ID comme clé et le titre traduit comme valeur
                        return $events->mapWithKeys(function ($event) {
                            // Utiliser la traduction dans la langue actuelle si disponible
                            $translation = $event->translations->first();
                            $title = $translation && ! empty($translation->title) ? $translation->title : '[Titre non traduit]';

                            return [$event->id => $title];
                        });
                    })
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
                Tables\Actions\DeleteAction::make()
                    ->label('Supprimer'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Supprimer la sélection'),
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
