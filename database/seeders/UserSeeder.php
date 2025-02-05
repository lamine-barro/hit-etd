<?php

namespace Database\Seeders;

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
        if (!User::query()->where('email', 'hello@hubivoiretech.ci')->exists()) {
            User::create([
                'name' => 'Hub Ivoire Tech',
                'email' => 'hello@hubivoiretech.ci',
                'password' => Hash::make('HIT_#secret@2025'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]);
        }
    }
}
