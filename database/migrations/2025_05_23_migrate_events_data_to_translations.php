<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Exécute les migrations.
     */
    public function up(): void
    {
        // Récupérer tous les événements existants
        $events = DB::table('events')->get();
        
        foreach ($events as $event) {
            // Vérifier si une traduction existe déjà pour cet événement dans la langue par défaut
            $defaultLocale = $event->default_locale ?? 'fr';
            
            $existingTranslation = DB::table('event_translations')
                ->where('event_id', $event->id)
                ->where('locale', $defaultLocale)
                ->first();
                
            if (!$existingTranslation) {
                // Créer une traduction pour cet événement
                DB::table('event_translations')->insert([
                    'event_id' => $event->id,
                    'locale' => $defaultLocale,
                    'title' => $event->title,
                    'slug' => $event->slug,
                    'description' => $event->description,
                    'location' => $event->location,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    /**
     * Annule les migrations.
     */
    public function down(): void
    {
        // Cette migration ne peut pas être annulée de manière propre
        // car nous ne pouvons pas savoir quelles traductions ont été créées par cette migration
    }
};
