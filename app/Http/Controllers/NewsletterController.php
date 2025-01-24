<?php

namespace App\Http\Controllers;

use App\Models\Audience;
use App\Mail\NewsletterSubscriptionAdmin;
use App\Mail\NewsletterSubscriptionConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        try {
            $validated = $request->validate([
                'newsletter_name' => 'required|string|max:255',
                'newsletter_email_input' => 'required|email|unique:audiences,email',
                'newsletter_whatsapp_input' => 'nullable|string|max:255',
                'newsletter_email' => 'nullable',
                'newsletter_whatsapp' => 'nullable',
                'interests' => 'nullable|array',
                'interests.*' => 'string|in:startups,tech,events,formation'
            ]);

            DB::beginTransaction();

            // Créer l'abonné dans la table audience
            $subscriber = Audience::create([
                'name' => $validated['newsletter_name'],
                'email' => $validated['newsletter_email_input'],
                'whatsapp' => $validated['newsletter_whatsapp_input'] ?? null,
                'newsletter_email' => $request->has('newsletter_email'),
                'newsletter_whatsapp' => $request->has('newsletter_whatsapp'),
                'interests' => $validated['interests'] ?? [],
            ]);

            // Envoyer les emails
            Mail::to('hello@hubivoiretech.ci')->queue(new NewsletterSubscriptionAdmin($subscriber));
            Mail::to($subscriber->email)->queue(new NewsletterSubscriptionConfirmation($subscriber));

            DB::commit();

            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Merci de votre inscription à notre newsletter ! Vous recevrez bientôt un email de confirmation.',
                    'redirect' => route('home')
                ]);
            }

            return back()->with('success', 'Merci de votre inscription à notre newsletter ! Vous recevrez bientôt un email de confirmation.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de l\'inscription à la newsletter: ' . $e->getMessage());
            
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Une erreur est survenue lors de votre inscription. Veuillez réessayer plus tard.'
                ], 422);
            }

            return back()
                ->withInput()
                ->with('error', 'Une erreur est survenue lors de votre inscription. Veuillez réessayer plus tard.');
        }
    }
} 