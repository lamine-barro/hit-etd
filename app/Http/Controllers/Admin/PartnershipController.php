<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partnership;
use App\Enums\PartnershipStatus;
use App\Enums\PartnershipType;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PartnershipController extends Controller
{
    public function index(Request $request)
    {
        $query = Partnership::query();

        if ($request->has('type') && $request->type != '') {
            $query->where('type', $request->type);
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $partnerships = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return view('pages.admin.partnerships.index', compact('partnerships'));
    }

    public function show(Partnership $partnership)
    {
        return view('pages.admin.partnerships.show', compact('partnership'));
    }

    public function create()
    {
        return view('pages.admin.partnerships.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string',
            'organization_name' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string',
            'message' => 'required|string',
            'status' => 'required|string',
            'internal_notes' => 'nullable|string',
        ]);

        Partnership::create($validated);

        return redirect()->route('admin.partnerships.index')->with('success', 'Partenariat créé avec succès.');
    }

    public function edit(Partnership $partnership)
    {
        return view('pages.admin.partnerships.edit', compact('partnership'));
    }

    public function update(Request $request, Partnership $partnership)
    {
        $validated = $request->validate([
            'type' => 'required|string',
            'organization_name' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string',
            'message' => 'required|string',
            'status' => 'required|string',
            'internal_notes' => 'nullable|string',
        ]);

        if ($request->status !== $partnership->status->value && $request->status !== 'untreated') {
            $validated['processed_at'] = Carbon::now();
        }

        $partnership->update($validated);

        return redirect()->route('admin.partnerships.index')->with('success', 'Partenariat mis à jour avec succès.');
    }

    public function destroy(Partnership $partnership)
    {
        $partnership->delete();

        return redirect()->route('admin.partnerships.index')->with('success', 'Partenariat supprimé avec succès.');
    }

    public function approve(Partnership $partnership)
    {
        $partnership->update([
            'status' => PartnershipStatus::TREATED,
            'processed_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'Partenariat approuvé avec succès.');
    }

    public function reject(Partnership $partnership)
    {
        $partnership->update([
            'status' => PartnershipStatus::ARCHIVED,
            'processed_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'Partenariat refusé avec succès.');
    }

    public function updateStatus(Request $request, Partnership $partnership)
    {
        $request->validate([
            'status' => 'required|string'
        ]);

        $partnership->update([
            'status' => $request->status,
            'processed_at' => $request->status !== 'untreated' ? Carbon::now() : null
        ]);

        return redirect()->back()->with('success', 'Statut mis à jour avec succès.');
    }
}