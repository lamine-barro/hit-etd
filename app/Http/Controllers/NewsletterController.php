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

            $validated = validator($data, [
                'newsletter_name' => 'required|string|max:255',
                'newsletter_email_input' => 'required|email|max:255|unique:audiences,email',
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

            if ($request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Veuillez vérifier les informations saisies.',
                    'errors' => $e->errors(),
                ], 422);
            }

            return back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('notification', [
                    'type' => 'error',
                    'message' => 'Veuillez vérifier les informations saisies.',
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

    public function index()
    {
        $subscribers = Audience::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('dashboard.audiences.subscribers', compact('subscribers'));
    }

    public function update(Request $request, Audience $subscriber)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:audiences,email,'.$subscriber->id,
            'whatsapp' => 'nullable|string|max:255',
            'interests' => 'nullable|array',
            'interests.*' => 'string|in:startups,tech,events,formation',
            'newsletter_email' => 'boolean',
            'newsletter_whatsapp' => 'boolean',
        ]);

        $subscriber->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'whatsapp' => $validated['whatsapp'],
            'interests' => $validated['interests'] ?? [],
            'newsletter_email' => $request->has('newsletter_email'),
            'newsletter_whatsapp' => $request->has('newsletter_whatsapp'),
        ]);

        return back()->with('notification', [
            'type' => 'success',
            'message' => 'Abonné mis à jour avec succès.',
        ]);
    }

    public function destroy(Audience $subscriber)
    {
        $subscriber->delete();

        return back()->with('notification', [
            'type' => 'success',
            'message' => 'Abonné supprimé avec succès.',
        ]);
    }

    public function export(Request $request)
    {
        $validated = $request->validate([
            'format' => 'required|in:csv,xlsx',
            'columns' => 'required|array',
            'columns.*' => 'string|in:name,email,whatsapp,interests,created_at',
        ]);

        $subscribers = Audience::all();
        $data = [];

        foreach ($subscribers as $subscriber) {
            $row = [];
            foreach ($validated['columns'] as $column) {
                switch ($column) {
                    case 'name':
                        $row['Nom'] = $subscriber->name;
                        break;
                    case 'email':
                        $row['Email'] = $subscriber->email;
                        break;
                    case 'whatsapp':
                        $row['WhatsApp'] = $subscriber->whatsapp;
                        break;
                    case 'interests':
                        $row['Centres d\'intérêt'] = implode(', ', $subscriber->interests);
                        break;
                    case 'created_at':
                        $row['Date d\'inscription'] = $subscriber->created_at->format('d/m/Y H:i');
                        break;
                }
            }
            $data[] = $row;
        }

        $filename = 'abonnes-newsletter-'.now()->format('Y-m-d-His');

        if ($validated['format'] === 'csv') {
            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="'.$filename.'.csv"',
            ];

            $callback = function () use ($data) {
                $file = fopen('php://output', 'w');
                fputcsv($file, array_keys(reset($data)));
                foreach ($data as $row) {
                    fputcsv($file, $row);
                }
                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }

        return \Maatwebsite\Excel\Facades\Excel::download(
            new \App\Exports\SubscribersExport($data),
            $filename.'.xlsx'
        );
    }
}
