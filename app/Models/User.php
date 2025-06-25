<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Models\Contracts\HasName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable implements FilamentUser, HasAvatar, HasName
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'email',
        'name',
        'phone',
        'phone_number',
        'password',
        'is_active',
        'category',
        'lock_raison',
        'remember_token',
        'is_verified',
        'responsible_name',
        'responsible_phone',
        'documents',
        'responsible_document_type',
        'responsible_document_value',
        'responsible_document_file',
        'profile_picture',
        'with_responsible',
        'is_request',
        'needs',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'remember_token',
        'password',
    ];

    public const CATEGORIES = [
        'startup' => 'Startup',
        'person' => 'Individu',
        'expert' => 'Expert',
        'entreprise' => 'Gestionnaire',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }

    /**
     * Determine if the user can access the Filament panel.
     */
    public function canAccessPanel(\Filament\Panel $panel): bool
    {
        return $this->isActive();
    }

    /**
     * Get the URL to the user's avatar for Filament.
     */
    public function getFilamentAvatarUrl(): ?string
    {
        if (! $this->profile_picture) {
            return null; // Return null if no profile picture is set
        }

        return Storage::url($this->profile_picture);
    }

    /**
     * Get the display name for the user in Filament.
     */
    public function getFilamentName(): string
    {
        // Return the user's email as their name, or customize as needed
        return $this->name;
    }

    public function orders()
    {
        return $this->hasMany(EspaceOrder::class);
    }

    public function isStartup(): bool
    {
        return $this->category === 'startup';
    }

    public function isPerson(): bool
    {
        return $this->category === 'person';
    }

    public function isExpert(): bool
    {
        return $this->category === 'expert';
    }

    public function isEntreprise(): bool
    {
        return $this->category === 'entreprise';
    }

    public function isActive(): bool
    {
        return $this->is_active;
    }

    public function isVerified(): bool
    {
        return $this->is_verified;
    }
}
