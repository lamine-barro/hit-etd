<?php

namespace App\Filament\Resources\EventResource\Pages;

use App\Enums\LanguageEnum;
use App\Filament\Resources\EventResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class EditEvent extends EditRecord
{
    protected static string $resource = EventResource::class;

    public function getTitle(): string
    {
        return 'Modifier l\'événement';
    }

    /**
     * Propriété pour stocker temporairement les traductions
     */
    public array $translations = [];

    /**
     * Stocke les données du formulaire avant de les traiter
     */
    protected array $formData = [];

    /**
     * Surcharge de la méthode de sauvegarde pour gérer les traductions
     */
    public function save(bool $shouldRedirect = true, bool $shouldSendSavedNotification = true): void
    {
        // Capturer les données du formulaire
        $this->formData = $this->form->getState();

        // Continuer avec le processus de sauvegarde standard
        parent::save($shouldRedirect, $shouldSendSavedNotification);
    }

    /**
     * Méthode appelée avant le chargement des données du formulaire
     */
    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Récupérer les traductions existantes pour les pré-remplir dans le formulaire
        $event = $this->record;
        $existingTranslations = [];

        if ($event) {
            foreach ($event->translations as $translation) {
                $locale = $translation->locale;

                // Convertir l'enum en string si nécessaire
                if ($locale instanceof LanguageEnum) {
                    $locale = $locale->value;
                }

                $existingTranslations[$locale] = [
                    'locale' => $locale,
                    'title' => $translation->title,
                    'slug' => $translation->slug,
                    'description' => $translation->description,
                    'location' => $translation->location,
                    'meta_title' => $translation->meta_title,
                    'meta_description' => $translation->meta_description,
                    'meta_keywords' => $translation->meta_keywords,
                    'og_type' => $translation->og_type,
                ];
            }
        }

        $data['translations'] = $existingTranslations;

        return $data;
    }

    /**
     * Méthode appelée avant la sauvegarde des données du formulaire
     */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Stockage temporaire des traductions
        if (isset($data['translations'])) {
            $this->translations = $data['translations'];
            unset($data['translations']);
        }

        // Si l'événement est gratuit, on force price à null mais on garde currency à XOF
        if (isset($data['is_paid']) && ! $data['is_paid']) {
            $data['price'] = null;
            $data['currency'] = 'XOF';
            $data['early_bird_price'] = null;
            $data['early_bird_end_date'] = null;
        }

        return $data;
    }

    /**
     * Méthode appelée après la sauvegarde des données
     */
    protected function afterSave(): void
    {
        // Approche simplifiée pour les traductions
        try {
            $event = $this->record;

            if (! $event || ! $event->id) {
                Log::error("L'événement n'a pas été sauvegardé correctement");

                return;
            }

            $eventId = $event->id;
            Log::info("Mise à jour des traductions pour l'événement ID: {$eventId}");

            // Récupérer les traductions du formulaire
            if (isset($this->formData['translations']) && is_array($this->formData['translations'])) {
                foreach ($this->formData['translations'] as $locale => $data) {
                    // Convertir l'enum en string si nécessaire
                    if ($locale instanceof LanguageEnum) {
                        $locale = $locale->value;
                    }
                    if (! empty($data['title'])) {
                        // Vérifier si la traduction existe déjà
                        $exists = DB::table('event_translations')
                            ->where('event_id', $eventId)
                            ->where('locale', $locale)
                            ->exists();

                        if ($exists) {
                            // Mise à jour de la traduction existante
                            DB::table('event_translations')
                                ->where('event_id', $eventId)
                                ->where('locale', $locale)
                                ->update([
                                    'title' => $data['title'],
                                    'slug' => Str::slug($data['title']),
                                    'description' => $data['description'] ?? null,
                                    'location' => $data['location'] ?? null,
                                    'meta_title' => $data['meta_title'] ?? null,
                                    'meta_description' => $data['meta_description'] ?? null,
                                    'meta_keywords' => $data['meta_keywords'] ?? null,
                                    'og_type' => $data['og_type'] ?? null,
                                    'updated_at' => now(),
                                ]);

                            Log::info("Traduction mise à jour pour la langue {$locale}");
                        } else {
                            // Création d'une nouvelle traduction
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

                            Log::info("Nouvelle traduction créée pour la langue {$locale}");
                        }
                    }
                }
            }

            Notification::make()
                ->title('Événement mis à jour avec succès')
                ->success()
                ->send();

        } catch (\Exception $e) {
            Log::error('Erreur lors de la mise à jour des traductions: '.$e->getMessage());
            Log::error($e->getTraceAsString());

            Notification::make()
                ->title('Erreur lors de la mise à jour')
                ->body("Un problème est survenu lors de l'enregistrement des traductions.")
                ->danger()
                ->send();
        }
    }

    /**
     * Désactive la notification automatique de Filament pour éviter les doublons
     */
    protected function getSavedNotification(): ?\Filament\Notifications\Notification
    {
        return null;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('Supprimer'),
            Actions\ForceDeleteAction::make()
                ->label('Supprimer définitivement'),
            Actions\RestoreAction::make()
                ->label('Restaurer'),
        ];
    }
}
