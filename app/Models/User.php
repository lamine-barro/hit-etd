<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Models\Contracts\HasName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        User::creating(function ($user) {
            $password = uniqid();
            $user->password = bcrypt($password);
            $user->is_active = true;
        });
    }

    /**
     * Determine if the user can access the Filament panel.
     */
    public function canAccessPanel(\Filament\Panel $panel): bool
    {
        // Allow all users to access the panel by default
        return true;
    }

    /**
     * Get the URL to the user's avatar for Filament.
     */
    public function getFilamentAvatarUrl(): ?string
    {
        // Return null or a default avatar URL
        return null;
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
}
