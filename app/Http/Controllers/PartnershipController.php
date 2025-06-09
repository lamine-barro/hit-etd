<?php

namespace App\Http\Controllers;

use App\Enums\PartnershipStatus;
use App\Enums\PartnershipType;
use App\Models\Partnership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Enum;

class PartnershipController extends Controller
{
    /**
     * Affiche le formulaire de demande de partenariat.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $partnershipTypes = PartnershipType::options();

        return view('pages.partnership', [
            'partnershipTypes' => $partnershipTypes,
        ]);
    }

    /**
     * Traite la soumission d'une demande de partenariat.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => ['required', new Enum(PartnershipType::class)],
            'organization_name' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string|min:10',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $partnership = Partnership::create([
            'type' => $request->type,
            'organization_name' => $request->organization_name,
            'contact_name' => $request->contact_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'status' => PartnershipStatus::PENDING,
        ]);

        // Ici, on pourrait ajouter l'envoi d'un email de confirmation

        return redirect()->route('partnership.thank-you');
    }

    /**
     * Affiche la page de remerciement après soumission d'une demande.
     *
     * @return \Illuminate\View\View
     */
    public function thankYou()
    {
        return view('pages.partnership-thank-you');
    }
}
