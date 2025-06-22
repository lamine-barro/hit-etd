<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected $password;

    public function mutateFormDataBeforeCreate(array $data): array
    {
        $this->password = uniqid();

        $data['password'] = bcrypt($this->password);
        $data['is_active'] = true;

        return $data;
    }

    public function afterCreate(): void
    {
        $this->record->notify(new \App\Notifications\WelcomeResidentNotification($this->password));

        $this->redirect(UserResource::getUrl('index'));
    }
}
