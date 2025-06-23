<?php

namespace App\Filament\Resident\Pages;

use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;

class EditProfile extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.resident.pages.profile';

    protected static ?string $navigationLabel = 'Profil';

    public ?array $data = [];

    public User|Authenticatable $user;

    public function getTitle(): string
    {
        return __('Mise à jour du profil');
    }

    public static function getNavigationLabel(): string
    {
        return __('Profil');
    }

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public function mount(): void
    {
        $this->user = auth('web')->user();

        if (! $this->user) {
            $this->redirect(route('filament.resident.auth.login'));
        } else {
            $this->form->fill($this->user->toArray());
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Entreprise')
                            ->description('Information générale de l\'entreprise')
                            ->schema([

                                Forms\Components\TextInput::make('name')
                                    ->label('Nom Startup')
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('email')
                                    ->unique(ignoreRecord: true)
                                    ->label('Adresse email')
                                    ->email()
                                    ->required(),

                                Forms\Components\TextInput::make('phone')
                                    ->required()
                                    ->label('Téléphone')
                                    ->tel()
                                    ->maxLength(255),

                                Forms\Components\Checkbox::make('with_responsible')
                                    ->columnSpan(2)
                                    ->reactive()
                                    ->label('Informations du responsable'),

                                Forms\Components\TextInput::make('responsible_name')
                                    ->reactive()
                                    ->disabled(fn (Forms\Get $get) => ! $get('with_responsible'))
                                    ->label('Nom et prénom du responsable')
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('responsible_phone')
                                    ->reactive()
                                    ->disabled(fn (Forms\Get $get) => ! $get('with_responsible'))
                                    ->label('Numéro de téléphone du responsable')
                                    ->required()
                                    ->maxLength(255),
                            ])
                            ->columns(2),

                        Forms\Components\Section::make('Mot de passe')
                            ->description('Changer le mot de passe de cet utilisateur')
                            ->schema([
                                Forms\Components\Group::make()
                                    ->schema([
                                        Forms\Components\Toggle::make('update_password')
                                            ->label('Modifier le mot passe')
                                            ->helperText('Vous allez activiter la modifier de mot de passe.')
                                            ->reactive(),
                                    ]),

                                Forms\Components\Group::make()
                                    ->hidden(fn (Get $get): bool => ! $get('update_password'))
                                    ->reactive()
                                    ->schema([
                                        Forms\Components\TextInput::make('new_password')
                                            ->label('Nouveau mot de passe')
                                            ->password()
                                            ->maxLength(255),
                                    ]),
                            ])
                            ->columns(2),
                    ])
                    ->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('')
                            ->schema([
                                FileUpload::make('profile_picture')
                                    ->label('Photo de profil')
                                    ->image()
                                    ->avatar()
                                    ->visibility('public')
                                    ->directory('managers'),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->statePath('data')
            ->model($this->user)
            ->columns(3);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        if (isset($data['new_password'])) {
            $data['password'] = Hash::make($data['new_password']);
            unset($data['new_password']);
        }

        $this->user->update($data);

        Notification::make()
            ->title('Vos modifications ont été enregistrées avec succès.')
            ->success()
            ->send();
    }
}
