<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class Administrator extends Authenticatable implements FilamentUser, HasAvatar, HasName
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'avatar_url',
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'otp',
        'otp_expires_at',
        'last_login_at',
        'login_ip',
        'created_by',
        'deleted_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'otp',
        'remember_token',
    ];

    /**
     * Obtenir le nom complet de l'administrateur
     */
    public function getFullName(): string
    {
        return "{$this->first_name} {$this->last_name}";
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

    /**
     * Enregistrer les détails de connexion
     */
    public function recordLogin(string $ip): void
    {
        $this->update([
            'last_login_at' => Carbon::now(),
            'login_ip' => $ip,
        ]);
    }

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
            'last_login_at' => 'datetime',
        ];
    }

    public function author()
    {
        return $this->belongsTo(Administrator::class, 'created_by');
    }

    public function deletedBy()
    {
        return $this->belongsTo(Administrator::class, 'deleted_by');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    public function getFilamentName(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url ? Storage::url($this->avatar_url) : null;
    }
}
