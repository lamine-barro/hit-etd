<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Espace;
use App\Traits\HandlesImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EspaceController extends Controller
{
    use HandlesImageUpload;
    public function index()
    {
        $espaces = Espace::orderBy('created_at', 'desc')->paginate(15);
        return view('pages.admin.espaces.index', compact('espaces'));
    }

    public function show(Espace $espace)
    {
        return view('pages.admin.espaces.show', compact('espace'));
    }

    public function create()
    {
        return view('pages.admin.espaces.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:espaces',
            'type' => 'required|string',
            'price_per_hour' => 'required|numeric|min:0',
            'minimum_duration' => 'required|integer|min:1',
            'location' => 'nullable|string|max:500',
            'floor' => 'nullable|string',
            'room_count' => 'nullable|integer|min:1',
            'number_of_people' => 'nullable|integer|min:1',
            'illustration' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('illustration')) {
            $validated['illustration'] = $this->optimizeEspaceImage($request->file('illustration'));
        }

        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $images[] = $this->optimizeEspaceImage($image);
            }
            $validated['images'] = $images;
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['status'] = Espace::STATUS_AVAILABLE;

        Espace::create($validated);

        return redirect()->route('admin.espaces.index')->with('success', 'Espace créé avec succès.');
    }

    public function edit(Espace $espace)
    {
        return view('pages.admin.espaces.edit', compact('espace'));
    }

    public function update(Request $request, Espace $espace)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:espaces,code,' . $espace->id,
            'type' => 'required|string',
            'price_per_hour' => 'required|numeric|min:0',
            'minimum_duration' => 'required|integer|min:1',
            'location' => 'nullable|string|max:500',
            'floor' => 'nullable|string',
            'room_count' => 'nullable|integer|min:1',
            'number_of_people' => 'nullable|integer|min:1',
            'illustration' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('illustration')) {
            $this->deleteImage($espace->illustration);
            $validated['illustration'] = $this->optimizeEspaceImage($request->file('illustration'));
        }

        if ($request->hasFile('images')) {
            if ($espace->images) {
                foreach ($espace->images as $image) {
                    $this->deleteImage($image);
                }
            }
            $images = [];
            foreach ($request->file('images') as $image) {
                $images[] = $this->optimizeEspaceImage($image);
            }
            $validated['images'] = $images;
        }

        $validated['is_active'] = $request->has('is_active');

        $espace->update($validated);

        return redirect()->route('admin.espaces.index')->with('success', 'Espace mis à jour avec succès.');
    }

    public function destroy(Espace $espace)
    {
        $this->deleteImage($espace->illustration);

        if ($espace->images) {
            foreach ($espace->images as $image) {
                $this->deleteImage($image);
            }
        }

        $espace->delete();

        return redirect()->route('admin.espaces.index')->with('success', 'Espace supprimé avec succès.');
    }

    public function publish(Espace $espace)
    {
        $espace->update(['is_active' => true]);
        return redirect()->back()->with('success', 'Espace publié avec succès.');
    }

    public function unpublish(Espace $espace)
    {
        $espace->update(['is_active' => false]);
        return redirect()->back()->with('success', 'Espace masqué avec succès.');
    }
}