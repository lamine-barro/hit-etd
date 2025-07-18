<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use App\Notifications\AdminOtpNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class AdminOtpAuthController extends Controller
{
    /**
     * Afficher le formulaire de demande d'OTP
     */
    public function showRequestForm()
    {
        return view('auth.admin-otp-request');
    }

    /**
     * Envoyer le code OTP par email
     */
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:administrators,email',
        ]);

        // Rate limiting
        $key = 'admin-otp:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            throw ValidationException::withMessages([
                'email' => "Trop de tentatives. Réessayez dans {$seconds} secondes.",
            ]);
        }

        $admin = Administrator::where('email', $request->email)->first();

        // Générer et envoyer l'OTP
        $otp = $admin->generateOtp();
        $admin->notify(new AdminOtpNotification($otp));

        RateLimiter::hit($key, 300); // 5 minutes

        return view('auth.admin-otp-verify', [
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
            'email' => 'required|email|exists:administrators,email',
        ]);

        return view('auth.admin-otp-verify', [
            'email' => $request->email
        ]);
    }

    /**
     * Vérifier le code OTP et connecter l'administrateur
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:administrators,email',
            'otp' => 'required|string|size:6',
        ]);

        // Rate limiting pour la vérification
        $key = 'admin-verify:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            throw ValidationException::withMessages([
                'otp' => "Trop de tentatives. Réessayez dans {$seconds} secondes.",
            ]);
        }

        $admin = Administrator::where('email', $request->email)->first();

        if (!$admin || !$admin->isValidOtp($request->otp)) {
            RateLimiter::hit($key, 300);
            
            return back()->withErrors([
                'otp' => 'Code OTP invalide ou expiré.'
            ])->onlyInput('email');
        }

        // Connexion réussie
        $admin->clearOtp();
        $admin->recordLogin($request->ip());
        
        Auth::guard('admin')->login($admin, true);
        
        RateLimiter::clear($key);

        return redirect()->intended(route('filament.admin.pages.dashboard'));
    }

    /**
     * Déconnecter l'administrateur
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.otp.login');
    }
} 