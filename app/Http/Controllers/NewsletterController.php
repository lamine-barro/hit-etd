<?php

namespace App\Http\Controllers;

use App\Models\Audience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        try {
            Log::info('Newsletter subscription attempt', [
                'data' => $request->all(),
            ]);

            // Convertir les valeurs "on" en true avant la validation
            $data = $request->all();
            $data['newsletter_email'] = $request->has('newsletter_email');
            $data['newsletter_whatsapp'] = $request->has('newsletter_whatsapp');

            // Vérifier si l'email existe déjà
            $existingSubscriber = Audience::where('email', $data['newsletter_email_input'])->first();
            
            if ($existingSubscriber) {
                // Mise à jour des intérêts et préférences si l'abonné existe déjà
                $existingSubscriber->update([
                    'name' => $data['newsletter_name'],
                    'whatsapp' => $data['newsletter_whatsapp_input'] ?? $existingSubscriber->whatsapp,
                    'newsletter_email' => $data['newsletter_email'],
                    'newsletter_whatsapp' => $data['newsletter_whatsapp'] ?? false,
                    'interests' => array_unique(array_merge($existingSubscriber->interests ?? [], $data['interests'] ?? [])),
                ]);
                
                Log::info('Newsletter subscriber updated', [
                    'subscriber_id' => $existingSubscriber->id,
                    'subscriber_data' => $existingSubscriber->toArray(),
                ]);
                
                if ($request->ajax()) {
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Vos préférences ont été mises à jour. Merci de votre fidélité !',
                    ]);
                }
                
                return back()->with('notification', [
                    'type' => 'success',
                    'message' => 'Vos préférences ont été mises à jour. Merci de votre fidélité !',
                ]);
            }
            
            // Validation pour un nouvel abonné
            $validated = validator($data, [
                'newsletter_name' => 'required|string|max:255',
                'newsletter_email_input' => 'required|email|max:255',
                'newsletter_whatsapp_input' => 'nullable|string|max:255',
                'newsletter_email' => 'required|boolean',
                'newsletter_whatsapp' => 'required|boolean',
                'interests' => 'nullable|array',
                'interests.*' => 'string|in:startups,tech,events,formation',
            ])->validate();

            Log::info('Newsletter validation passed', [
                'validated_data' => $validated,
            ]);

            DB::transaction(function () use ($validated) {
                $audience = Audience::create([
                    'name' => $validated['newsletter_name'],
                    'email' => $validated['newsletter_email_input'],
                    'whatsapp' => $validated['newsletter_whatsapp_input'] ?? null,
                    'newsletter_email' => $validated['newsletter_email'],
                    'newsletter_whatsapp' => $validated['newsletter_whatsapp'],
                    'interests' => $validated['interests'] ?? [],
                ]);

                Log::info('Newsletter subscriber created', [
                    'subscriber_id' => $audience->id,
                    'subscriber_data' => $audience->toArray(),
                ]);
            });

            if ($request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Merci pour votre inscription ! Vous recevrez bientôt nos actualités.',
                ]);
            }

            return back()->with('notification', [
                'type' => 'success',
                'message' => 'Merci pour votre inscription ! Vous recevrez bientôt nos actualités.',
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Newsletter validation error', [
                'errors' => $e->errors(),
                'data' => $request->all(),
            ]);
            
            // Messages d'erreur personnalisés
            $errorMessage = 'Veuillez vérifier les informations saisies.';
            
            // Messages spécifiques pour certaines erreurs
            if (isset($e->errors()['newsletter_email_input'])) {
                foreach ($e->errors()['newsletter_email_input'] as $error) {
                    if (strpos($error, 'unique') !== false) {
                        $errorMessage = 'Cet email est déjà inscrit. Vous pouvez mettre à jour vos préférences.';
                        break;
                    } elseif (strpos($error, 'email') !== false) {
                        $errorMessage = 'Veuillez saisir une adresse email valide.';
                        break;
                    }
                }
            } elseif (isset($e->errors()['newsletter_name'])) {
                $errorMessage = 'Veuillez saisir votre nom.';
            }

            if ($request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $errorMessage,
                    'errors' => $e->errors(),
                ], 422);
            }

            return back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('notification', [
                    'type' => 'error',
                    'message' => $errorMessage,
                ]);

        } catch (\Exception $e) {
            Log::error('Newsletter subscription error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'data' => $request->all(),
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Une erreur est survenue lors de votre inscription. Veuillez réessayer plus tard.',
                ], 500);
            }

            return back()->with('notification', [
                'type' => 'error',
                'message' => 'Une erreur est survenue lors de votre inscription. Veuillez réessayer plus tard.',
            ]);
        }
    }
}
