<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Audience;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Enums\AudienceType;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;
use App\Filament\Resources\AudienceResource\Pages;
use Ysfkaya\FilamentPhoneInput\Tables\PhoneColumn;

class AudienceResource extends Resource
{
    protected static ?string $model = Audience::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Audiences';

    protected static ?string $modelLabel = 'Audience';

    protected static ?string $pluralModelLabel = 'Audiences';

    protected static ?string $navigationGroup = 'Personnes';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    protected static ?int $navigationSort = 10;

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informations personnelles')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nom')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        PhoneInput::make('whatsapp')
                            ->label('Numéro WhatsApp')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Préférences de communication')
                    ->schema([
                        Forms\Components\Toggle::make('newsletter_email')
                            ->label('Recevoir la newsletter par email')
                            ->required(),
                        Forms\Components\Toggle::make('newsletter_whatsapp')
                            ->label('Recevoir la newsletter par WhatsApp')
                            ->required(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Centres d\'intérêt')
                    ->schema([
                        Forms\Components\CheckboxList::make('interests')
                            ->label('Intérêts')
                            ->options(function () {
                                $options = [];
                                foreach (AudienceType::cases() as $type) {
                                    $options[$type->value] = $type->label();
                                }

                                return $options;
                            })
                            ->columns(2)
                            ->helperText('Sélectionnez les sujets qui intéressent cette audience'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nom')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                PhoneColumn::make('whatsapp')
                    ->label('N° WhatsApp')
                    ->searchable(),
                Tables\Columns\IconColumn::make('newsletter_email')
                    ->label('Email')
                    ->boolean(),
                Tables\Columns\IconColumn::make('newsletter_whatsapp')
                    ->label('WhatsApp')
                    ->boolean(),
                Tables\Columns\TagsColumn::make('interests')
                    ->label('Intérêts')
                    ->getStateUsing(function (Audience $record): array {
                        $labels = [];
                        foreach ($record->getInterestTypes() as $type) {
                            $labels[] = $type->label();
                        }

                        return $labels;
                    })
                    ->colors([
                        'primary',
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Modifié le')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->label('Supprimé le')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->orderBy('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageAudiences::route('/'),
        ];
    }
}
