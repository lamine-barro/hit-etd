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
                'first_name' => 'Marie-Claire',
                'last_name' => 'KOUASSI',
                'email' => 'marie.kouassi@hubivoiretech.ci',
                'phone_number' => '+2250707123456',
                'avatar_url' => 'https://images.unsplash.com/photo-1494790108755-2616b612b647?q=80&w=300&auto=format&fit=crop',
                'email_verified_at' => now(),
                'last_login_at' => now()->subDays(2),
                'login_ip' => '41.79.80.1', // IP range Côte d'Ivoire
            ],
            [
                'first_name' => 'Kouadio',
                'last_name' => 'ANOH',
                'email' => 'kouadio.anoh@hubivoiretech.ci',
                'phone_number' => '+2250708234567',
                'avatar_url' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?q=80&w=300&auto=format&fit=crop',
                'email_verified_at' => now(),
                'last_login_at' => now()->subDays(1),
                'login_ip' => '154.72.160.1', // IP range Côte d'Ivoire
            ],
            [
                'first_name' => 'Fatou',
                'last_name' => 'DIALLO',
                'email' => 'fatou.diallo@hubivoiretech.ci',
                'phone_number' => '+2250709345678',
                'avatar_url' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=300&auto=format&fit=crop',
                'email_verified_at' => now(),
                'last_login_at' => now()->subHours(5),
                'login_ip' => '197.149.80.1', // IP range Côte d'Ivoire
            ],
        ];

        foreach ($administrators as $adminData) {
            if (!Administrator::where('email', $adminData['email'])->exists()) {
                Administrator::create($adminData);
            }
        }
    }
} 