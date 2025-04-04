<?php

namespace App\Filament\Resources\EventResource\Pages;

use App\Filament\Resources\EventResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Log;

class CreateEvent extends CreateRecord
{
    protected static string $resource = EventResource::class;
    
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Assurons-nous que created_by est défini
        if (!isset($data['created_by']) || empty($data['created_by'])) {
            $data['created_by'] = auth()->user()->id ?? null;
        }
        
        // Si l'événement est gratuit, on force price à null mais on garde currency à XOF (valeur par défaut)
        if (!$data['is_paid']) {
            $data['price'] = null;
            $data['currency'] = 'XOF'; // Utilisation de la valeur par défaut au lieu de null
            $data['early_bird_price'] = null;
            $data['early_bird_end_date'] = null;
        }
        
        return $data;
    }
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
