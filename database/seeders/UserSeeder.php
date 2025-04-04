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
        Administrator::create([
            'first_name' => 'Lamine',
            'last_name' => 'AZINAKOU',
            'phone_number' => '+2250709538217',
            'email' => 'lamine.azinakou@wazmine.com',
            'password' => bcrypt('lamine.azinakou@wazmine.com'),
        ]);

        if (!User::query()->where('email', 'hello@hubivoiretech.ci')->exists()) {
            User::create([
                'name' => 'Hub Ivoire Tech',
                'email' => 'hello@hubivoiretech.ci',
                'password' => Hash::make('HIT_#secret@2025'),
                'email_verified_at' => now(),
            ]);
        }
    }
}
