<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group.
|
*/

// Routes publiques/visiteurs
require __DIR__.'/web/guest.php';

// Routes d'authentification
require __DIR__.'/web/auth.php';

// Routes des résidents
require __DIR__.'/web/resident.php';
