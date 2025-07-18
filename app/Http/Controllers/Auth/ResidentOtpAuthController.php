<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\OtpNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class ResidentOtpAuthController extends Controller
{
    /**
     * Afficher le formulaire de demande d'OTP
     */
    public function showRequestForm()
    {
        return view('auth.resident-otp-request');
    }

    /**
     * Envoyer le code OTP par email
     */
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'Aucun compte résident trouvé avec cette adresse email.'
        ]);

        // Rate limiting
        $key = 'resident-otp:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            throw ValidationException::withMessages([
                'email' => "Trop de tentatives. Réessayez dans {$seconds} secondes.",
            ]);
        }

        $user = User::where('email', $request->email)->first();

        // Vérifier que l'utilisateur est actif
        if (!$user->is_active) {
            throw ValidationException::withMessages([
                'email' => 'Votre compte n\'est pas encore activé. Veuillez contacter l\'administration.',
            ]);
        }

        // Générer et envoyer l'OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        $user->update([
            'otp' => $otp,
            'otp_expires_at' => Carbon::now()->addMinutes(5),
        ]);

        $user->notify(new OtpNotification($otp));

        RateLimiter::hit($key, 300); // 5 minutes

        return view('auth.resident-otp-verify', [
            'email' => $request->email,
            'message' => 'Un code d\'accès a été envoyé à votre adresse email.'
        ]);
    }

    /**
     * Afficher le formulaire de vérification OTP
     */
    public function showVerifyForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        return view('auth.resident-otp-verify', [
            'email' => $request->email
        ]);
    }

    /**
     * Vérifier le code OTP et connecter le résident
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|string|size:6',
        ]);

        // Rate limiting pour la vérification
        $key = 'resident-verify:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            throw ValidationException::withMessages([
                'otp' => "Trop de tentatives. Réessayez dans {$seconds} secondes.",
            ]);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || $user->otp !== $request->otp || Carbon::now()->isAfter($user->otp_expires_at)) {
            RateLimiter::hit($key, 300);
            
            return back()->withErrors([
                'otp' => 'Code OTP invalide ou expiré.'
            ])->onlyInput('email');
        }

        // Connexion réussie
        $user->update([
            'otp' => null,
            'otp_expires_at' => null,
        ]);
        
        Auth::guard('web')->login($user, true);
        
        RateLimiter::clear($key);

        return redirect()->intended(route('filament.resident.pages.dashboard'));
    }

    /**
     * Déconnecter le résident
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('resident.otp.login');
    }
} 