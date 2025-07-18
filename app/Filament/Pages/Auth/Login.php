<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login as BaseLogin;
use Illuminate\Contracts\Support\Htmlable;

class Login extends BaseLogin
{
    public function mount(): void
    {
        // Si déjà authentifié, rediriger vers le dashboard
        if (auth('admin')->check()) {
            $this->redirect(route('filament.admin.pages.dashboard'));
            return;
        }
        
        // Sinon rediriger vers notre système OTP personnalisé
        $this->redirect(route('admin.otp.login'));
    }

    public function getHeading(): string|Htmlable
    {
        return 'Connexion Administrateur';
    }

    protected function getFormSchema(): array
    {
        // Page de redirection - pas de formulaire nécessaire
        return [];
    }

    protected function getCredentialsFromFormData(array $data): array
    {
        // Page de redirection - pas de credentials nécessaires
        return [];
    }
} 