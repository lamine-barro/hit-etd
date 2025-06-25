<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JoinHubController extends Controller
{
    public function index(Request $request)
    {
        // Render the join hub view for unauthenticated users
        return view('pages.join-hub', [
            'pageTitle' => __('Rejoignez Hub Ivoire Tech'),
            'metaDescription' => __("Rejoignez Hub Ivoire Tech, le plus grand campus de startups en Afrique. Inscrivez-vous pour bénéficier de nos services d'incubation, de coworking et d'événements."),
        ]);
    }

    public function storeExpert(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'organization' => 'nullable|string|max:255',
            'specialties' => 'nullable|array',
            'specialty_other' => 'nullable|string|max:255',
            'training_types' => 'nullable|array',
            'training_details' => 'nullable|string|max:500',
            'target_audience' => 'nullable|array',
            'intervention_frequency' => 'nullable|array',
            'intervention_other' => 'nullable|string|max:255',
            'preferred_days' => 'nullable|array',
            'preferred_times' => 'nullable|array',
            'remarks' => 'nullable|string|max:500',
        ]);

        // Create the expert record
        $expert = new \App\Models\Expert;
        $expert->full_name = $request->input('full_name');
        $expert->email = $request->input('email');
        $expert->phone = $request->input('phone');
        $expert->organization = $request->input('organization');
        $expert->specialties = $request->input('specialties', []);
        $expert->specialty_other = $request->input('specialty_other');
        $expert->training_types = $request->input('training_types', []);
        $expert->training_details = $request->input('training_details');
        $expert->target_audience = $request->input('target_audience', []);
        $expert->intervention_frequency = $request->input('intervention_frequency', []);
        $expert->intervention_other = $request->input('intervention_other');
        $expert->preferred_days = $request->input('preferred_days', []);
        $expert->preferred_times = $request->input('preferred_times', []);
        $expert->remarks = $request->input('remarks');
        // $expert->cv_path = $request->file('cv') ? $request->file('cv')->store('cvs', 'public') : null;
        $expert->save();

        // Redirect or return a response
        return response()->json([
            'status' => 'success', 'message' => 'You have successfully joined the hub!',
        ]);
    }

    public function storeResident(Request $request)
    {
        $request->validate([
            'resident_category' => 'required|string|max:255',
            'resident_full_name' => 'required|string|max:255',
            'resident_email' => 'required|email|max:255',
            'resident_phone' => 'nullable|string|max:20',
            'with_responsible' => 'nullable|boolean',
            'responsible_name' => 'nullable|string|max:255',
            'responsible_phone' => 'nullable|string|max:20',
            'resident_needs' => 'nullable|string|max:500',
        ]);

        // Check email uniqueness
        $existingResident = \App\Models\User::where('email', $request->input('resident_email'))->first();

        if ($existingResident) {
            return response()->json([
                'success' => false,
                'message' => 'Cette adresse e-mail est déjà utilisée. Veuillez en choisir une autre.',
            ], 422);
        }

        // Example: Save to Resident model (adjust as needed)
        $resident = new \App\Models\User;
        $resident->category = $request->input('resident_category');
        $resident->name = $request->input('resident_full_name');
        $resident->email = $request->input('resident_email');
        $resident->phone = $request->input('resident_phone');
        $resident->with_responsible = $request->boolean('with_responsible');
        $resident->responsible_name = $request->input('responsible_name');
        $resident->responsible_phone = $request->input('responsible_phone');
        $resident->needs = $request->input('resident_needs');
        $resident->is_verified = false;
        $resident->is_active = false;
        $resident->is_request = true;
        $resident->save();

        return response()->json([
            'success' => true,
            'message' => 'Vous avez rejoint le hub avec succès !',
        ]);
    }
}
