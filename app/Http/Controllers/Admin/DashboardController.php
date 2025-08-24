<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Event;
use App\Models\Espace;
use App\Models\Partnership;
use App\Models\Expert;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'users_count' => User::count(),
            'events_count' => Event::count(),
            'espaces_count' => Espace::count(),
            'partnerships_pending' => Partnership::where('status', 'untreated')->count(),
            'experts_count' => Expert::count(),
        ];

        return view('pages.admin.dashboard', compact('stats'));
    }
}