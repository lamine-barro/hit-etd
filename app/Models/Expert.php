<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Expert extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'organization',
        'position',
        'linkedin',
        'cv_path',
        'profile_picture',
        'specialties',
        'specialty_other',
        'training_types',
        'pedagogical_methods',
        'target_audiences',
        'intervention_frequencies',
        'preferred_days_detailed',
        'time_slots',
        'status',
        'admin_notes',
        'processed_at',
    ];

    protected $casts = [
        'specialties' => 'array',
        'training_types' => 'array',
        'pedagogical_methods' => 'array',
        'target_audiences' => 'array',
        'intervention_frequencies' => 'array',
        'preferred_days_detailed' => 'array',
        'time_slots' => 'array',
        'processed_at' => 'datetime',
    ];

    public const SPECIALTIES = [
        'intelligence_artificielle' => 'Intelligence Artificielle',
        'blockchain' => 'Blockchain',
        'e_sante' => 'e-Santé',
        'robotique' => 'Robotique',
        'smart_cities' => 'SmartCities',
        'marketing' => 'Marketing',
        'communication' => 'Communication',
        'cybersecurite' => 'Cybersécurité',
        'solution_spatiale_numerique' => 'Solution Spatiale Numérique',
        'propriete_intellectuelle' => 'Propriété intellectuelle',
        'programmation' => 'Programmation',
        'juridique' => 'Juridique',
        'finances' => 'Finances',
        'financement' => 'Financement',
        'cloud' => 'Cloud',
        'formation' => 'Formation',
        'entreprenariat_accompagnement' => 'Entreprenariat accompagnement',
        'protection_donnees' => 'Protection des données à caractère personnel',
        'autre' => 'Autre',
    ];

    public const TRAINING_TYPES = [
        'presentiel' => 'Présentiel',
        'campus' => 'Campus',
        'virtuel' => 'Virtuel',
        'zoom' => 'Zoom',
        'microsoft_teams' => 'Microsoft Teams',
        'google_meets' => 'Google Meets',
        'autre' => 'Autre',
    ];

    public const PEDAGOGICAL_METHODS = [
        'experientiel' => 'Expérientiel (ateliers pratiques, hackathons, simulations)',
        'individuel' => 'Individuel',
        'en_groupe' => 'En groupe',
    ];

    public const TARGET_AUDIENCES = [
        'startups_ideation' => 'Startups en phase d\'idéation',
        'startups_early_stage' => 'Startups en early stage',
        'startups_croissance' => 'Startups en phase de croissance',
        'partenaires_externes' => 'Partenaires externes (investisseurs, incubateurs, etc.)',
        'etudiants' => 'Étudiants',
    ];

    public const INTERVENTION_FREQUENCIES = [
        'hebdomadaire' => 'Hebdomadaire',
        'mensuelle' => 'Mensuelle',
        'trimestrielle' => 'Trimestrielle',
        'annuelle' => 'Annuelle',
    ];

    public const PREFERRED_DAYS = [
        'lundi' => 'Lundi',
        'mardi' => 'Mardi',
        'mercredi' => 'Mercredi',
        'jeudi' => 'Jeudi',
        'vendredi' => 'Vendredi',
        'samedi' => 'Samedi',
    ];

    public const TIME_SLOTS = [
        'matin' => 'Matin',
        'apres_midi' => 'Après-midi',
        'soir' => 'Soir',
    ];

    public const STATUSES = [
        'pending' => 'En attente',
        'approved' => 'Approuvé',
        'rejected' => 'Rejeté',
    ];

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }

    public function getSpecialtiesLabelsAttribute(): array
    {
        $specialties = $this->specialties;
        
        if (!$specialties) {
            return [];
        }
        
        // Si c'est une chaîne JSON, la décoder
        if (is_string($specialties)) {
            $specialties = json_decode($specialties, true) ?: [];
        }
        
        // S'assurer que c'est un tableau
        if (!is_array($specialties)) {
            return [];
        }
        
        return array_map(function($specialty) {
            return self::SPECIALTIES[$specialty] ?? $specialty;
        }, $specialties);
    }

    /**
     * Get the URL to the expert's avatar.
     */
    public function getAvatarUrl(): ?string
    {
        if (!$this->profile_picture) {
            return null;
        }

        return Storage::url($this->profile_picture);
    }
}
