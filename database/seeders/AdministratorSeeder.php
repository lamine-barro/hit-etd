<?php

namespace Database\Seeders;

use App\Models\Administrator;
use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $administrators = [
            [
                'first_name' => 'Admin',
                'last_name' => 'Hub Ivoire Tech',
                'email' => 'admin@hubivoiretech.ci',
                'phone_number' => '+2250102030405',
                'email_verified_at' => now(),
                'last_login_at' => now(),
                'login_ip' => '127.0.0.1',
            ],
        ];

        foreach ($administrators as $adminData) {
            if (!Administrator::where('email', $adminData['email'])->exists()) {
                Administrator::create($adminData);
            }
        }
    }
} 