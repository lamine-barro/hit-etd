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

    public function store(Request $request)
    {
        // Handle the form submission for joining the hub
        // This could include validation, saving to the database, etc.

        // Example: Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            // Add other validation rules as needed
        ]);

        // Redirect or return a response
        return redirect()->route('home')->with('success', 'You have successfully joined the hub!');
    }
}
