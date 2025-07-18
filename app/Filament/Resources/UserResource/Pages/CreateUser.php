<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    public function getTitle(): string
    {
        return 'Créer un résident';
    }

    public function mutateFormDataBeforeCreate(array $data): array
    {
        $data['is_active'] = true;
        $data['is_request'] = false;
        $data['is_verified'] = true;

        return $data;
    }

    public function afterCreate(): void
    {
        $this->record->notify(new \App\Notifications\WelcomeResidentNotification());

        $this->redirect(UserResource::getUrl('index'));
    }
}
