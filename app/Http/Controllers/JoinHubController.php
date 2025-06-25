<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JoinHubController extends Controller
{
    public function index(Request $request)
    {
        // Render the join hub view for unauthenticated users
        return view('pages.join-hub', [
            'pageTitle' => __('Rejoignez le Hub Ivoire Tech'),
            'metaDescription' => __("Rejoignez le Hub Ivoire Tech, le plus grand campus de startups en Afrique. Inscrivez-vous pour bénéficier de nos services d'incubation, de coworking et d'événements."),
        ]);
    }

    public function storeExpert(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
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
        $expert = new \App\Models\Expert();
        $expert->first_name = $request->input('first_name');
        $expert->last_name = $request->input('last_name');
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
        $expert->cv_path = $request->file('cv') ? $request->file('cv')->store('cvs', 'public') : null;
        $expert->save();

        // Redirect or return a response
        return redirect()->route('home')->with('success', 'You have successfully joined the hub!');
    }

    public function storeResident(Request $request)
    {
        return response()->json(['message' => 'Startup registration not implemented yet.'], 501);
    }
}
