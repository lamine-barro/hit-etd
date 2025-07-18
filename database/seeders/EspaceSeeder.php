<?php

namespace Database\Seeders;

use App\Models\Espace;
use Illuminate\Database\Seeder;

class EspaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $espaces = [
            // MEZZANINE (M2)
            [
                'name' => 'Salle de réunion Azalai',
                'code' => 'M2-D-01',
                'type' => 'meeting_room',
                'location' => 'Mezzanine, secteur D',
                'price_per_hour' => 8000.00,
                'minimum_duration' => 1,
                'floor' => 'Mezzanine',
                'room_count' => 1,
                'number_of_people' => 8,
                'status' => 'available',
                'is_active' => true,
                'illustration' => 'https://images.unsplash.com/photo-1560439514-4e9645039924?q=80&w=1000&auto=format&fit=crop',
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1560439514-4e9645039924?q=80&w=1000&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=1000&auto=format&fit=crop'
                ]),
            ],
            [
                'name' => 'Salle de réunion Bassam',
                'code' => 'M2-D-02',
                'type' => 'meeting_room',
                'location' => 'Mezzanine, secteur D',
                'price_per_hour' => 8000.00,
                'minimum_duration' => 1,
                'floor' => 'Mezzanine',
                'room_count' => 1,
                'number_of_people' => 8,
                'status' => 'available',
                'is_active' => true,
                'illustration' => 'https://images.unsplash.com/photo-1556761175-b413da4baf72?q=80&w=1000&auto=format&fit=crop',
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1556761175-b413da4baf72?q=80&w=1000&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=1000&auto=format&fit=crop'
                ]),
            ],
            [
                'name' => 'Bureau Individuel Plateau',
                'code' => 'M2-D-03',
                'type' => 'office',
                'location' => 'Mezzanine, secteur D',
                'price_per_hour' => 5000.00,
                'minimum_duration' => 2,
                'floor' => 'Mezzanine',
                'room_count' => 1,
                'number_of_people' => 2,
                'status' => 'available',
                'is_active' => true,
                'illustration' => 'https://images.unsplash.com/photo-1497366811353-6870744d04b2?q=80&w=1000&auto=format&fit=crop',
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1497366811353-6870744d04b2?q=80&w=1000&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?q=80&w=1000&auto=format&fit=crop'
                ]),
            ],
            [
                'name' => 'Bureau Opération HIT',
                'code' => 'M2-D-04',
                'type' => 'office',
                'location' => 'Mezzanine, secteur D',
                'price_per_hour' => 0.00, // Bureau réservé aux opérations HIT
                'minimum_duration' => 1,
                'floor' => 'Mezzanine',
                'room_count' => 1,
                'number_of_people' => 4,
                'status' => 'reserved',
                'is_active' => false,
                'illustration' => 'https://images.unsplash.com/photo-1497366754035-f200968a6e72?q=80&w=1000&auto=format&fit=crop',
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1497366754035-f200968a6e72?q=80&w=1000&auto=format&fit=crop'
                ]),
            ],
            [
                'name' => 'Bureau Privé Cocody',
                'code' => 'M2-D-05',
                'type' => 'office',
                'location' => 'Mezzanine, secteur D',
                'price_per_hour' => 5000.00,
                'minimum_duration' => 2,
                'floor' => 'Mezzanine',
                'room_count' => 1,
                'number_of_people' => 2,
                'status' => 'available',
                'is_active' => true,
                'illustration' => 'https://images.unsplash.com/photo-1542744094-3a31f272c490?q=80&w=1000&auto=format&fit=crop',
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1542744094-3a31f272c490?q=80&w=1000&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1541746972996-4e0b0f93e586?q=80&w=1000&auto=format&fit=crop'
                ]),
            ],
            [
                'name' => 'Fab-Lab Principal',
                'code' => 'M2-A-02',
                'type' => 'fab_lab',
                'location' => 'Mezzanine, secteur A (entrée principale)',
                'price_per_hour' => 10000.00,
                'minimum_duration' => 2,
                'floor' => 'Mezzanine',
                'room_count' => 1,
                'number_of_people' => 12,
                'status' => 'available',
                'is_active' => true,
                'illustration' => 'https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?q=80&w=1000&auto=format&fit=crop',
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?q=80&w=1000&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1581092160562-40aa08e78837?q=80&w=1000&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?q=80&w=1000&auto=format&fit=crop'
                ]),
            ],
            [
                'name' => 'Fab-Lab Secondaire',
                'code' => 'M2-A-01B',
                'type' => 'fab_lab',
                'location' => 'Mezzanine, secteur A (entrée arrière)',
                'price_per_hour' => 8000.00,
                'minimum_duration' => 2,
                'floor' => 'Mezzanine',
                'room_count' => 1,
                'number_of_people' => 8,
                'status' => 'available',
                'is_active' => true,
                'illustration' => 'https://images.unsplash.com/photo-1563013544-824ae1b704d3?q=80&w=1000&auto=format&fit=crop',
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1563013544-824ae1b704d3?q=80&w=1000&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1581092335397-9583eb92d232?q=80&w=1000&auto=format&fit=crop'
                ]),
            ],
            [
                'name' => 'Salle de Détente Lagune',
                'code' => 'M2-A-02-DETENTE',
                'type' => 'relaxation',
                'location' => 'Mezzanine, secteur A',
                'price_per_hour' => 1500.00,
                'minimum_duration' => 1,
                'floor' => 'Mezzanine',
                'room_count' => 1,
                'number_of_people' => 15,
                'status' => 'available',
                'is_active' => true,
                'illustration' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?q=80&w=1000&auto=format&fit=crop',
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?q=80&w=1000&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1555992336-03a23c041a4b?q=80&w=1000&auto=format&fit=crop'
                ]),
            ],
            [
                'name' => 'Cuisine Partagée',
                'code' => 'M2-N-09',
                'type' => 'kitchen',
                'location' => 'Mezzanine, secteur N',
                'price_per_hour' => 2000.00,
                'minimum_duration' => 1,
                'floor' => 'Mezzanine',
                'room_count' => 1,
                'number_of_people' => 10,
                'status' => 'available',
                'is_active' => true,
                'illustration' => 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?q=80&w=1000&auto=format&fit=crop',
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?q=80&w=1000&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1565538810643-b5bdb714032a?q=80&w=1000&auto=format&fit=crop'
                ]),
            ],

            // TREIZIÈME ÉTAGE (13)
            [
                'name' => 'Open Space Innovation A',
                'code' => '13-A-01A',
                'type' => 'open_space',
                'location' => 'Étage 13, secteur A',
                'price_per_hour' => 3000.00,
                'minimum_duration' => 2,
                'floor' => '13',
                'room_count' => 1,
                'number_of_people' => 8,
                'status' => 'available',
                'is_active' => true,
                'illustration' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=1000&auto=format&fit=crop',
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=1000&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1524758631624-e2822e304c36?q=80&w=1000&auto=format&fit=crop'
                ]),
            ],
            [
                'name' => 'Open Space Innovation B',
                'code' => '13-A-01B',
                'type' => 'open_space',
                'location' => 'Étage 13, secteur A',
                'price_per_hour' => 3000.00,
                'minimum_duration' => 2,
                'floor' => '13',
                'room_count' => 1,
                'number_of_people' => 8,
                'status' => 'available',
                'is_active' => true,
                'illustration' => 'https://images.unsplash.com/photo-1497366811353-6870744d04b2?q=80&w=1000&auto=format&fit=crop',
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1497366811353-6870744d04b2?q=80&w=1000&auto=format&fit=crop'
                ]),
            ],
            [
                'name' => 'Open Space Digital',
                'code' => '13-A-02',
                'type' => 'open_space',
                'location' => 'Étage 13, secteur A',
                'price_per_hour' => 3500.00,
                'minimum_duration' => 2,
                'floor' => '13',
                'room_count' => 1,
                'number_of_people' => 10,
                'status' => 'available',
                'is_active' => true,
                'illustration' => 'https://images.unsplash.com/photo-1562813733-b31f71025d54?q=80&w=1000&auto=format&fit=crop',
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1562813733-b31f71025d54?q=80&w=1000&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1517502884422-41eaead166d4?q=80&w=1000&auto=format&fit=crop'
                ]),
            ],
            [
                'name' => 'Open Space Tech',
                'code' => '13-A-03',
                'type' => 'open_space',
                'location' => 'Étage 13, secteur A',
                'price_per_hour' => 3500.00,
                'minimum_duration' => 2,
                'floor' => '13',
                'room_count' => 1,
                'number_of_people' => 10,
                'status' => 'available',
                'is_active' => true,
                'illustration' => 'https://images.unsplash.com/photo-1541746972996-4e0b0f93e586?q=80&w=1000&auto=format&fit=crop',
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1541746972996-4e0b0f93e586?q=80&w=1000&auto=format&fit=crop'
                ]),
            ],
            [
                'name' => 'Open Space Collaboration A',
                'code' => '13-B-01A',
                'type' => 'open_space',
                'location' => 'Étage 13, secteur B',
                'price_per_hour' => 3000.00,
                'minimum_duration' => 2,
                'floor' => '13',
                'room_count' => 1,
                'number_of_people' => 8,
                'status' => 'available',
                'is_active' => true,
                'illustration' => 'https://images.unsplash.com/photo-1524758631624-e2822e304c36?q=80&w=1000&auto=format&fit=crop',
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1524758631624-e2822e304c36?q=80&w=1000&auto=format&fit=crop'
                ]),
            ],
            [
                'name' => 'Open Space Collaboration B',
                'code' => '13-B-01B',
                'type' => 'open_space',
                'location' => 'Étage 13, secteur B',
                'price_per_hour' => 3000.00,
                'minimum_duration' => 2,
                'floor' => '13',
                'room_count' => 1,
                'number_of_people' => 8,
                'status' => 'available',
                'is_active' => true,
                'illustration' => 'https://images.unsplash.com/photo-1517502884422-41eaead166d4?q=80&w=1000&auto=format&fit=crop',
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1517502884422-41eaead166d4?q=80&w=1000&auto=format&fit=crop'
                ]),
            ],
            [
                'name' => 'Open Space Premium A',
                'code' => '13-B-02A',
                'type' => 'open_space',
                'location' => 'Étage 13, secteur B',
                'price_per_hour' => 4500.00,
                'minimum_duration' => 2,
                'floor' => '13',
                'room_count' => 1,
                'number_of_people' => 16,
                'status' => 'available',
                'is_active' => true,
                'illustration' => 'https://images.unsplash.com/photo-1497366412874-3415097a27e7?q=80&w=1000&auto=format&fit=crop',
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1497366412874-3415097a27e7?q=80&w=1000&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?q=80&w=1000&auto=format&fit=crop'
                ]),
            ],
            [
                'name' => 'Open Space Premium B',
                'code' => '13-B-02B',
                'type' => 'open_space',
                'location' => 'Étage 13, secteur B',
                'price_per_hour' => 4500.00,
                'minimum_duration' => 2,
                'floor' => '13',
                'room_count' => 1,
                'number_of_people' => 16,
                'status' => 'available',
                'is_active' => true,
                'illustration' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?q=80&w=1000&auto=format&fit=crop',
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?q=80&w=1000&auto=format&fit=crop'
                ]),
            ],
            [
                'name' => 'Open Space Focus A',
                'code' => '13-C-01A',
                'type' => 'open_space',
                'location' => 'Étage 13, secteur C',
                'price_per_hour' => 4000.00,
                'minimum_duration' => 2,
                'floor' => '13',
                'room_count' => 1,
                'number_of_people' => 14,
                'status' => 'available',
                'is_active' => true,
                'illustration' => 'https://images.unsplash.com/photo-1536431311719-398b6704d4cc?q=80&w=1000&auto=format&fit=crop',
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1536431311719-398b6704d4cc?q=80&w=1000&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1564928538308-a6b04bf2de9b?q=80&w=1000&auto=format&fit=crop'
                ]),
            ],
            [
                'name' => 'Open Space Focus B',
                'code' => '13-C-01B',
                'type' => 'open_space',
                'location' => 'Étage 13, secteur C',
                'price_per_hour' => 4000.00,
                'minimum_duration' => 2,
                'floor' => '13',
                'room_count' => 1,
                'number_of_people' => 14,
                'status' => 'available',
                'is_active' => true,
                'illustration' => 'https://images.unsplash.com/photo-1564928538308-a6b04bf2de9b?q=80&w=1000&auto=format&fit=crop',
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1564928538308-a6b04bf2de9b?q=80&w=1000&auto=format&fit=crop'
                ]),
            ],
            [
                'name' => 'Grande Salle de Conférence',
                'code' => '13-C-02A',
                'type' => 'meeting_room',
                'location' => 'Étage 13, secteur C',
                'price_per_hour' => 15000.00,
                'minimum_duration' => 2,
                'floor' => '13',
                'room_count' => 1,
                'number_of_people' => 40,
                'status' => 'available',
                'is_active' => true,
                'illustration' => 'https://images.unsplash.com/photo-1505373877841-8d25f7d46678?q=80&w=1000&auto=format&fit=crop',
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1505373877841-8d25f7d46678?q=80&w=1000&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1578662996442-48f60103fc96?q=80&w=1000&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1582653291997-079a1c04e5a1?q=80&w=1000&auto=format&fit=crop'
                ]),
            ],
            [
                'name' => 'Open Space Excellence A',
                'code' => '13-D-01A',
                'type' => 'open_space',
                'location' => 'Étage 13, secteur D',
                'price_per_hour' => 3000.00,
                'minimum_duration' => 2,
                'floor' => '13',
                'room_count' => 1,
                'number_of_people' => 8,
                'status' => 'available',
                'is_active' => true,
                'illustration' => 'https://images.unsplash.com/photo-1521791136064-7986c2920216?q=80&w=1000&auto=format&fit=crop',
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1521791136064-7986c2920216?q=80&w=1000&auto=format&fit=crop'
                ]),
            ],
            [
                'name' => 'Open Space Excellence B',
                'code' => '13-D-01B',
                'type' => 'open_space',
                'location' => 'Étage 13, secteur D',
                'price_per_hour' => 3000.00,
                'minimum_duration' => 2,
                'floor' => '13',
                'room_count' => 1,
                'number_of_people' => 8,
                'status' => 'available',
                'is_active' => true,
                'illustration' => 'https://images.unsplash.com/photo-1574027887433-57a0d7f51c88?q=80&w=1000&auto=format&fit=crop',
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1574027887433-57a0d7f51c88?q=80&w=1000&auto=format&fit=crop'
                ]),
            ],
            [
                'name' => 'Bureau Exécutif',
                'code' => '13-D-02',
                'type' => 'office',
                'location' => 'Étage 13, secteur D',
                'price_per_hour' => 8000.00,
                'minimum_duration' => 2,
                'floor' => '13',
                'room_count' => 1,
                'number_of_people' => 4,
                'status' => 'available',
                'is_active' => true,
                'illustration' => 'https://images.unsplash.com/photo-1497366754035-f200968a6e72?q=80&w=1000&auto=format&fit=crop',
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1497366754035-f200968a6e72?q=80&w=1000&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?q=80&w=1000&auto=format&fit=crop'
                ]),
            ],
            [
                'name' => 'Salle de Réunion Standard',
                'code' => '13-D-03',
                'type' => 'meeting_room',
                'location' => 'Étage 13, secteur D',
                'price_per_hour' => 10000.00,
                'minimum_duration' => 1,
                'floor' => '13',
                'room_count' => 1,
                'number_of_people' => 10,
                'status' => 'available',
                'is_active' => true,
                'illustration' => 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=1000&auto=format&fit=crop',
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=1000&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1560439514-4e9645039924?q=80&w=1000&auto=format&fit=crop'
                ]),
            ],
            [
                'name' => 'Salle de Conseil Stratégique',
                'code' => '13-D-04',
                'type' => 'meeting_room',
                'location' => 'Étage 13, secteur D',
                'price_per_hour' => 12000.00,
                'minimum_duration' => 2,
                'floor' => '13',
                'room_count' => 1,
                'number_of_people' => 12,
                'status' => 'available',
                'is_active' => true,
                'illustration' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=1000&auto=format&fit=crop',
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=1000&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1505373877841-8d25f7d46678?q=80&w=1000&auto=format&fit=crop'
                ]),
            ],
        ];

        foreach ($espaces as $espaceData) {
            if (!Espace::where('code', $espaceData['code'])->exists()) {
                Espace::create($espaceData);
            }
        }
    }
} 