<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class ResidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $residents = [
            [
                'name' => 'Aya TRAORE',
                'email' => 'aya.traore@gmail.com',
                'phone' => '+2250701123456',
                'profile_picture' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?q=80&w=300&auto=format&fit=crop',
                'email_verified_at' => now(),
                'is_active' => true,
                'is_verified' => true,
                'is_request' => false,
                'category' => 'startup',
                'needs' => 'Développement d\'une plateforme e-commerce pour produits locaux',
                'documents' => json_encode([
                    'cv' => 'documents/cv_aya_traore.pdf',
                    'business_plan' => 'documents/bp_ecommerce_local.pdf'
                ]),
            ],
            [
                'name' => 'Sekou OUATTARA',
                'email' => 'sekou.ouattara@yahoo.fr',
                'phone' => '+2250702234567',
                'profile_picture' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=300&auto=format&fit=crop',
                'email_verified_at' => now(),
                'is_active' => true,
                'is_verified' => true,
                'is_request' => false,
                'category' => 'tech_startup',
                'needs' => 'Application mobile de transport urbain smart pour Abidjan',
                'documents' => json_encode([
                    'cv' => 'documents/cv_sekou_ouattara.pdf',
                    'prototype' => 'documents/prototype_transport_app.pdf'
                ]),
            ],
            [
                'name' => 'Aminata KONE',
                'email' => 'aminata.kone@inphb.edu.ci',
                'phone' => '+2250703345678',
                'profile_picture' => 'https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?q=80&w=300&auto=format&fit=crop',
                'email_verified_at' => now(),
                'is_active' => true,
                'is_verified' => true,
                'is_request' => false,
                'category' => 'fintech',
                'needs' => 'Solution de micro-crédit via mobile money',
                'documents' => json_encode([
                    'cv' => 'documents/cv_aminata_kone.pdf',
                    'business_model' => 'documents/fintech_microcredit.pdf'
                ]),
            ],
            [
                'name' => 'Mohamed BAMBA',
                'email' => 'mohamed.bamba@gmail.com',
                'phone' => '+2250704456789',
                'profile_picture' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?q=80&w=300&auto=format&fit=crop',
                'email_verified_at' => now(),
                'is_active' => true,
                'is_verified' => true,
                'is_request' => false,
                'category' => 'agritech',
                'needs' => 'Plateforme digitale pour connecter producteurs et acheteurs de cacao',
                'documents' => json_encode([
                    'cv' => 'documents/cv_mohamed_bamba.pdf',
                    'market_study' => 'documents/etude_marche_cacao.pdf'
                ]),
            ],
            [
                'name' => 'Fatoumata SANGARE',
                'email' => 'fatoumata.sangare@uvci.edu.ci',
                'phone' => '+2250705567890',
                'profile_picture' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=300&auto=format&fit=crop',
                'email_verified_at' => now(),
                'is_active' => true,
                'is_verified' => true,
                'is_request' => false,
                'category' => 'edtech',
                'needs' => 'Application d\'apprentissage des langues locales (Baoulé, Dioula)',
                'documents' => json_encode([
                    'cv' => 'documents/cv_fatoumata_sangare.pdf',
                    'app_prototype' => 'documents/prototype_langues_locales.pdf'
                ]),
            ],
            [
                'name' => 'Yves KOUAME',
                'email' => 'yves.kouame@orange.ci',
                'phone' => '+2250706678901',
                'profile_picture' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=300&auto=format&fit=crop',
                'email_verified_at' => now(),
                'is_active' => true,
                'is_verified' => true,
                'is_request' => false,
                'category' => 'developer',
                'needs' => 'Développement web et applications mobiles freelance',
                'documents' => json_encode([
                    'cv' => 'documents/cv_yves_kouame.pdf',
                    'portfolio' => 'documents/portfolio_dev.pdf'
                ]),
            ],
            [
                'name' => 'Mariam DIABATE',
                'email' => 'mariam.diabate@startup.ci',
                'phone' => '+2250707789012',
                'profile_picture' => 'https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?q=80&w=300&auto=format&fit=crop',
                'email_verified_at' => now(),
                'is_active' => true,
                'is_verified' => true,
                'is_request' => false,
                'category' => 'healthtech',
                'needs' => 'Télémédecine pour zones rurales de Côte d\'Ivoire',
                'documents' => json_encode([
                    'cv' => 'documents/cv_mariam_diabate.pdf',
                    'medical_solution' => 'documents/telemedecine_rurale.pdf'
                ]),
            ],
            [
                'name' => 'Ibrahim TOURE',
                'email' => 'ibrahim.toure@ensea.edu.ci',
                'phone' => '+2250708890123',
                'profile_picture' => 'https://images.unsplash.com/photo-1633332755192-727a05c4013d?q=80&w=300&auto=format&fit=crop',
                'email_verified_at' => now(),
                'is_active' => true,
                'is_verified' => true,
                'is_request' => false,
                'category' => 'iot',
                'needs' => 'Solutions IoT pour agriculture intelligente',
                'documents' => json_encode([
                    'cv' => 'documents/cv_ibrahim_toure.pdf',
                    'iot_project' => 'documents/iot_agriculture.pdf'
                ]),
            ],
            [
                'name' => 'Adjoa ASSI',
                'email' => 'adjoa.assi@gmail.com',
                'phone' => '+2250709901234',
                'profile_picture' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?q=80&w=300&auto=format&fit=crop',
                'email_verified_at' => now(),
                'is_active' => true,
                'is_verified' => true,
                'is_request' => false,
                'category' => 'designer',
                'needs' => 'Design UX/UI pour applications africaines',
                'documents' => json_encode([
                    'cv' => 'documents/cv_adjoa_assi.pdf',
                    'design_portfolio' => 'documents/portfolio_design.pdf'
                ]),
            ],
            [
                'name' => 'Bakary FOFANA',
                'email' => 'bakary.fofana@mtn.ci',
                'phone' => '+2250700012345',
                'profile_picture' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=300&auto=format&fit=crop',
                'email_verified_at' => now(),
                'is_active' => true,
                'is_verified' => true,
                'is_request' => false,
                'category' => 'blockchain',
                'needs' => 'Solutions blockchain pour traçabilité produits agricoles',
                'documents' => json_encode([
                    'cv' => 'documents/cv_bakary_fofana.pdf',
                    'blockchain_solution' => 'documents/blockchain_agriculture.pdf'
                ]),
            ],
        ];

        foreach ($residents as $residentData) {
            if (!User::where('email', $residentData['email'])->exists()) {
                User::create($residentData);
            }
        }
    }
} 