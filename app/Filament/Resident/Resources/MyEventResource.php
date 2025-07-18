<?php

namespace App\Filament\Resident\Resources;

use App\Enums\PaymentStatus;
use App\Enums\RegistrationStatus;
use App\Filament\Resident\Resources\MyEventResource\Pages;
use App\Models\EventRegistration;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class MyEventResource extends Resource
{
    protected static ?string $model = EventRegistration::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationLabel = 'Mes événements';
    
    protected static ?string $slug = 'my-events';

    public static function getModelLabel(): string
    {
        return __('Mes inscriptions aux événements');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Mes inscriptions aux événements');
    }

    public static function getNavigationLabel(): string
    {
        return __('Mes événements');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Les inscriptions ne sont pas modifiables depuis cette interface
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('event.illustration')
                    ->label(__('Illustration'))
                    ->circular()
                    ->defaultImageUrl('/images/default-event.jpg'),

                Tables\Columns\TextColumn::make('event.title')
                    ->label(__('Événement'))
                    ->description(fn (?EventRegistration $record) => $record && $record->event ? \Str::limit(strip_tags($record->event->getTranslatedAttribute('description') ?: ''), 100) : null)
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('event.start_date')
                    ->label(__('Date de début'))
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('event.end_date')
                    ->label(__('Date de fin'))
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('event.location')
                    ->label(__('Lieu'))
                    ->getStateUsing(fn (?EventRegistration $record) => $record && $record->event ? ($record->event->getTranslatedAttribute('location') ?: ($record->event->is_remote ? __('En ligne') : __('Non spécifié'))) : __('Non spécifié'))
                    ->badge()
                    ->color(fn (?EventRegistration $record) => $record && $record->event && $record->event->is_remote ? 'info' : 'success'),

                Tables\Columns\TextColumn::make('status')
                    ->label(__('Statut inscription'))
                    ->badge()
                    ->color(fn ($state) => $state ? $state->color() : 'gray')
                    ->formatStateUsing(fn ($state) => $state ? $state->label() : '-'),

                Tables\Columns\TextColumn::make('payment_status')
                    ->label(__('Paiement'))
                    ->badge()
                    ->color(fn ($state) => $state ? $state->color() : 'gray')
                    ->formatStateUsing(fn ($state) => $state ? $state->label() : '-')
                    ->visible(fn (?EventRegistration $record) => $record && $record->event && $record->event->is_paid),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Inscrit le'))
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label(__('Statut'))
                    ->options(RegistrationStatus::options()),

                Tables\Filters\SelectFilter::make('payment_status')
                    ->label(__('Paiement'))
                    ->options(PaymentStatus::options()),

                Tables\Filters\Filter::make('upcoming_events')
                    ->label(__('Événements à venir'))
                    ->query(fn (Builder $query): Builder => $query->whereHas('event', fn (Builder $query) => $query->where('start_date', '>', now()))),

                Tables\Filters\Filter::make('past_events')
                    ->label(__('Événements passés'))
                    ->query(fn (Builder $query): Builder => $query->whereHas('event', fn (Builder $query) => $query->where('start_date', '<', now()))),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label(__('Voir l\'événement'))
                    ->url(fn (EventRegistration $record): string => route('events.show', ['slug' => $record->event->getTranslatedAttribute('slug')]))
                    ->visible(fn (?EventRegistration $record) => $record && $record->event)
                    ->openUrlInNewTab(),
            ])
            ->bulkActions([
                // Pas d'actions en masse pour les inscriptions
            ])
            ->emptyStateIcon('heroicon-o-calendar-days')
            ->emptyStateHeading(__('Aucune inscription aux événements'))
            ->emptyStateDescription(__('Vous n\'êtes inscrit à aucun événement pour le moment.'))
            ->emptyStateActions([
                Tables\Actions\Action::make('explore_events')
                    ->label(__('Explorer les événements disponibles'))
                    ->icon('heroicon-o-magnifying-glass')
                    ->url(route('events'))
                    ->color('primary'),
            ])
            ->defaultSort('event.start_date', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            // Pas de relations pour cette vue
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $user = auth('web')->user();
        
        if (!$user) {
            // Si l'utilisateur n'est pas connecté, retourner une requête vide
            return parent::getEloquentQuery()->whereRaw('1 = 0');
        }

        return parent::getEloquentQuery()
            ->with(['event', 'event.translations'])
            ->where('email', $user->email)
            ->orderBy('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMyEvents::route('/'),
            // Pas de création/édition pour les inscriptions depuis cette interface
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
