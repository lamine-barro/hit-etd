<?php

namespace Database\Seeders;

use App\Models\Expert;
use Illuminate\Database\Seeder;

class ExpertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $experts = [
            [
                'full_name' => 'Dr. Sylvain KOUAKOU',
                'email' => 'sylvain.kouakou@inphb.edu.ci',
                'profile_picture' => 'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?q=80&w=300&auto=format&fit=crop',
                'phone' => '+2250707234567',
                'organization' => 'Institut National Polytechnique Houphouët-Boigny',
                'position' => 'Professeur en Intelligence Artificielle',
                'linkedin' => 'https://linkedin.com/in/sylvain-kouakou-ai',
                'specialties' => json_encode([
                    'Intelligence Artificielle',
                    'Machine Learning',
                    'Data Science',
                    'Vision par ordinateur'
                ]),
                'specialty_other' => null,
                'training_types' => json_encode([
                    'Formation technique',
                    'Conférence',
                    'Atelier pratique',
                    'Mentorat'
                ]),
                'pedagogical_methods' => json_encode([
                    'Apprentissage par projet',
                    'Cas d\'étude pratiques',
                    'Démonstrations techniques',
                    'Accompagnement personnalisé'
                ]),
                'target_audiences' => json_encode([
                    'Étudiants en informatique',
                    'Développeurs',
                    'Entrepreneurs tech',
                    'Chercheurs'
                ]),
                'intervention_frequencies' => json_encode(['Mensuelle', 'Trimestrielle']),
                'preferred_days_detailed' => json_encode([
                    'Mardi' => ['14:00-17:00'],
                    'Jeudi' => ['09:00-12:00', '14:00-17:00'],
                    'Samedi' => ['09:00-16:00']
                ]),
                'time_slots' => json_encode(['Matinée', 'Après-midi']),
                'cv_path' => 'experts/cv_sylvain_kouakou.pdf',
                'status' => 'approved',
                'admin_notes' => 'Excellent expert en IA, très pédagogue. Recommandé pour formations avancées.',
                'processed_at' => now()->subDays(30),
            ],
            [
                'full_name' => 'Rebecca ADJOUA',
                'email' => 'rebecca.adjoua@startup.ci',
                'profile_picture' => 'https://images.unsplash.com/photo-1494790108755-2616b612b647?q=80&w=300&auto=format&fit=crop',
                'phone' => '+2250708345678',
                'organization' => 'Tech Women Africa',
                'position' => 'CEO & Fondatrice',
                'linkedin' => 'https://linkedin.com/in/rebecca-adjoua',
                'specialties' => json_encode([
                    'Entrepreneuriat féminin',
                    'Leadership tech',
                    'Financement startup',
                    'Développement produit'
                ]),
                'specialty_other' => null,
                'training_types' => json_encode([
                    'Workshop entrepreneuriat',
                    'Mentorat',
                    'Conférence inspirante',
                    'Bootcamp'
                ]),
                'pedagogical_methods' => json_encode([
                    'Storytelling',
                    'Études de cas réels',
                    'Networking actif',
                    'Pitch training'
                ]),
                'target_audiences' => json_encode([
                    'Femmes entrepreneures',
                    'Startups early-stage',
                    'Étudiantes',
                    'Investisseurs'
                ]),
                'intervention_frequencies' => json_encode(['Hebdomadaire', 'Mensuelle']),
                'preferred_days_detailed' => json_encode([
                    'Mercredi' => ['18:00-20:00'],
                    'Vendredi' => ['14:00-17:00'],
                    'Samedi' => ['10:00-15:00']
                ]),
                'time_slots' => json_encode(['Après-midi', 'Soirée']),
                'cv_path' => 'experts/cv_rebecca_adjoua.pdf',
                'status' => 'approved',
                'admin_notes' => 'Excellente pour le mentorat des femmes entrepreneures. Grande expérience.',
                'processed_at' => now()->subDays(45),
            ],
            [
                'full_name' => 'Mamadou TRAORE',
                'email' => 'mamadou.traore@orange.ci',
                'profile_picture' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?q=80&w=300&auto=format&fit=crop',
                'phone' => '+2250709456789',
                'organization' => 'Orange Digital Center',
                'position' => 'Directeur Innovation',
                'linkedin' => 'https://linkedin.com/in/mamadou-traore-innovation',
                'specialties' => json_encode([
                    'Transformation digitale',
                    'Innovation management',
                    'Fintech',
                    'Mobile money'
                ]),
                'specialty_other' => null,
                'training_types' => json_encode([
                    'Formation executive',
                    'Conférence',
                    'Consulting',
                    'Design thinking workshop'
                ]),
                'pedagogical_methods' => json_encode([
                    'Design thinking',
                    'Lean startup',
                    'Innovation labs',
                    'Prototypage rapide'
                ]),
                'target_audiences' => json_encode([
                    'Dirigeants d\'entreprise',
                    'Équipes innovation',
                    'Startups fintech',
                    'Développeurs'
                ]),
                'intervention_frequencies' => json_encode(['Mensuelle', 'Trimestrielle']),
                'preferred_days_detailed' => json_encode([
                    'Lundi' => ['09:00-12:00'],
                    'Mardi' => ['14:00-18:00'],
                    'Vendredi' => ['09:00-17:00']
                ]),
                'time_slots' => json_encode(['Matinée', 'Après-midi']),
                'cv_path' => 'experts/cv_mamadou_traore.pdf',
                'status' => 'approved',
                'admin_notes' => 'Expert reconnu en transformation digitale. Très bon formateur.',
                'processed_at' => now()->subDays(60),
            ],
            [
                'full_name' => 'Aisha DEMBELE',
                'email' => 'aisha.dembele@cybersec.bf',
                'profile_picture' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=300&auto=format&fit=crop',
                'phone' => '+2267012345678', // Burkina Faso
                'organization' => 'CyberSec West Africa',
                'position' => 'Security Consultant',
                'linkedin' => 'https://linkedin.com/in/aisha-dembele-cybersec',
                'specialties' => json_encode([
                    'Cybersécurité',
                    'Ethical hacking',
                    'Sécurité mobile',
                    'Audit sécurité'
                ]),
                'specialty_other' => null,
                'training_types' => json_encode([
                    'Formation technique',
                    'Atelier sécurité',
                    'Audit formation',
                    'Certification'
                ]),
                'pedagogical_methods' => json_encode([
                    'Hands-on labs',
                    'Red team exercises',
                    'Analyse de vulnérabilités',
                    'Simulations d\'attaque'
                ]),
                'target_audiences' => json_encode([
                    'IT professionals',
                    'Développeurs',
                    'RSSI',
                    'Étudiants cybersécurité'
                ]),
                'intervention_frequencies' => json_encode(['Mensuelle', 'Ponctuelle']),
                'preferred_days_detailed' => json_encode([
                    'Mercredi' => ['09:00-17:00'],
                    'Jeudi' => ['09:00-17:00'],
                    'Samedi' => ['09:00-12:00']
                ]),
                'time_slots' => json_encode(['Journée complète', 'Matinée']),
                'cv_path' => 'experts/cv_aisha_dembele.pdf',
                'status' => 'approved',
                'admin_notes' => 'Experte cybersécurité de haut niveau. Formations très techniques.',
                'processed_at' => now()->subDays(20),
            ],
            [
                'full_name' => 'Jean-Baptiste KOFFI',
                'email' => 'jb.koffi@blockchain.africa',
                'profile_picture' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=300&auto=format&fit=crop',
                'phone' => '+2250700987654',
                'organization' => 'Blockchain Africa Institute',
                'position' => 'Lead Blockchain Developer',
                'linkedin' => 'https://linkedin.com/in/jb-koffi-blockchain',
                'specialties' => json_encode([
                    'Blockchain',
                    'Smart contracts',
                    'DeFi',
                    'Web3 development'
                ]),
                'specialty_other' => null,
                'training_types' => json_encode([
                    'Bootcamp blockchain',
                    'Workshop smart contracts',
                    'Formation DeFi',
                    'Mentorat technique'
                ]),
                'pedagogical_methods' => json_encode([
                    'Coding sessions',
                    'Live coding',
                    'Projets pratiques',
                    'Code review'
                ]),
                'target_audiences' => json_encode([
                    'Développeurs',
                    'Entrepreneurs crypto',
                    'Fintech teams',
                    'Étudiants informatique'
                ]),
                'intervention_frequencies' => json_encode(['Hebdomadaire', 'Mensuelle']),
                'preferred_days_detailed' => json_encode([
                    'Lundi' => ['18:00-21:00'],
                    'Mercredi' => ['18:00-21:00'],
                    'Samedi' => ['14:00-18:00']
                ]),
                'time_slots' => json_encode(['Soirée', 'Après-midi']),
                'cv_path' => 'experts/cv_jb_koffi.pdf',
                'status' => 'pending',
                'admin_notes' => null,
                'processed_at' => null,
            ],
        ];

        foreach ($experts as $expertData) {
            if (!Expert::where('email', $expertData['email'])->exists()) {
                Expert::create($expertData);
            }
        }
    }
} 