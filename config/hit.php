<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Configuration du Hub Ivoire Tech
    |--------------------------------------------------------------------------
    */

    'name' => env('HIT_NAME', 'Hub Ivoire Tech'),
    'description' => 'A pour vocation d\'être le plus grand Campus de Startups en Afrique',

    // Contact Information
    'address' => env('HIT_ADDRESS', 'Tour POSTEL 2001, Mezzanine et 13e étage, Plateau - Abidjan, Côte d\'Ivoire'),
    'phone' => env('HIT_PHONE', '+225 0704853848'),
    'email' => env('HIT_EMAIL', 'hello@hubivoiretech.ci'),
    'support_email' => env('HIT_SUPPORT_EMAIL', 'hello@hubivoiretech.ci'),

    // Social Media Links
    'social' => [
        'facebook' => 'https://facebook.com/hubivoiretech',
        'twitter' => 'https://twitter.com/hubivoiretech',
        'linkedin' => 'https://linkedin.com/company/hubivoiretech',
        'instagram' => 'https://instagram.com/hubivoiretech',
        'youtube' => 'https://youtube.com/hubivoiretech',
    ],
    // Partners
    'partners' => [
        'premium' => ['ANSUT'],
        'platinum' => ['ARTCI', 'PETROCI', 'CI-ENERGIES'],
        'gold' => ['VITIB', 'CCC'],
        'silver' => ['LONACI', 'PAA'],
    ],
];
