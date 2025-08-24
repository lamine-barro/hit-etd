<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
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
        'password',
        'is_active',
        'category',
        'profession',
        'organization',
        'city',
        'bio',
        'startup_description',
        'lock_raison',
        'remember_token',
        'is_verified',
        'documents',
        'profile_picture',
        'is_request',
        'needs',
        'otp',
        'otp_expires_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'remember_token',
        'otp',
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
            'otp_expires_at' => 'datetime',
        ];
    }

    /**
     * Get the URL to the user's avatar.
     */
    public function getAvatarUrl(): ?string
    {
        if (! $this->profile_picture) {
            return null;
        }

        return Storage::url($this->profile_picture);
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
