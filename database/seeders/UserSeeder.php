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
        if (! Administrator::query()->whereEmail('lamine.azinakou@wazmine.com')->exists()) {
            Administrator::create([
                'first_name' => 'Lamine',
                'last_name' => 'AZINAKOU',
                'phone_number' => '+2250709538217',
                'email' => 'lamine.azinakou@wazmine.com',
                'password' => bcrypt('lamine.azinakou@wazmine.com'),
            ]);
        }

        if (! User::query()->where('email', env('HIT_SUPPORT_EMAIL'))->exists()) {
            User::create([
                'name' => 'Hub Ivoire Tech',
                'email' => env('HIT_SUPPORT_EMAIL'),
                'password' => Hash::make('HIT_#secret@2025'),
                'email_verified_at' => now(),
            ]);
        }
    }
}
