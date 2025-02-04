<?php

namespace App\Http\Controllers;

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
