<?php

namespace App\Http\Controllers;

use App\Models\Audience;
use Illuminate\Http\Request;

class AudienceController extends Controller
{
    public function index()
    {
        $audiences = Audience::orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('dashboard.audiences.index', compact('audiences'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        Audience::create($validated);

        return back()->with('toast', [
            'type' => 'success',
            'message' => 'Audience créée avec succès.'
        ]);
    }

    public function update(Request $request, Audience $audience)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        $audience->update($validated);

        return back()->with('toast', [
            'type' => 'success',
            'message' => 'Audience mise à jour avec succès.'
        ]);
    }

    public function destroy(Audience $audience)
    {
        $audience->delete();

        return back()->with('toast', [
            'type' => 'success',
            'message' => 'Audience supprimée avec succès.'
        ]);
    }
} 