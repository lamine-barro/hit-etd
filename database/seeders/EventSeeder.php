<?php

namespace Database\Seeders;

use App\Enums\Currency;
use App\Enums\EventStatus;
use App\Enums\EventType;
use App\Models\Administrator;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer un administrateur pour le champ created_by
        $admin = Administrator::first();
        
        if (!$admin) {
            $this->command->error('Aucun administrateur trouvé. Veuillez d\'abord créer un administrateur.');
            return;
        }
        
        $events = [
            [
                'title' => 'Conférence sur l\'Intelligence Artificielle',
                'type' => EventType::CONFERENCE->value,
                'description' => 'Une conférence passionnante sur les dernières avancées en matière d\'intelligence artificielle et d\'apprentissage automatique.',
                'start_date' => Carbon::now()->addDays(30),
                'end_date' => Carbon::now()->addDays(32),
                'location' => 'Hôtel Azalaï, Abidjan',
                'is_remote' => false,
                'max_participants' => 200,
                'registration_end_date' => Carbon::now()->addDays(25),
                'is_paid' => true,
                'price' => 50000,
                'currency' => Currency::XOF->value,
                'early_bird_price' => 35000,
                'early_bird_end_date' => Carbon::now()->addDays(15),
                'illustration' => 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?q=80&w=1000&auto=format&fit=crop',
                'status' => EventStatus::PUBLISHED->value,
                'created_by' => $admin->id
            ],
            [
                'title' => 'Atelier de Programmation Python',
                'type' => EventType::WORKSHOP->value,
                'description' => 'Apprenez les bases de la programmation Python dans cet atelier pratique destiné aux débutants.',
                'start_date' => Carbon::now()->addDays(15),
                'end_date' => Carbon::now()->addDays(15),
                'location' => 'Campus Universitaire de Cocody',
                'is_remote' => false,
                'max_participants' => 50,
                'registration_end_date' => Carbon::now()->addDays(10),
                'is_paid' => true,
                'price' => 15000,
                'currency' => Currency::XOF->value,
                'early_bird_price' => 10000,
                'early_bird_end_date' => Carbon::now()->addDays(5),
                'illustration' => 'https://images.unsplash.com/photo-1587620962725-abab7fe55159?q=80&w=1000&auto=format&fit=crop',
                'status' => EventStatus::PUBLISHED->value,
                'created_by' => $admin->id
            ],
            [
                'title' => 'Webinaire sur le Marketing Digital',
                'type' => EventType::WEBINAR->value,
                'description' => 'Découvrez les stratégies de marketing digital les plus efficaces pour développer votre entreprise en ligne.',
                'start_date' => Carbon::now()->addDays(7),
                'end_date' => Carbon::now()->addDays(7),
                'location' => 'En ligne',
                'is_remote' => true,
                'max_participants' => 500,
                'registration_end_date' => Carbon::now()->addDays(6),
                'is_paid' => false,
                'illustration' => 'https://images.unsplash.com/photo-1557838923-2985c318be48?q=80&w=1000&auto=format&fit=crop',
                'status' => EventStatus::PUBLISHED->value,
                'created_by' => $admin->id
            ],
            [
                'title' => 'Hackathon Innovation Tech',
                'type' => EventType::HACKATHON->value,
                'description' => 'Participez à notre hackathon de 48 heures et développez des solutions innovantes pour résoudre des problèmes locaux.',
                'start_date' => Carbon::now()->addDays(45),
                'end_date' => Carbon::now()->addDays(47),
                'location' => 'Orange Digital Center, Abidjan',
                'is_remote' => false,
                'max_participants' => 100,
                'registration_end_date' => Carbon::now()->addDays(40),
                'is_paid' => true,
                'price' => 5000,
                'currency' => Currency::XOF->value,
                'illustration' => 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?q=80&w=1000&auto=format&fit=crop',
                'status' => EventStatus::DRAFT->value,
                'created_by' => $admin->id
            ],
            [
                'title' => 'Formation en Développement Web',
                'type' => EventType::TRAINING->value,
                'description' => 'Formation intensive de 5 jours sur le développement web moderne avec HTML, CSS, JavaScript et PHP.',
                'start_date' => Carbon::now()->addDays(60),
                'end_date' => Carbon::now()->addDays(65),
                'location' => 'Centre de formation CERCO, Abidjan',
                'is_remote' => false,
                'max_participants' => 30,
                'registration_end_date' => Carbon::now()->addDays(55),
                'is_paid' => true,
                'price' => 100000,
                'currency' => Currency::XOF->value,
                'early_bird_price' => 80000,
                'early_bird_end_date' => Carbon::now()->addDays(40),
                'illustration' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?q=80&w=1000&auto=format&fit=crop',
                'status' => EventStatus::PUBLISHED->value,
                'created_by' => $admin->id
            ],
            [
                'title' => 'Meetup Entrepreneurs Tech',
                'type' => EventType::MEETUP->value,
                'description' => 'Rejoignez notre communauté d\'entrepreneurs tech pour un échange d\'expériences et de conseils dans une ambiance conviviale.',
                'start_date' => Carbon::now()->addDays(10),
                'end_date' => Carbon::now()->addDays(10),
                'location' => 'Coworking Space Cocody, Abidjan',
                'is_remote' => false,
                'max_participants' => 40,
                'registration_end_date' => Carbon::now()->addDays(9),
                'is_paid' => false,
                'illustration' => 'https://images.unsplash.com/photo-1528605248644-14dd04022da1?q=80&w=1000&auto=format&fit=crop',
                'status' => EventStatus::PUBLISHED->value,
                'created_by' => $admin->id
            ],
            [
                'title' => 'Conférence sur la Cybersecurité',
                'type' => EventType::CONFERENCE->value,
                'description' => 'Découvrez les dernières tendances et menaces en matière de cybersecurité et comment protéger votre entreprise.',
                'start_date' => Carbon::now()->addDays(25),
                'end_date' => Carbon::now()->addDays(25),
                'location' => 'Hôtel Pullman, Abidjan',
                'is_remote' => false,
                'max_participants' => 150,
                'registration_end_date' => Carbon::now()->addDays(20),
                'is_paid' => true,
                'price' => 25000,
                'currency' => Currency::XOF->value,
                'early_bird_price' => 20000,
                'early_bird_end_date' => Carbon::now()->addDays(10),
                'illustration' => 'https://images.unsplash.com/photo-1563013544-824ae1b704d3?q=80&w=1000&auto=format&fit=crop',
                'status' => EventStatus::PUBLISHED->value,
                'created_by' => $admin->id
            ],
            [
                'title' => 'Atelier Design Thinking',
                'type' => EventType::WORKSHOP->value,
                'description' => 'Apprenez à résoudre des problèmes complexes avec la méthodologie du Design Thinking dans cet atelier pratique.',
                'start_date' => Carbon::now()->addDays(18),
                'end_date' => Carbon::now()->addDays(18),
                'location' => 'Impact Hub Abidjan',
                'is_remote' => false,
                'max_participants' => 25,
                'registration_end_date' => Carbon::now()->addDays(15),
                'is_paid' => true,
                'price' => 15000,
                'currency' => Currency::XOF->value,
                'illustration' => 'https://images.unsplash.com/photo-1531403009284-440f080d1e12?q=80&w=1000&auto=format&fit=crop',
                'status' => EventStatus::PUBLISHED->value,
                'created_by' => $admin->id
            ],
            [
                'title' => 'Webinaire sur l\'E-commerce',
                'type' => EventType::WEBINAR->value,
                'description' => 'Comment lancer et développer votre boutique en ligne en Afrique de l\'Ouest : stratégies, outils et bonnes pratiques.',
                'start_date' => Carbon::now()->addDays(5),
                'end_date' => Carbon::now()->addDays(5),
                'location' => 'En ligne',
                'is_remote' => true,
                'max_participants' => 300,
                'registration_end_date' => Carbon::now()->addDays(4),
                'is_paid' => false,
                'illustration' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?q=80&w=1000&auto=format&fit=crop',
                'status' => EventStatus::PUBLISHED->value,
                'created_by' => $admin->id
            ],
            [
                'title' => 'Formation en Marketing Digital',
                'type' => EventType::TRAINING->value,
                'description' => 'Maîtrisez les stratégies de marketing digital essentielles pour votre entreprise : SEO, réseaux sociaux, email marketing et plus encore.',
                'start_date' => Carbon::now()->addDays(40),
                'end_date' => Carbon::now()->addDays(42),
                'location' => 'Centre de formation ISTC, Abidjan',
                'is_remote' => false,
                'max_participants' => 35,
                'registration_end_date' => Carbon::now()->addDays(35),
                'is_paid' => true,
                'price' => 75000,
                'currency' => Currency::XOF->value,
                'early_bird_price' => 60000,
                'early_bird_end_date' => Carbon::now()->addDays(25),
                'illustration' => 'https://images.unsplash.com/photo-1432888622747-4eb9a8f5f01a?q=80&w=1000&auto=format&fit=crop',
                'status' => EventStatus::PUBLISHED->value,
                'created_by' => $admin->id
            ],
            [
                'title' => 'Hackathon FinTech',
                'type' => EventType::HACKATHON->value,
                'description' => 'Participez à notre hackathon spécial FinTech et développez des solutions innovantes pour révolutionner les services financiers en Afrique.',
                'start_date' => Carbon::now()->addDays(50),
                'end_date' => Carbon::now()->addDays(52),
                'location' => 'Université Félix Houphouët-Boigny, Abidjan',
                'is_remote' => false,
                'max_participants' => 80,
                'registration_end_date' => Carbon::now()->addDays(45),
                'is_paid' => true,
                'price' => 2000,
                'currency' => Currency::XOF->value,
                'illustration' => 'https://images.unsplash.com/photo-1531482615713-2afd69097998?q=80&w=1000&auto=format&fit=crop',
                'status' => EventStatus::DRAFT->value,
                'created_by' => $admin->id
            ],
            [
                'title' => 'Conférence sur l\'IA et l\'Afrique',
                'type' => EventType::CONFERENCE->value,
                'description' => 'Comment l\'intelligence artificielle peut-elle résoudre les défis spécifiques de l\'Afrique ? Venez écouter des experts du continent et d\'ailleurs.',
                'start_date' => Carbon::now()->addDays(70),
                'end_date' => Carbon::now()->addDays(71),
                'location' => 'Sofitel Hôtel Ivoire, Abidjan',
                'is_remote' => false,
                'max_participants' => 300,
                'registration_end_date' => Carbon::now()->addDays(65),
                'is_paid' => true,
                'price' => 60000,
                'currency' => Currency::XOF->value,
                'early_bird_price' => 45000,
                'early_bird_end_date' => Carbon::now()->addDays(50),
                'illustration' => 'https://images.unsplash.com/photo-1558021212-51b6ecfa0db9?q=80&w=1000&auto=format&fit=crop',
                'status' => EventStatus::PUBLISHED->value,
                'created_by' => $admin->id
            ],
            [
                'title' => 'Meetup Développeurs Mobile',
                'type' => EventType::MEETUP->value,
                'description' => 'Rencontrez d\'autres développeurs mobile, partagez vos expériences et découvrez les dernières tendances en développement d\'applications.',
                'start_date' => Carbon::now()->addDays(12),
                'end_date' => Carbon::now()->addDays(12),
                'location' => 'Coworking Space La Factory, Abidjan',
                'is_remote' => false,
                'max_participants' => 50,
                'registration_end_date' => Carbon::now()->addDays(11),
                'is_paid' => false,
                'illustration' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=1000&auto=format&fit=crop',
                'status' => EventStatus::PUBLISHED->value,
                'created_by' => $admin->id
            ],
            [
                'title' => 'Formation Data Science',
                'type' => EventType::TRAINING->value,
                'description' => 'Initiez-vous à la data science et à l\'analyse de données avec Python et les bibliothèques essentielles comme Pandas, NumPy et Matplotlib.',
                'start_date' => Carbon::now()->addDays(35),
                'end_date' => Carbon::now()->addDays(39),
                'location' => 'Centre de formation ESATIC, Abidjan',
                'is_remote' => false,
                'max_participants' => 25,
                'registration_end_date' => Carbon::now()->addDays(30),
                'is_paid' => true,
                'price' => 120000,
                'currency' => Currency::XOF->value,
                'early_bird_price' => 90000,
                'early_bird_end_date' => Carbon::now()->addDays(20),
                'illustration' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=1000&auto=format&fit=crop',
                'status' => EventStatus::PUBLISHED->value,
                'created_by' => $admin->id
            ],
            [
                'title' => 'Webinaire sur la Blockchain',
                'type' => EventType::WEBINAR->value,
                'description' => 'Comprendre la blockchain et ses applications au-delà des cryptomonnaies : cas d\'usage pour les entreprises africaines.',
                'start_date' => Carbon::now()->addDays(8),
                'end_date' => Carbon::now()->addDays(8),
                'location' => 'En ligne',
                'is_remote' => true,
                'max_participants' => 400,
                'registration_end_date' => Carbon::now()->addDays(7),
                'is_paid' => false,
                'illustration' => 'https://images.unsplash.com/photo-1639762681057-408e52192e55?q=80&w=1000&auto=format&fit=crop',
                'status' => EventStatus::PUBLISHED->value,
                'created_by' => $admin->id
            ],
            [
                'title' => 'Atelier UX/UI Design',
                'type' => EventType::WORKSHOP->value,
                'description' => 'Maîtrisez les principes fondamentaux du design d\'interface utilisateur et de l\'expérience utilisateur pour créer des applications plus attrayantes et fonctionnelles.',
                'start_date' => Carbon::now()->addDays(22),
                'end_date' => Carbon::now()->addDays(23),
                'location' => 'Radisson Blu Hotel, Abidjan',
                'is_remote' => false,
                'max_participants' => 30,
                'registration_end_date' => Carbon::now()->addDays(20),
                'is_paid' => true,
                'price' => 25000,
                'currency' => Currency::XOF->value,
                'illustration' => 'https://images.unsplash.com/photo-1586717791821-3f44a563fa4c?q=80&w=1000&auto=format&fit=crop',
                'status' => EventStatus::PUBLISHED->value,
                'created_by' => $admin->id
            ],
            [
                'title' => 'Conférence sur l\'Entrepreneuriat Social',
                'type' => EventType::CONFERENCE->value,
                'description' => 'Comment créer et développer des entreprises à impact social positif en Afrique de l\'Ouest ? Venez découvrir des modèles innovants et inspirants.',
                'start_date' => Carbon::now()->addDays(55),
                'end_date' => Carbon::now()->addDays(56),
                'location' => 'Fondation Konrad Adenauer, Abidjan',
                'is_remote' => false,
                'max_participants' => 120,
                'registration_end_date' => Carbon::now()->addDays(50),
                'is_paid' => true,
                'price' => 10000,
                'currency' => Currency::XOF->value,
                'early_bird_price' => 7500,
                'early_bird_end_date' => Carbon::now()->addDays(40),
                'illustration' => 'https://images.unsplash.com/photo-1591115765373-5207764f72e4?q=80&w=1000&auto=format&fit=crop',
                'status' => EventStatus::PUBLISHED->value,
                'created_by' => $admin->id
            ],
            [
                'title' => 'Webinaire sur l\'Intelligence Artificielle Générative',
                'type' => EventType::WEBINAR->value,
                'description' => 'Découvrez comment utiliser ChatGPT, DALL-E et d\'autres outils d\'IA générative pour améliorer votre productivité et votre créativité.',
                'start_date' => Carbon::now()->addDays(3),
                'end_date' => Carbon::now()->addDays(3),
                'location' => 'En ligne',
                'is_remote' => true,
                'max_participants' => 500,
                'registration_end_date' => Carbon::now()->addDays(2),
                'is_paid' => false,
                'illustration' => 'https://images.unsplash.com/photo-1677442135968-6db3b0025e95?q=80&w=1000&auto=format&fit=crop',
                'status' => EventStatus::PUBLISHED->value,
                'created_by' => $admin->id
            ],
            [
                'title' => 'Meetup Femmes Tech Leaders',
                'type' => EventType::MEETUP->value,
                'description' => 'Un espace d\'échange et de networking dédié aux femmes leaders dans le secteur technologique en Côte d\'Ivoire et en Afrique de l\'Ouest.',
                'start_date' => Carbon::now()->addDays(14),
                'end_date' => Carbon::now()->addDays(14),
                'location' => 'Noom Hotel, Abidjan',
                'is_remote' => false,
                'max_participants' => 60,
                'registration_end_date' => Carbon::now()->addDays(12),
                'is_paid' => false,
                'illustration' => 'https://images.unsplash.com/photo-1573164574572-cb89e39749b4?q=80&w=1000&auto=format&fit=crop',
                'status' => EventStatus::PUBLISHED->value,
                'created_by' => $admin->id
            ],
            [
                'title' => 'Formation Gestion de Projet Agile',
                'type' => EventType::TRAINING->value,
                'description' => 'Apprenez à gérer efficacement vos projets tech avec les méthodologies agiles : Scrum, Kanban et Lean. Formation certifiante.',
                'start_date' => Carbon::now()->addDays(28),
                'end_date' => Carbon::now()->addDays(30),
                'location' => 'Centre de formation IPAG, Abidjan',
                'is_remote' => false,
                'max_participants' => 20,
                'registration_end_date' => Carbon::now()->addDays(25),
                'is_paid' => true,
                'price' => 150000,
                'currency' => Currency::XOF->value,
                'early_bird_price' => 120000,
                'early_bird_end_date' => Carbon::now()->addDays(15),
                'illustration' => 'https://images.unsplash.com/photo-1572177812156-58036aae439c?q=80&w=1000&auto=format&fit=crop',
                'status' => EventStatus::PUBLISHED->value,
                'created_by' => $admin->id
            ],
        ];
        
        // Créer le dossier pour les illustrations si nécessaire
        if (!Storage::exists('public/events/illustrations')) {
            Storage::makeDirectory('public/events/illustrations');
        }
        
        foreach ($events as $eventData) {
            $eventData['illustration'] = null;
            Event::create($eventData);
        }
    }
}
