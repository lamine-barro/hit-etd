<?php

namespace App\Models;

use App\Enums\AudienceType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Audience extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'whatsapp',
        'newsletter_email',
        'newsletter_whatsapp',
        'interests',
    ];

    protected $casts = [
        'newsletter_email' => 'boolean',
        'newsletter_whatsapp' => 'boolean',
        'interests' => 'array',
    ];
    
    /**
     * Vérifie si l'audience a un intérêt spécifique
     *
     * @param AudienceType|string $type
     * @return bool
     */
    public function hasInterest(AudienceType|string $type): bool
    {
        if ($type instanceof AudienceType) {
            $type = $type->value;
        }
        
        return in_array($type, $this->interests ?? []);
    }
    
    /**
     * Récupère tous les intérêts sous forme d'instances d'AudienceType
     *
     * @return array
     */
    public function getInterestTypes(): array
    {
        if (empty($this->interests)) {
            return [];
        }
        
        $types = [];
        foreach ($this->interests as $interest) {
            foreach (AudienceType::cases() as $type) {
                if ($type->value === $interest) {
                    $types[] = $type;
                    break;
                }
            }
        }
        
        return $types;
    }
}
