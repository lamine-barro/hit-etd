<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // Core seeders (basic setup)
            AdministratorSeeder::class,
            ResidentSeeder::class,
            
            // Content seeders
            ArticleSeeder::class,
            EventSeeder::class,
            
            // Space and facility seeders
            EspaceSeeder::class,
            
            // Expert and partnership seeders
            ExpertSeeder::class,
            PartnershipSeeder::class,
            BookingSeeder::class,
        ]);
    }
}
