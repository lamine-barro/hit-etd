<?php

namespace App\Models;

use App\Enums\PartnershipStatus;
use App\Enums\PartnershipType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partnership extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'organization_name',
        'contact_name',
        'email',
        'phone',
        'message',
        'amount',
        'status',
        'internal_notes',
        'processed_at',
    ];

    /**
     * Les attributs qui doivent être castés.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'type' => PartnershipType::class,
        'status' => PartnershipStatus::class,
        'amount' => 'decimal:2',
        'processed_at' => 'datetime',
    ];

    /**
     * Les attributs qui doivent être mutés en dates.
     *
     * @var array<int, string>
     */
    protected $dates = [
        'processed_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Détermine si la demande de partenariat a été traitée.
     */
    public function isProcessed(): bool
    {
        return $this->status !== PartnershipStatus::PENDING;
    }

    /**
     * Détermine si la demande de partenariat est en attente.
     */
    public function isUntreated(): bool
    {
        return $this->status === PartnershipStatus::UNTREATED;
    }

    /**
     * Détermine si la demande de partenariat a été approuvée.
     */
    public function isTreated(): bool
    {
        return $this->status === PartnershipStatus::TREATED;
    }

    /**
     * Détermine si la demande de partenariat est archivée.
     */
    public function isArchived(): bool
    {
        return $this->status === PartnershipStatus::ARCHIVED;
    }
}
