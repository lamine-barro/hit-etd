<?php

namespace App\Http\Controllers;

use App\Models\Expert;
use App\Models\Partnership;
use App\Enums\PartnershipType;
use App\Mail\ExpertApplicationConfirmation;
use App\Mail\PartnershipApplicationConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ApplicationController extends Controller
{
    /**
     * Display the application form page
     */
    public function index()
    {
        return view('pages.applications.index');
    }

    /**
     * Store a new resident application
     */
    public function storeResident(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required|string|in:startup,structure_accompagnement,professionnel,gestionnaire',
            'organization_name' => 'nullable|string|max:255',
            'representative_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'required|string|max:20',
            'specific_needs' => 'nullable|string|max:1000',
        ], [
            'category.required' => 'La catégorie est obligatoire.',
            'category.in' => 'La catégorie sélectionnée est invalide.',
            'representative_name.required' => 'Le nom et prénom sont obligatoires.',
            'email.required' => 'L\'adresse email est obligatoire.',
            'email.email' => 'L\'adresse email doit être valide.',
            'email.unique' => 'Cette adresse email est déjà utilisée.',
            'phone.required' => 'Le numéro de téléphone est obligatoire.',
        ]);

        if ($validator->fails()) {
            $firstError = $validator->errors()->first();
            return redirect()->route('applications')
                ->withInput()
                ->with('toast', [
                    'type' => 'error',
                    'message' => $firstError
                ]);
        }

        $application = \App\Models\User::create([
            'category' => $request->category,
            'name' => $request->representative_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'needs' => $request->specific_needs,
            'is_request' => true,
            'is_active' => false,
            'is_verified' => false,
        ]);

        // Envoyer les notifications
        try {
            // Notification au candidat
            $application->notify(new \App\Notifications\ResidentApplicationPendingNotification($application));
            
            // Notification au premier administrateur seulement
            $admin = \App\Models\Administrator::first();
            if ($admin) {
                $admin->notify(new \App\Notifications\AdminNewResidentApplicationNotification($application));
            }
        } catch (\Exception $e) {
            // Log l'erreur mais ne pas faire échouer la création
            \Log::error('Erreur envoi notifications candidature résidence: ' . $e->getMessage());
        }

        return redirect()->route('home')->with('toast', [
            'type' => 'success',
            'message' => 'Votre candidature a été soumise avec succès ! Nous vous contacterons bientôt.'
        ]);
    }

    /**
     * Store a new partnership application
     */
    public function storePartnership(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'partnership_type' => 'required|string|in:' . implode(',', PartnershipType::values()),
            'organization_name' => 'required|string|max:255',
            'representative_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string|max:1000',
        ], [
            'partnership_type.required' => 'Le type de partenariat est obligatoire.',
            'partnership_type.in' => 'Le type de partenariat sélectionné est invalide.',
            'organization_name.required' => 'Le nom de l\'organisation est obligatoire.',
            'representative_name.required' => 'Le nom et prénom sont obligatoires.',
            'email.required' => 'L\'adresse email est obligatoire.',
            'email.email' => 'L\'adresse email doit être valide.',
            'phone.required' => 'Le numéro de téléphone est obligatoire.',
            'message.required' => 'Le message est obligatoire.',
        ]);

        if ($validator->fails()) {
            $firstError = $validator->errors()->first();
            return redirect()->route('applications')
                ->withInput()
                ->with('toast', [
                    'type' => 'error',
                    'message' => $firstError
                ]);
        }

        $partnership = Partnership::create([
            'type' => $request->partnership_type,
            'organization_name' => $request->organization_name,
            'contact_name' => $request->representative_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
        ]);

        // Envoyer l'email de confirmation
        try {
            Mail::to($partnership->email)->send(new PartnershipApplicationConfirmation($partnership));
        } catch (\Exception $e) {
            // Log l'erreur mais ne pas faire échouer la création
            \Log::error('Erreur envoi email confirmation partenariat: ' . $e->getMessage());
        }

        return redirect()->route('home')->with('toast', [
            'type' => 'success',
            'message' => 'Votre candidature a été soumise avec succès ! Nous vous contacterons bientôt.'
        ]);
    }

    /**
     * Store a new expert application
     */
    public function storeExpert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'organization' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:experts,email',
            'phone' => 'required|string|max:20',
            'linkedin' => 'nullable|url|max:255',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'specialties' => 'required|array|min:1',
            'specialties.*' => 'string|in:' . implode(',', array_keys(\App\Models\Expert::SPECIALTIES)),
            'other_specialty' => 'nullable|string|max:255',
            'training_types' => 'required|array|min:1',
            'training_types.*' => 'string|in:' . implode(',', array_keys(\App\Models\Expert::TRAINING_TYPES)),
            'pedagogical_methods' => 'required|array|min:1',
            'pedagogical_methods.*' => 'string|in:' . implode(',', array_keys(\App\Models\Expert::PEDAGOGICAL_METHODS)),
            'target_audiences' => 'required|array|min:1',
            'target_audiences.*' => 'string|in:' . implode(',', array_keys(\App\Models\Expert::TARGET_AUDIENCES)),
            'intervention_frequency' => 'required|string|in:' . implode(',', array_keys(\App\Models\Expert::INTERVENTION_FREQUENCIES)),
            'preferred_days' => 'required|array|min:1',
            'preferred_days.*' => 'string|in:' . implode(',', array_keys(\App\Models\Expert::PREFERRED_DAYS)),
            'time_slots' => 'required|array|min:1',
            'time_slots.*' => 'string|in:' . implode(',', array_keys(\App\Models\Expert::TIME_SLOTS)),
        ], [
            'name.required' => 'Le nom et prénom sont obligatoires.',
            'email.required' => 'L\'adresse email est obligatoire.',
            'email.email' => 'L\'adresse email doit être valide.',
            'email.unique' => 'Cette adresse email est déjà utilisée.',
            'phone.required' => 'Le numéro de téléphone est obligatoire.',
            'specialties.required' => 'Au moins une spécialité est obligatoire.',
            'training_types.required' => 'Au moins un type de formation est obligatoire.',
            'pedagogical_methods.required' => 'Au moins une méthode pédagogique est obligatoire.',
            'target_audiences.required' => 'Au moins un public cible est obligatoire.',
            'intervention_frequency.required' => 'La fréquence d\'intervention est obligatoire.',
            'preferred_days.required' => 'Au moins un jour préféré est obligatoire.',
            'time_slots.required' => 'Au moins un créneau horaire est obligatoire.',
        ]);

        if ($validator->fails()) {
            $firstError = $validator->errors()->first();
            return redirect()->route('applications')
                ->withInput()
                ->with('toast', [
                    'type' => 'error',
                    'message' => $firstError
                ]);
        }

        $cvPath = null;
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cvs', 'public');
        }

        $expert = Expert::create([
            'full_name' => $request->name,
            'organization' => $request->organization,
            'position' => $request->position,
            'email' => $request->email,
            'phone' => $request->phone,
            'linkedin' => $request->linkedin,
            'cv_path' => $cvPath,
            'specialties' => $request->specialties, // déjà array
            'specialty_other' => $request->other_specialty,
            'training_types' => $request->training_types, // déjà array
            'pedagogical_methods' => $request->pedagogical_methods, // déjà array
            'target_audiences' => $request->target_audiences, // déjà array
            'intervention_frequencies' => [$request->intervention_frequency], // convertir string en array
            'preferred_days_detailed' => $request->preferred_days, // déjà array
            'time_slots' => $request->time_slots, // déjà array
        ]);

        // Envoyer l'email de confirmation
        try {
            Mail::to($expert->email)->send(new ExpertApplicationConfirmation($expert));
        } catch (\Exception $e) {
            // Log l'erreur mais ne pas faire échouer la création
            \Log::error('Erreur envoi email confirmation expert: ' . $e->getMessage());
        }

        return redirect()->route('home')->with('toast', [
            'type' => 'success',
            'message' => 'Votre candidature a été soumise avec succès ! Nous vous contacterons bientôt.'
        ]);
    }
}
