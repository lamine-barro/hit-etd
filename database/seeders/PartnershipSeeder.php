<?php

namespace Database\Seeders;

use App\Enums\PartnershipStatus;
use App\Enums\PartnershipType;
use App\Models\Partnership;
use Illuminate\Database\Seeder;

class PartnershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $partnerships = [
            [
                'type' => PartnershipType::FINANCIAL_PARTNER->value,
                'organization_name' => 'Banque Atlantique Côte d\'Ivoire',
                'contact_name' => 'Directeur Innovations - M. Koné SEYDOU',
                'email' => 'seydou.kone@banqueatlantique.ci',
                'phone' => '+2250203456789',
                'message' => 'La Banque Atlantique souhaite s\'associer au Hub Ivoire Tech pour développer des solutions fintech innovantes. Nous proposons un partenariat financier incluant un fonds d\'investissement de 500M FCFA dédié aux startups fintech incubées au Hub.',
                'amount' => 500000000.00,
                'status' => PartnershipStatus::TREATED->value,
                'internal_notes' => 'Partenariat très intéressant. Contrat signé. Fonds disponibles dès janvier 2025.',
                'processed_at' => now()->subDays(15),
            ],
            [
                'type' => PartnershipType::TECHNICAL_PARTNER->value,
                'organization_name' => 'Microsoft Afrique de l\'Ouest',
                'contact_name' => 'Responsable Partenariats - Mme Fatima BARRY',
                'email' => 'fatima.barry@microsoft.com',
                'phone' => '+2213012345678',
                'message' => 'Microsoft souhaite proposer un partenariat technique avec le Hub incluant : accès gratuit à Azure pour les startups, formations certifiantes, support technique dédié, et programme Microsoft for Startups. Valeur estimée : $100,000/an.',
                'amount' => 65000000.00, // ~$100k en FCFA
                'status' => PartnershipStatus::TREATED->value,
                'internal_notes' => 'Excellent partenariat technique. Accord signé. Programme démarré.',
                'processed_at' => now()->subDays(30),
            ],
            [
                'type' => PartnershipType::STRATEGIC_PARTNER->value,
                'organization_name' => 'Orange Digital Center',
                'contact_name' => 'Directeur - M. Amadou DIALLO',
                'email' => 'amadou.diallo@orange.ci',
                'phone' => '+2250708123456',
                'message' => 'Orange Digital Center propose un partenariat stratégique avec le Hub Ivoire Tech pour créer un écosystème tech unifié en Côte d\'Ivoire. Collaboration sur les programmes d\'incubation, partage d\'espaces, co-organisation d\'événements.',
                'amount' => null,
                'status' => PartnershipStatus::TREATED->value,
                'internal_notes' => 'Partenariat stratégique majeur. Convention signée pour 3 ans.',
                'processed_at' => now()->subDays(45),
            ],
            [
                'type' => PartnershipType::DONOR->value,
                'organization_name' => 'Fondation Tony Elumelu',
                'contact_name' => 'Program Manager - Mrs. Grace OKELLO',
                'email' => 'grace.okello@tonyelumelufoundation.org',
                'phone' => '+2348123456789',
                'message' => 'La Fondation Tony Elumelu souhaite soutenir le Hub Ivoire Tech dans sa mission de développement de l\'entrepreneuriat tech en Afrique de l\'Ouest. Nous proposons une dotation de $50,000 pour le programme de mentorat.',
                'amount' => 32500000.00, // ~$50k en FCFA
                'status' => PartnershipStatus::UNTREATED->value,
                'internal_notes' => null,
                'processed_at' => null,
            ],
            [
                'type' => PartnershipType::TECHNICAL_PARTNER->value,
                'organization_name' => 'Google for Startups Africa',
                'contact_name' => 'Partnership Lead - Mr. Kwame ASANTE',
                'email' => 'kwame.asante@google.com',
                'phone' => '+233201234567',
                'message' => 'Google for Startups souhaite intégrer le Hub Ivoire Tech dans son réseau africain. Nous offrons : Google Cloud credits ($20k/startup), formations Google AI, accès au Google for Startups Accelerator, et support marketing.',
                'amount' => 130000000.00, // ~$200k value
                'status' => PartnershipStatus::UNTREATED->value,
                'internal_notes' => null,
                'processed_at' => null,
            ],
            [
                'type' => PartnershipType::FINANCIAL_PARTNER->value,
                'organization_name' => 'Société Générale Côte d\'Ivoire',
                'contact_name' => 'Directrice Innovation - Mme Mariam COULIBALY',
                'email' => 'mariam.coulibaly@socgen.ci',
                'phone' => '+2250201234567',
                'message' => 'SGCI propose un partenariat financier pour créer un fonds d\'amorçage de 300M FCFA dédié aux fintech. Nous offrons aussi des services bancaires privilégiés aux startups du Hub et un programme de mentorat.',
                'amount' => 300000000.00,
                'status' => PartnershipStatus::UNTREATED->value,
                'internal_notes' => null,
                'processed_at' => null,
            ],
            [
                'type' => PartnershipType::STRATEGIC_PARTNER->value,
                'organization_name' => 'Université Félix Houphouët-Boigny',
                'contact_name' => 'Vice-Recteur Recherche - Prof. Yao KOUASSI',
                'email' => 'yao.kouassi@univ-fhb.edu.ci',
                'phone' => '+2250201987654',
                'message' => 'L\'Université FHB propose un partenariat académique stratégique : stages étudiants au Hub, projets de recherche collaborative, accès aux laboratoires, formations continues pour les entrepreneurs.',
                'amount' => null,
                'status' => PartnershipStatus::TREATED->value,
                'internal_notes' => 'Partenariat académique excellent. Convention en cours de finalisation.',
                'processed_at' => now()->subDays(10),
            ],
            [
                'type' => PartnershipType::DONOR->value,
                'organization_name' => 'Agence Française de Développement (AFD)',
                'contact_name' => 'Chargée de Mission - Mme Sophie MARTIN',
                'email' => 'sophie.martin@afd.fr',
                'phone' => '+2250204567890',
                'message' => 'L\'AFD souhaite soutenir le Hub Ivoire Tech dans le cadre de son programme Digital Africa. Subvention proposée : 200,000€ pour le développement de programmes d\'incubation focalisés sur l\'impact social.',
                'amount' => 131000000.00, // ~€200k en FCFA
                'status' => PartnershipStatus::UNTREATED->value,
                'internal_notes' => null,
                'processed_at' => null,
            ],
            [
                'type' => PartnershipType::TECHNICAL_PARTNER->value,
                'organization_name' => 'Amazon Web Services (AWS)',
                'contact_name' => 'Partner Manager Africa - Mr. David OKOYE',
                'email' => 'david.okoye@amazon.com',
                'phone' => '+2348098765432',
                'message' => 'AWS propose de devenir partenaire technique du Hub avec le programme AWS Activate : $25,000 de crédits cloud par startup, formations techniques, support architectural, et accès aux programmes d\'accélération AWS.',
                'amount' => 97500000.00, // ~$150k value
                'status' => PartnershipStatus::UNTREATED->value,
                'internal_notes' => null,
                'processed_at' => null,
            ],
            [
                'type' => PartnershipType::FINANCIAL_PARTNER->value,
                'organization_name' => 'Ecobank Group',
                'contact_name' => 'Head of Innovation - M. Ibrahim SESSAY',
                'email' => 'ibrahim.sessay@ecobank.com',
                'phone' => '+2250207654321',
                'message' => 'Ecobank propose un partenariat financier multi-pays pour le Hub Ivoire Tech. Fonds d\'investissement de $1M pour les fintech, services bancaires préférentiels, et expansion du modèle Hub dans 5 pays d\'Afrique de l\'Ouest.',
                'amount' => 650000000.00, // ~$1M
                'status' => PartnershipStatus::UNTREATED->value,
                'internal_notes' => null,
                'processed_at' => null,
            ],
        ];

        foreach ($partnerships as $partnershipData) {
            if (!Partnership::where('email', $partnershipData['email'])->exists()) {
                Partnership::create($partnershipData);
            }
        }
    }
} 