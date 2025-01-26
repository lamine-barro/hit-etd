<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormationsController extends Controller
{
    /**
     * Display the formations page.
     */
    public function index()
    {
        return view('pages.formations');
    }
}
