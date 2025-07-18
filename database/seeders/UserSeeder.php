<?php

namespace Database\Seeders;

use App\Models\Administrator;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Les administrateurs n'ont plus de mot de passe - ils utilisent OTP
        if (! Administrator::query()->whereEmail('lamine.azinakou@wazmine.com')->exists()) {
            Administrator::create([
                'first_name' => 'Lamine',
                'last_name' => 'AZINAKOU',
                'phone_number' => '+2250709538217',
                'email' => 'lamine.azinakou@wazmine.com',
                'email_verified_at' => now(),
            ]);
        }

        // Ajout d'autres administrateurs si nécessaire
        if (! Administrator::query()->whereEmail('hello@hubivoiretech.ci')->exists()) {
            Administrator::create([
                'first_name' => 'Admin',
                'last_name' => 'HIT',
                'phone_number' => '+2250111111111',
                'email' => 'hello@hubivoiretech.ci',
                'email_verified_at' => now(),
            ]);
        }

        if (! User::query()->where('email', env('HIT_SUPPORT_EMAIL'))->exists()) {
            User::create([
                'name' => 'Hub Ivoire Tech',
                'email' => env('HIT_SUPPORT_EMAIL'),
                'password' => Hash::make('HIT_#secret@2025'),
                'email_verified_at' => now(),
                'needs' => 'Administration system user',
                'is_active' => true,
                'is_verified' => true,
            ]);
        }
    }
}
