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

    public function getTitle(): string
    {
        return 'Modifier le résident';
    }

    public function form(Form $form): Form
    {
        $record = $this->record;


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

                                Forms\Components\FileUpload::make('profile_picture')
                                    ->label('Photo de profil')
                                    ->image()
                                    ->directory('avatars/residents')
                                    ->visibility('public')
                                    ->columnSpanFull(),

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

                                Forms\Components\Textarea::make('needs')
                                    ->label('Besoins spécifiques')
                                    ->columnSpanFull()
                                    ->rows(3)
                                    ->placeholder('Décrivez les besoins spécifiques du résident...'),

                            ]),
                    ]),
            ]);
    }
}
