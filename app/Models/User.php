<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

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
        'is_active',
        'category',
        'profession',
        'organization',
        'city',
        'bio',
        'startup_description',
        'lock_raison',
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
        'otp',
        'remember_token',
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
            'is_active' => 'boolean',
            'is_verified' => 'boolean',
            'is_request' => 'boolean',
            'documents' => 'array',
            'needs' => 'array',
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

    /**
     * Générer et sauvegarder un code OTP
     */
    public function generateOtp(): string
    {
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        $this->update([
            'otp' => $otp,
            'otp_expires_at' => Carbon::now()->addMinutes(10), // OTP valide 10 minutes
        ]);

        return $otp;
    }

    /**
     * Vérifier si l'OTP est valide
     */
    public function isValidOtp(string $otp): bool
    {
        return $this->otp === $otp && 
               $this->otp_expires_at && 
               Carbon::now()->lt($this->otp_expires_at);
    }

    /**
     * Effacer l'OTP après utilisation
     */
    public function clearOtp(): void
    {
        $this->update([
            'otp' => null,
            'otp_expires_at' => null,
        ]);
    }
}
