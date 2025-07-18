<?php

namespace Database\Seeders;

use App\Enums\Currency;
use App\Enums\EventStatus;
use App\Enums\EventType;
use App\Models\Event;
use App\Models\EventTranslation;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $createdBy = 1;

        $events = [
            [
                'title' => 'Conférence AgriTech Côte d\'Ivoire 2025',
                'type' => EventType::CONFERENCE->value,
                'description' => 'La première conférence dédiée aux technologies agricoles en Côte d\'Ivoire. Découvrez comment la tech révolutionne l\'agriculture ivoirienne : drones, IoT, blockchain pour la traçabilité du cacao, solutions fintech pour les producteurs.',
                'start_date' => Carbon::now()->addDays(35),
                'end_date' => Carbon::now()->addDays(36),
                'location' => 'Sofitel Abidjan Hôtel Ivoire',
                'is_remote' => false,
                'max_participants' => 300,
                'registration_end_date' => Carbon::now()->addDays(30),
                'is_paid' => true,
                'price' => 75000,
                'currency' => Currency::XOF->value,
                'early_bird_price' => 50000,
                'early_bird_end_date' => Carbon::now()->addDays(20),
                'illustration' => 'https://images.unsplash.com/photo-1544197150-b99a580bb7a8?q=80&w=1000&auto=format&fit=crop',
                'status' => EventStatus::PUBLISHED->value,
            ],
            [
                'title' => 'Atelier Développement d\'Applications Mobiles avec Flutter',
                'type' => EventType::WORKSHOP->value,
                'description' => 'Atelier pratique de 2 jours pour apprendre Flutter et développer des applications mobiles cross-platform. Créez votre première app mobile avec un projet concret adapté au marché ivoirien.',
                'start_date' => Carbon::now()->addDays(20),
                'end_date' => Carbon::now()->addDays(21),
                'location' => 'Hub Ivoire Tech - Plateau',
                'is_remote' => false,
                'max_participants' => 25,
                'registration_end_date' => Carbon::now()->addDays(15),
                'is_paid' => true,
                'price' => 30000,
                'currency' => Currency::XOF->value,
                'early_bird_price' => 25000,
                'early_bird_end_date' => Carbon::now()->addDays(10),
                'illustration' => 'https://images.unsplash.com/photo-1551650975-87deedd944c3?q=80&w=1000&auto=format&fit=crop',
                'status' => EventStatus::PUBLISHED->value,
            ],
            [
                'title' => 'Webinaire : Réussir sa Levée de Fonds en Afrique de l\'Ouest',
                'type' => EventType::WEBINAR->value,
                'description' => 'Session en ligne avec des investisseurs et entrepreneurs qui ont réussi leur levée de fonds. Découvrez les stratégies, erreurs à éviter, et opportunités de financement disponibles pour les startups ivoiriennes et ouest-africaines.',
                'start_date' => Carbon::now()->addDays(14),
                'end_date' => Carbon::now()->addDays(14),
                'location' => 'En ligne - Zoom',
                'is_remote' => true,
                'max_participants' => 200,
                'registration_end_date' => Carbon::now()->addDays(13),
                'is_paid' => false,
                'illustration' => 'https://images.unsplash.com/photo-1559136555-9303baea8ebd?q=80&w=1000&auto=format&fit=crop',
                'status' => EventStatus::PUBLISHED->value,
            ],
            [
                'title' => 'Meetup Femmes Tech Abidjan - Leadership & Innovation',
                'type' => EventType::MEETUP->value,
                'description' => 'Rencontre mensuelle des femmes professionnelles et entrepreneures tech d\'Abidjan. Au programme : témoignages inspirants, networking, partage d\'opportunités et construction d\'une communauté solidaire.',
                'start_date' => Carbon::now()->addDays(12),
                'end_date' => Carbon::now()->addDays(12),
                'location' => 'Radisson Blu Hotel Abidjan Airport',
                'is_remote' => false,
                'max_participants' => 80,
                'registration_end_date' => Carbon::now()->addDays(10),
                'is_paid' => false,
                'illustration' => 'https://images.unsplash.com/photo-1573164574572-cb89e39749b4?q=80&w=1000&auto=format&fit=crop',
                'status' => EventStatus::PUBLISHED->value,
            ],
            [
                'title' => 'Formation Intensive : Data Science pour l\'Afrique',
                'type' => EventType::TRAINING->value,
                'description' => 'Formation certifiante de 5 jours en Data Science avec focus sur les données africaines. Apprenez Python, Machine Learning, et travaillez sur des cas d\'usage réels : santé publique, agriculture, finances en Côte d\'Ivoire.',
                'start_date' => Carbon::now()->addDays(42),
                'end_date' => Carbon::now()->addDays(47),
                'location' => 'ENSEA Yamoussoukro',
                'is_remote' => false,
                'max_participants' => 30,
                'registration_end_date' => Carbon::now()->addDays(35),
                'is_paid' => true,
                'price' => 150000,
                'currency' => Currency::XOF->value,
                'early_bird_price' => 120000,
                'early_bird_end_date' => Carbon::now()->addDays(25),
                'illustration' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=1000&auto=format&fit=crop',
                'status' => EventStatus::PUBLISHED->value,
            ],
            [
                'title' => 'Hackathon FinTech UEMOA 2025',
                'type' => EventType::HACKATHON->value,
                'description' => 'Hackathon de 72h pour développer des solutions FinTech innovantes pour les pays de l\'UEMOA. 1er prix : 10M FCFA + incubation. Défis : inclusion financière, mobile money cross-border, micro-assurance.',
                'start_date' => Carbon::now()->addDays(55),
                'end_date' => Carbon::now()->addDays(58),
                'location' => 'Université Félix Houphouët-Boigny - Cocody',
                'is_remote' => false,
                'max_participants' => 120,
                'registration_end_date' => Carbon::now()->addDays(50),
                'is_paid' => true,
                'price' => 10000,
                'currency' => Currency::XOF->value,
                'illustration' => 'https://images.unsplash.com/photo-1531482615713-2afd69097998?q=80&w=1000&auto=format&fit=crop',
                'status' => EventStatus::DRAFT->value,
            ],
        ];

        foreach ($events as $eventData) {
            $translatableData = [
                'title' => $eventData['title'],
                'description' => $eventData['description'],
                'location' => $eventData['location'],
            ];
            unset($eventData['title'], $eventData['description'], $eventData['location']);

            $eventModelData = array_merge($eventData, ['created_by' => $createdBy, 'default_locale' => config('app.locale')]);
            
            $slug = Str::slug($translatableData['title']);
            if (EventTranslation::query()->whereSlug($slug)->exists()) {
                continue;
            }

            $eventModel = Event::create($eventModelData);

            $eventModel->translations()->create([
                'locale' => config('app.locale'),
                'title' => $translatableData['title'],
                'slug' => $slug,
                'description' => $translatableData['description'],
                'location' => $translatableData['location'],
            ]);
        }
    }
} 