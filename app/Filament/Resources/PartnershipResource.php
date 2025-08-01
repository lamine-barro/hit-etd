<?php

namespace App\Filament\Resources;

use App\Enums\PartnershipStatus;
use App\Enums\PartnershipType;
use App\Filament\Resources\PartnershipResource\Pages;
use App\Models\Partnership;
use Carbon\Carbon;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

class PartnershipResource extends Resource
{
    protected static ?string $model = Partnership::class;

    protected static ?string $navigationIcon = 'heroicon-o-heart';

    protected static ?string $navigationLabel = 'Partenariats';

    protected static ?string $modelLabel = 'Partenariat';

    protected static ?string $pluralModelLabel = 'Partenariats';

    protected static ?int $navigationSort = 8;

    protected static ?string $recordTitleAttribute = 'organization_name';

    protected static ?string $navigationGroup = 'Demandes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make([
                    'default' => 1,
                    'sm' => 1,
                    'md' => 2,
                ])->schema([
                    Section::make('Informations du demandeur')
                        ->schema([
                            Select::make('type')
                                ->label('Type de partenariat')
                                ->options(PartnershipType::options())
                                ->required()
                                ->native(false),

                            TextInput::make('organization_name')
                                ->label('Nom de l\'organisation')
                                ->required()
                                ->maxLength(255),

                            TextInput::make('contact_name')
                                ->label('Nom du contact')
                                ->required()
                                ->maxLength(255),

                            TextInput::make('email')
                                ->label('Email')
                                ->email()
                                ->required()
                                ->maxLength(255),

                            PhoneInput::make('phone')
                                ->label('Téléphone'),
                        ])->columnSpan(1),

                    Section::make('Détails de la demande')
                        ->schema([
                            Textarea::make('message')
                                ->label('Message')
                                ->required()
                                ->rows(5),

                            Select::make('status')
                                ->label('Statut')
                                ->options(PartnershipStatus::options())
                                ->default(PartnershipStatus::UNTREATED->value)
                                ->required()
                                ->native(false),

                            Textarea::make('internal_notes')
                                ->label('Notes internes')
                                ->placeholder('Notes visibles uniquement par l\'équipe')
                                ->rows(3),

                            DateTimePicker::make('processed_at')
                                ->label('Date de traitement')
                                ->placeholder('Automatiquement rempli lors du changement de statut'),
                        ])->columnSpan(1),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('organization_name')
                    ->label('Organisation')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('contact_name')
                    ->label('Contact')
                    ->searchable()
                    ->sortable(),

                BadgeColumn::make('type')
                    ->label('Type')
                    ->getStateUsing(fn (Partnership $record): string => $record->type->label())
                    ->color(fn (Partnership $record) => $record->type->color())
                    ->sortable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('phone')
                    ->label('Téléphone')
                    ->toggleable(isToggledHiddenByDefault: true),

                BadgeColumn::make('status')
                    ->label('Statut')
                    ->getStateUsing(fn (Partnership $record): string => $record->status->label())
                    ->color(fn (Partnership $record) => $record->status->color())
                    ->icon(fn (Partnership $record) => $record->status->icon())
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Date de demande')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('processed_at')
                    ->label('Date de traitement')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\TrashedFilter::make(),

                SelectFilter::make('type')
                    ->label('Type de partenariat')
                    ->options(PartnershipType::options())
                    ->attribute('type'),

                SelectFilter::make('status')
                    ->label('Statut')
                    ->options(PartnershipStatus::options())
                    ->attribute('status'),
            ])
            ->actions([
                Action::make('approve')
                    ->label('Approuver')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn (Partnership $record): bool => $record->isUntreated())
                    ->action(function (Partnership $record) {
                        $record->status = PartnershipStatus::TREATED;
                        $record->processed_at = Carbon::now();
                        $record->save();

                        Notification::make()
                            ->title('Partenariat approuvé')
                            ->success()
                            ->send();
                    }),

                Action::make('reject')
                    ->label('Refuser')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->visible(fn (Partnership $record): bool => $record->isUntreated())
                    ->action(function (Partnership $record) {
                        $record->status = PartnershipStatus::ARCHIVED;
                        $record->processed_at = Carbon::now();
                        $record->save();

                        Notification::make()
                            ->title('Partenariat refusé')
                            ->danger()
                            ->send();
                    }),

                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->label('Supprimer'),
                Tables\Actions\RestoreAction::make()
                    ->label('Restaurer'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Supprimer la sélection'),
                    Tables\Actions\RestoreBulkAction::make()
                        ->label('Restaurer la sélection'),
                    Tables\Actions\ForceDeleteBulkAction::make()
                        ->label('Supprimer définitivement la sélection'),
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
            'index' => Pages\ListPartnerships::route('/'),
            'create' => Pages\CreatePartnership::route('/create'),
            'edit' => Pages\EditPartnership::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'untreated')->count() ?: null;
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'warning';
    }
}
