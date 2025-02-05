<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class EventController extends Controller
{
    /**
     * Display a listing of events.
     */
    public function index(Request $request)
    {
        $query = Event::query()->withCount('registrations');

        // Appliquer les filtres
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            });
        }

        if ($request->filled('type')) {
            $query->where('type', $request->input('type'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('format')) {
            $query->where('is_remote', $request->input('format'));
        }

        // Trier par date de création décroissante
        $query->latest();

        $events = $query->paginate(10)->withQueryString();

        return view('dashboard.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new event.
     */
    public function create()
    {
        return view('dashboard.events.create');
    }

    /**
     * Store a newly created event.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'type' => 'required|string|in:conference,workshop,webinar,training',
                'title' => 'required|string|max:255',
                'start_date' => 'required|date|after:now',
                'end_date' => 'nullable|date|after:start_date',
                'location' => 'required|string|max:255',
                'is_remote' => 'required|boolean',
                'description' => 'required|string',
                'max_participants' => 'required|integer|min:0',
                'EventRegistration_end_date' => 'required|date|before_or_equal:start_date',
                'external_link' => 'nullable|url|max:255',
                'is_paid' => 'required|boolean',
                'price' => 'required_if:is_paid,1|nullable|numeric|min:0',
                'currency' => 'required_if:is_paid,1|nullable|string|in:XOF,EUR,USD',
                'status' => 'required|string|in:draft,published',
                'illustration' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Si l'événement est gratuit, on force price et currency à null
            if (! $validatedData['is_paid']) {
                $validatedData['price'] = null;
                $validatedData['currency'] = null;
            }

            // Vérification supplémentaire des dates
            $start_date = \Carbon\Carbon::parse($request->start_date);
            $eventRegistration_end_date = \Carbon\Carbon::parse($request->EventRegistration_end_date);

            if ($eventRegistration_end_date->isAfter($start_date)) {
                throw ValidationException::withMessages([
                    'EventRegistration_end_date' => ['La date limite d\'inscription doit être antérieure ou égale à la date de début de l\'événement.'],
                ]);
            }

            // Gérer l'upload de l'image
            if ($request->hasFile('illustration')) {
                $file = $request->file('illustration');
                $filename = time().'_'.$file->getClientOriginalName();
                $path = $file->storeAs('events', $filename, 'public');
                $validatedData['illustration'] = $path;
            }

            $event = Event::create($validatedData);

            return redirect()->route('events.show', $event)
                ->with('success', 'Événement créé avec succès.');
        } catch (ValidationException $e) {
            Log::error('Erreur de validation lors de la création de l\'événement', [
                'errors' => $e->errors(),
                'request_data' => $request->all(),
            ]);
            throw $e;
        } catch (\Exception $e) {
            Log::error('Erreur lors de la création de l\'événement', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all(),
            ]);

            // Si une image a été uploadée, la supprimer
            if (isset($path)) {
                Storage::disk('public')->delete($path);
            }

            throw $e;
        }
    }

    /**
     * Display the specified event.
     */
    public function show(Event $event)
    {
        $event->loadCount('registrations');

        return view('dashboard.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified event.
     */
    public function edit(Event $event)
    {
        return view('dashboard.events.edit', compact('event'));
    }

    /**
     * Update the specified event in storage.
     */
    public function update(Request $request, Event $event)
    {
        try {
            $validatedData = $request->validate([
                'type' => 'required|string|in:conference,workshop,webinar,training',
                'title' => 'required|string|max:255',
                'start_date' => 'required|date|after:now',
                'end_date' => 'nullable|date|after:start_date',
                'location' => 'required|string|max:255',
                'is_remote' => 'required|boolean',
                'description' => 'required|string',
                'max_participants' => 'required|integer|min:0',
                'registration_end_date' => 'required|date|before_or_equal:start_date',
                'external_link' => 'nullable|url|max:255',
                'is_paid' => 'required|boolean',
                'price' => 'required_if:is_paid,1|nullable|numeric|min:0',
                'currency' => 'required_if:is_paid,1|nullable|string|in:XOF,EUR,USD',
                'status' => 'required|string|in:draft,published',
                'illustration' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Gérer l'upload de l'image
            if ($request->hasFile('illustration')) {
                // Supprimer l'ancienne image si elle existe
                if ($event->illustration) {
                    Storage::disk('public')->delete($event->illustration);
                }

                $file = $request->file('illustration');
                $filename = time().'_'.$file->getClientOriginalName();
                $path = $file->storeAs('events', $filename, 'public');
                $validatedData['illustration'] = $path;
            }

            $event->update($validatedData);

            return redirect()->route('events.show', $event)
                ->with('success', 'Événement mis à jour avec succès.');
        } catch (ValidationException $e) {
            Log::error('Erreur de validation lors de la mise à jour de l\'événement', [
                'errors' => $e->errors(),
                'request_data' => $request->all(),
            ]);
            throw $e;
        } catch (\Exception $e) {
            Log::error('Erreur lors de la mise à jour de l\'événement', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all(),
            ]);

            // Si une nouvelle image a été uploadée, la supprimer
            if (isset($path)) {
                Storage::disk('public')->delete($path);
            }

            throw $e;
        }
    }

    /**
     * Remove the specified event from storage.
     */
    public function destroy(Event $event)
    {
        try {
            // Vérifier si l'événement a des inscriptions
            if ($event->registrations()->count() > 0) {
                return redirect()
                    ->route('events.show', $event)
                    ->with('toast', [
                        'type' => 'error',
                        'message' => 'Impossible de supprimer un événement qui a des inscriptions.',
                        'title' => 'Erreur!',
                    ]);
            }

            // Supprimer l'image si elle existe
            if ($event->illustration) {
                Storage::disk('public')->delete($event->illustration);
            }

            // Supprimer l'événement
            $event->delete();

            return redirect()
                ->route('events.index')
                ->with('toast', [
                    'type' => 'success',
                    'message' => 'L\'événement a été supprimé avec succès.',
                    'title' => 'Succès!',
                ]);
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('toast', [
                    'type' => 'error',
                    'message' => 'Une erreur est survenue lors de la suppression de l\'événement.',
                    'title' => 'Erreur!',
                ]);
        }
    }
}
