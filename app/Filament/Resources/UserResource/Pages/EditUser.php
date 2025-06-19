<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    public function form(Form $form): Form
    {
        $record = $this->record;
        $with_responsible = $record->responsible_name || $record->responsible_phone;

        return $form
            ->schema([
                Section::make('Informations personnelles')
                    ->description('Informations de base de l\'utilisateur')
                    ->icon('heroicon-o-user')
                    ->schema([
                        Grid::make()
                            ->schema([
                                Forms\Components\Select::make('category')
                                    ->label('Categorie')
                                    ->required()
                                    ->options([
                                        'startup' => 'Startup',
                                        'person' => 'Individu',
                                        'entreprise' => 'Gestionnaire',
                                    ]),

                                Forms\Components\TextInput::make('name')
                                    ->label('Nom Startup')
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('email')
                                    ->unique(ignoreRecord: true)
                                    ->label('Adresse email')
                                    ->email()
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('phone')
                                    ->required()
                                    ->label('Téléphone')
                                    ->tel()
                                    ->maxLength(255),

                                Forms\Components\Checkbox::make('with_responsible')
                                    ->label('Informations du responsable')
                                    ->helperText('Cochez cette case si vous souhaitez ajouter les informations du responsable')
                                    ->default($with_responsible)
                                    ->columnSpan(2)
                                    ->reactive(),

                                Forms\Components\TextInput::make('responsible_name')
                                    ->label('Nom et prénom du responsable')
                                    ->disabled(fn (Forms\Get $get) => ! $get('with_responsible'))
                                    ->reactive()
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('responsible_phone')
                                    ->label('Numéro de téléphone du responsable')
                                    ->disabled(fn (Forms\Get $get) => ! $get('with_responsible'))
                                    ->reactive()
                                    ->required()
                                    ->maxLength(255),
                            ]),
                    ]),
            ]);
    }
}
