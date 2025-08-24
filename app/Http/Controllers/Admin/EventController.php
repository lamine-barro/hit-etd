<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Administrator;
use App\Enums\EventStatus;
use App\Traits\HandlesImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    use HandlesImageUpload;
    public function index()
    {
        $events = Event::with('createdBy')
            ->orderBy('start_date', 'desc')
            ->paginate(15);
        
        return view('pages.admin.events.index', compact('events'));
    }

    public function show(Event $event)
    {
        $event->load('registrations');
        return view('pages.admin.events.show', compact('event'));
    }

    public function create()
    {
        return view('pages.admin.events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_fr' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'slug_fr' => 'required|string|max:255|unique:event_translations,slug',
            'slug_en' => 'nullable|string|max:255|unique:event_translations,slug',
            'description_fr' => 'required|string',
            'description_en' => 'nullable|string',
            'location_fr' => 'nullable|string|max:255',
            'location_en' => 'nullable|string|max:255',
            'type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'registration_end_date' => 'required|date|before:start_date',
            'is_remote' => 'boolean',
            'is_paid' => 'boolean',
            'price' => 'nullable|numeric|min:0',
            'currency' => 'nullable|string|max:3',
            'early_bird_price' => 'nullable|numeric|min:0',
            'early_bird_end_date' => 'nullable|date|before:start_date',
            'max_participants' => 'nullable|integer|min:1',
            'external_link' => 'nullable|url',
            'status' => 'required|string',
            'illustration' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        if ($request->hasFile('illustration')) {
            $validated['illustration'] = $this->optimizeEventImage($request->file('illustration'));
        }

        $validated['is_remote'] = $request->has('is_remote');
        $validated['is_paid'] = $request->has('is_paid');

        if (!$validated['is_paid']) {
            $validated['price'] = null;
            $validated['early_bird_price'] = null;
            $validated['early_bird_end_date'] = null;
        }

        // Définir created_by avec l'administrateur connecté
        $validated['created_by'] = auth()->guard('administrator')->id();
        
        $event = Event::create($validated);

        // Créer les traductions
        $event->translations()->create([
            'locale' => 'fr',
            'title' => $validated['title_fr'],
            'slug' => $validated['slug_fr'],
            'description' => $validated['description_fr'],
            'location' => $validated['location_fr'] ?? null,
        ]);

        if (!empty($validated['title_en'])) {
            $event->translations()->create([
                'locale' => 'en',
                'title' => $validated['title_en'],
                'slug' => $validated['slug_en'],
                'description' => $validated['description_en'] ?? null,
                'location' => $validated['location_en'] ?? null,
            ]);
        }

        return redirect()->route('admin.events.index')->with('success', 'Événement créé avec succès.');
    }

    public function edit(Event $event)
    {
        $event->load('translations');
        return view('pages.admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title_fr' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'slug_fr' => 'required|string|max:255|unique:event_translations,slug,' . $event->translations->where('locale', 'fr')->first()?->id,
            'slug_en' => 'nullable|string|max:255|unique:event_translations,slug,' . $event->translations->where('locale', 'en')->first()?->id,
            'description_fr' => 'required|string',
            'description_en' => 'nullable|string',
            'location_fr' => 'nullable|string|max:255',
            'location_en' => 'nullable|string|max:255',
            'type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'registration_end_date' => 'required|date|before:start_date',
            'is_remote' => 'boolean',
            'is_paid' => 'boolean',
            'price' => 'nullable|numeric|min:0',
            'currency' => 'nullable|string|max:3',
            'early_bird_price' => 'nullable|numeric|min:0',
            'early_bird_end_date' => 'nullable|date|before:start_date',
            'max_participants' => 'nullable|integer|min:1',
            'external_link' => 'nullable|url',
            'status' => 'required|string',
            'illustration' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        if ($request->hasFile('illustration')) {
            $this->deleteImage($event->illustration);
            $validated['illustration'] = $this->optimizeEventImage($request->file('illustration'));
        }

        $validated['is_remote'] = $request->has('is_remote');
        $validated['is_paid'] = $request->has('is_paid');

        if (!$validated['is_paid']) {
            $validated['price'] = null;
            $validated['early_bird_price'] = null;
            $validated['early_bird_end_date'] = null;
        }

        $event->update($validated);

        // Mettre à jour les traductions
        $frTranslation = $event->translations->where('locale', 'fr')->first();
        if ($frTranslation) {
            $frTranslation->update([
                'title' => $validated['title_fr'],
                'slug' => $validated['slug_fr'],
                'description' => $validated['description_fr'],
                'location' => $validated['location_fr'] ?? null,
            ]);
        }

        $enTranslation = $event->translations->where('locale', 'en')->first();
        if (!empty($validated['title_en'])) {
            if ($enTranslation) {
                $enTranslation->update([
                    'title' => $validated['title_en'],
                    'slug' => $validated['slug_en'],
                    'description' => $validated['description_en'] ?? null,
                    'location' => $validated['location_en'] ?? null,
                ]);
            } else {
                $event->translations()->create([
                    'locale' => 'en',
                    'title' => $validated['title_en'],
                    'slug' => $validated['slug_en'],
                    'description' => $validated['description_en'] ?? null,
                    'location' => $validated['location_en'] ?? null,
                ]);
            }
        } elseif ($enTranslation) {
            $enTranslation->delete();
        }

        return redirect()->route('admin.events.index')->with('success', 'Événement mis à jour avec succès.');
    }

    public function destroy(Event $event)
    {
        $this->deleteImage($event->illustration);

        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Événement supprimé avec succès.');
    }
}