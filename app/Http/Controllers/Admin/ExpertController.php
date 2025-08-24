<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expert;
use App\Traits\HandlesImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ExpertController extends Controller
{
    use HandlesImageUpload;
    public function index(Request $request)
    {
        $query = Expert::query();

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('specialties') && $request->specialties != '') {
            $query->whereJsonContains('specialties', $request->specialties);
        }

        $experts = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return view('pages.admin.experts.index', compact('experts'));
    }

    public function show(Expert $expert)
    {
        return view('pages.admin.experts.show', compact('expert'));
    }

    public function create()
    {
        return view('pages.admin.experts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:experts',
            'phone' => 'nullable|string|max:255',
            'organization' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'linkedin' => 'nullable|url|max:255',
            'specialties' => 'required|array',
            'specialty_other' => 'nullable|string|max:255',
            'training_types' => 'nullable|array',
            'pedagogical_methods' => 'nullable|array',
            'target_audiences' => 'nullable|array',
            'intervention_frequencies' => 'nullable|array',
            'preferred_days_detailed' => 'nullable|array',
            'time_slots' => 'nullable|array',
            'status' => 'required|string|in:pending,approved,rejected',
            'admin_notes' => 'nullable|string',
            'cv_path' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        if ($request->hasFile('cv_path')) {
            $validated['cv_path'] = $request->file('cv_path')->store('experts/cv', 'public');
        }

        if ($request->hasFile('profile_picture')) {
            $validated['profile_picture'] = $this->optimizeProfilePicture($request->file('profile_picture'));
        }

        if ($request->status !== 'pending') {
            $validated['processed_at'] = Carbon::now();
        }

        Expert::create($validated);

        return redirect()->route('admin.experts.index')->with('success', 'Expert créé avec succès.');
    }

    public function edit(Expert $expert)
    {
        return view('pages.admin.experts.edit', compact('expert'));
    }

    public function update(Request $request, Expert $expert)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:experts,email,' . $expert->id,
            'phone' => 'nullable|string|max:255',
            'organization' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'linkedin' => 'nullable|url|max:255',
            'specialties' => 'required|array',
            'specialty_other' => 'nullable|string|max:255',
            'training_types' => 'nullable|array',
            'pedagogical_methods' => 'nullable|array',
            'target_audiences' => 'nullable|array',
            'intervention_frequencies' => 'nullable|array',
            'preferred_days_detailed' => 'nullable|array',
            'time_slots' => 'nullable|array',
            'status' => 'required|string|in:pending,approved,rejected',
            'admin_notes' => 'nullable|string',
            'cv_path' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        if ($request->hasFile('cv_path')) {
            if ($expert->cv_path) {
                Storage::disk('public')->delete($expert->cv_path);
            }
            $validated['cv_path'] = $request->file('cv_path')->store('experts/cv', 'public');
        }

        if ($request->hasFile('profile_picture')) {
            $this->deleteImage($expert->profile_picture);
            $validated['profile_picture'] = $this->optimizeProfilePicture($request->file('profile_picture'));
        }

        if ($request->status !== $expert->status && $request->status !== 'pending') {
            $validated['processed_at'] = Carbon::now();
        }

        $expert->update($validated);

        return redirect()->route('admin.experts.index')->with('success', 'Expert mis à jour avec succès.');
    }

    public function destroy(Expert $expert)
    {
        if ($expert->cv_path) {
            Storage::disk('public')->delete($expert->cv_path);
        }

        $this->deleteImage($expert->profile_picture);

        $expert->delete();

        return redirect()->route('admin.experts.index')->with('success', 'Expert supprimé avec succès.');
    }

    public function approve(Expert $expert)
    {
        $expert->update([
            'status' => 'approved',
            'processed_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'Expert approuvé avec succès.');
    }

    public function reject(Expert $expert)
    {
        $expert->update([
            'status' => 'rejected',
            'processed_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'Expert rejeté avec succès.');
    }
}