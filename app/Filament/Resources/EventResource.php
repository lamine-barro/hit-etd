<?php

namespace App\Filament\Resources;

use App\Enums\Currency;
use App\Enums\EventStatus;
use App\Enums\EventType;
use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Models\Administrator;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';    
    protected static ?string $navigationGroup = 'Événements';
    protected static ?string $navigationLabel = 'Événements';
    protected static ?string $modelLabel = 'Événement';
    protected static ?string $pluralModelLabel = 'Événements';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informations générales')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Titre')
                            ->required()
                            ->columnSpanFull()
                            ->maxLength(255),
                        Forms\Components\Select::make('type')
                            ->label('Type d\'événement')
                            ->options(array_combine(EventType::values(), array_map(fn ($type) => EventType::from($type)->label(), EventType::values())))
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->label('Statut')
                            ->options(array_combine(EventStatus::values(), array_map(fn ($status) => EventStatus::from($status)->label(), EventStatus::values())))
                            ->default(EventStatus::DRAFT->value)
                            ->required(),
                        Forms\Components\RichEditor::make('description')
                            ->label('Description')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('illustration')
                            ->label('Image principale')
                            ->image()
                            ->directory('events/illustrations')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                    
                Forms\Components\Section::make('Dates et lieu')
                    ->schema([
                        Forms\Components\DateTimePicker::make('start_date')
                            ->label('Date de début')
                            ->required(),
                        Forms\Components\DateTimePicker::make('end_date')
                            ->label('Date de fin')
                            ->after('start_date'),
                        Forms\Components\TextInput::make('location')
                            ->label('Lieu')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Toggle::make('is_remote')
                            ->label('En ligne')
                            ->helperText('Cochez si l\'événement se déroule en ligne')
                            ->default(false),
                        Forms\Components\TextInput::make('external_link')
                            ->label('Lien externe')
                            ->url()
                            ->maxLength(255)
                            ->visible(fn (Get $get): bool => $get('is_remote')),
                    ])
                    ->columns(2),
                    
                Forms\Components\Section::make('Inscriptions')
                    ->schema([
                        Forms\Components\TextInput::make('max_participants')
                            ->label('Nombre maximum de participants')
                            ->required()
                            ->numeric()
                            ->minValue(1),
                        Forms\Components\DateTimePicker::make('registration_end_date')
                            ->label('Date limite d\'inscription')
                            ->required()
                            ->before('start_date'),
                    ])
                    ->columns(2),
                    
                Forms\Components\Section::make('Tarification')
                    ->schema([
                        Forms\Components\Toggle::make('is_paid')
                            ->label('Événement payant')
                            ->default(false)
                            ->live(),
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('price')
                                    ->label('Prix')
                                    ->numeric()
                                    ->minValue(0)
                                    ->required(fn (Get $get): bool => $get('is_paid'))
                                    ->visible(fn (Get $get): bool => $get('is_paid')),
                                Forms\Components\Select::make('currency')
                                    ->label('Devise')
                                    ->options(array_combine(Currency::values(), array_map(fn ($currency) => Currency::from($currency)->label() . ' (' . Currency::from($currency)->symbol() . ')', Currency::values())))
                                    ->default(Currency::XOF->value)
                                    ->required()
                                    ->visible(fn (Get $get): bool => $get('is_paid')),
                            ]),
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('early_bird_price')
                                    ->label('Prix early bird')
                                    ->helperText('Prix réduit pour les inscriptions anticipées')
                                    ->numeric()
                                    ->minValue(0)
                                    ->visible(fn (Get $get): bool => $get('is_paid')),
                                Forms\Components\DateTimePicker::make('early_bird_end_date')
                                    ->label('Date limite early bird')
                                    ->before('start_date')
                                    ->visible(fn (Get $get): bool => $get('is_paid') && $get('early_bird_price')),
                            ]),
                    ]),
                    
                Forms\Components\Hidden::make('created_by')
                    ->dehydrateStateUsing(fn () => auth()->user()->id ?? null)
                    ->default(fn () => auth()->user()->id ?? null)
                    ->required()
                    ->visibleOn('create'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('illustration')
                    ->label('Image')
                    ->circular()
                    ->defaultImageUrl(fn () => asset('images/event-placeholder.jpg'))
                    ->width(50)
                    ->height(50),
                Tables\Columns\TextColumn::make('title')
                    ->label('Titre')
                    ->searchable()
                    ->sortable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('type')
                    ->label('Type')
                    ->formatStateUsing(fn (string $state): string => EventType::from($state)->label())
                    ->badge()
                    ->color(fn (string $state): string => match($state) {
                        EventType::CONFERENCE->value => 'primary',
                        EventType::WORKSHOP->value => 'warning',
                        EventType::WEBINAR->value => 'info',
                        EventType::MEETUP->value => 'success',
                        EventType::TRAINING->value => 'danger',
                        EventType::HACKATHON->value => 'purple',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('start_date')
                    ->label('Date')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('location')
                    ->label('Lieu')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\IconColumn::make('is_remote')
                    ->label('En ligne')
                    ->boolean()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('max_participants')
                    ->label('Participants max')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Prix')
                    ->formatStateUsing(function ($state, $record) {
                        if (!$record->is_paid) return new HtmlString('<span class="text-success">Gratuit</span>');
                        return number_format($state, 0, ',', ' ') . ' ' . Currency::from($record->currency)->symbol();
                    })
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Statut')
                    ->formatStateUsing(fn (string $state): string => EventStatus::from($state)->label())
                    ->badge()
                    ->color(fn (string $state): string => match($state) {
                        EventStatus::PUBLISHED->value => 'success',
                        EventStatus::DRAFT->value => 'gray',
                        EventStatus::CANCELLED->value => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('createdBy.first_name')
                    ->label('Créé par')
                    ->formatStateUsing(fn ($state, $record) => $record->createdBy ? $record->createdBy->first_name . ' ' . $record->createdBy->last_name : '-')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Mis à jour le')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->label('Supprimé le')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\SelectFilter::make('type')
                    ->label('Type d\'événement')
                    ->options(array_combine(EventType::values(), array_map(fn ($type) => EventType::from($type)->label(), EventType::values()))),
                Tables\Filters\SelectFilter::make('status')
                    ->label('Statut')
                    ->options(array_combine(EventStatus::values(), array_map(fn ($status) => EventStatus::from($status)->label(), EventStatus::values()))),
                Tables\Filters\Filter::make('is_paid')
                    ->label('Événements payants')
                    ->query(fn (Builder $query): Builder => $query->where('is_paid', true)),
                Tables\Filters\Filter::make('is_free')
                    ->label('Événements gratuits')
                    ->query(fn (Builder $query): Builder => $query->where('is_paid', false)),
                Tables\Filters\Filter::make('upcoming')
                    ->label('À venir')
                    ->query(fn (Builder $query): Builder => $query->where('start_date', '>=', now())),
                Tables\Filters\Filter::make('past')
                    ->label('Passés')
                    ->query(fn (Builder $query): Builder => $query->where('start_date', '<', now())),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'view' => Pages\ViewEvent::route('/{record}'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
