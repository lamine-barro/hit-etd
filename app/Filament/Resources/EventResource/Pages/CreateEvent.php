<?php

namespace App\Filament\Resources\EventResource\Pages;

use App\Enums\LanguageEnum;
use App\Filament\Resources\EventResource;
use App\Models\Event;
use App\Models\EventTranslation;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CreateEvent extends CreateRecord
{
    protected static string $resource = EventResource::class;
    
    /**
     * Propriété pour stocker temporairement les traductions
     */
    public array $translations = [];
    
    /**
     * Stocke les données du formulaire avant de les traiter
     */
    protected array $formData = [];
    
    /**
     * Surcharge de la méthode de création pour gérer les traductions
     */
    public function create(bool $another = false): void
    {
        // Capturer les données du formulaire
        $this->formData = $this->form->getState();
        
        // Continuer avec le processus de création standard
        parent::create($another);
    }
    
    /**
     * Prépare les données avant la création
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Stockage temporaire des traductions
        if (isset($data['translations'])) {
            $this->translations = $data['translations'];
            unset($data['translations']);
        }
        
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
    
    /**
     * Méthode appelée après la création de l'événement
     */
    protected function afterCreate(): void
    {
        // Approche simplifiée pour les traductions
        try {
            $event = $this->record;
            
            if (!$event || !$event->id) {
                Log::error("L'événement n'a pas été créé correctement");
                return;
            }
            
            $eventId = $event->id;
            Log::info("Création des traductions pour l'événement ID: {$eventId}");
            
            // Récupérer les traductions du formulaire
            if (isset($this->formData['translations']) && is_array($this->formData['translations'])) {
                foreach ($this->formData['translations'] as $locale => $data) {
                    if (!empty($data['title'])) {
                        // Insertion directe en base de données pour éviter les problèmes d'ORM
                        DB::table('event_translations')->insert([
                            'event_id' => $eventId,
                            'locale' => $locale,
                            'title' => $data['title'],
                            'slug' => Str::slug($data['title']),
                            'description' => $data['description'] ?? null,
                            'location' => $data['location'] ?? null,
                            'meta_title' => $data['meta_title'] ?? null,
                            'meta_description' => $data['meta_description'] ?? null,
                            'meta_keywords' => $data['meta_keywords'] ?? null,
                            'og_type' => $data['og_type'] ?? null,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                        
                        Log::info("Traduction créée pour la langue {$locale}");
                    }
                }
            }
            
            Notification::make()
                ->title('Événement créé avec succès')
                ->success()
                ->send();
                
        } catch (\Exception $e) {
            Log::error("Erreur lors de la création des traductions: " . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            Notification::make()
                ->title('Erreur lors de la création')
                ->body("Un problème est survenu lors de l'enregistrement des traductions.")
                ->danger()
                ->send();
        }
    }
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
