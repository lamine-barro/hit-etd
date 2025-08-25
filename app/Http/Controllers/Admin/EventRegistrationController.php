<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventRegistration;
use Illuminate\Http\Request;

class EventRegistrationController extends Controller
{
    public function destroy($registrationId)
    {
        $registration = EventRegistration::findOrFail($registrationId);
        $eventId = $registration->event_id;
        $registration->delete();

        return redirect()->route('admin.events.show', $eventId)->with('success', 'Inscription supprimée avec succès.');
    }
}
