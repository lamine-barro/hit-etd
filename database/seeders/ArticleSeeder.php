<?php

namespace Database\Seeders;

use App\Enums\ArticleCategory;
use App\Enums\ArticleStatus;
use App\Enums\LanguageEnum;
use App\Models\Administrator;
use App\Models\Article;
use App\Models\ArticleTranslation;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Exécute les seeds de la base de données.
     */
    public function run(): void
    {
        // Récupérer un administrateur pour le champ author_id
        $admin = Administrator::first();

        if (! $admin) {
            $this->command->error('Aucun administrateur trouvé. Veuillez d\'abord créer un administrateur.');

            return;
        }

        $articles = [
            [
                'category' => ArticleCategory::TECH_ECOSYSTEM,
                'illustration' => 'https://images.unsplash.com/photo-1531482615713-2afd69097998?q=80&w=1000&auto=format&fit=crop',
                'tags' => ['Côte d\'Ivoire', 'Startups', 'Innovation', 'Développement'],
                'featured' => true,
                'status' => ArticleStatus::PUBLISHED,
                'published_at' => Carbon::now()->subDays(5),
                'author_id' => $admin->id,
                'translations' => [
                    'fr' => [
                        'title' => 'L\'écosystème tech ivoirien en pleine expansion',
                        'excerpt' => 'Découvrez comment la Côte d\'Ivoire est en train de devenir un hub technologique majeur en Afrique de l\'Ouest.',
                        'content' => "<p>L'écosystème technologique ivoirien connaît une croissance remarquable ces dernières années. Avec l'émergence de nombreuses startups innovantes, d'espaces de coworking dynamiques et le soutien croissant des investisseurs, Abidjan s'impose progressivement comme un hub tech incontournable en Afrique de l'Ouest.</p>\n\n<p>Plusieurs facteurs expliquent cette montée en puissance :</p>\n\n<ul>\n<li>Une population jeune et de plus en plus connectée</li>\n<li>Des infrastructures de télécommunication en amélioration constante</li>\n<li>L'implantation de grands groupes technologiques internationaux</li>\n<li>Le développement de formations spécialisées dans le numérique</li>\n<li>Un cadre réglementaire de plus en plus favorable à l'innovation</li>\n</ul>\n\n<p>Des initiatives comme le Village des Technologies de l'Information et de la Biotechnologie (VITIB) à Grand-Bassam ou encore Orange Digital Center à Abidjan témoignent de cette dynamique positive.</p>",
                    ],
                    'en' => [
                        'title' => 'The Ivorian Tech Ecosystem in Full Expansion',
                        'excerpt' => 'Discover how Ivory Coast is becoming a major technology hub in West Africa.',
                        'content' => "<p><em>This is an automatically translated version of the original French content.</em></p>\n<p>The Ivorian technological ecosystem has experienced remarkable growth in recent years. With the emergence of numerous innovative startups, dynamic coworking spaces, and increasing investor support, Abidjan is gradually establishing itself as an essential tech hub in West Africa.</p>\n\n<p>Several factors explain this rise in power:</p>\n\n<ul>\n<li>A young and increasingly connected population</li>\n<li>Telecommunication infrastructure in constant improvement</li>\n<li>The establishment of major international technology groups</li>\n<li>The development of specialized digital training</li>\n<li>A regulatory framework increasingly favorable to innovation</li>\n</ul>\n\n<p>Initiatives such as the Information Technology and Biotechnology Village (VITIB) in Grand-Bassam or Orange Digital Center in Abidjan demonstrate this positive dynamic.</p>",
                    ],
                ],
            ],
            [
                'category' => ArticleCategory::DIGITAL_TRANSFORMATION,
                'illustration' => 'https://images.unsplash.com/photo-1484807352052-23338990c6c6?q=80&w=1000&auto=format&fit=crop',
                'tags' => ['Afrique', 'Digital', 'Développement', 'Inclusion numérique'],
                'featured' => false,
                'status' => ArticleStatus::PUBLISHED,
                'published_at' => Carbon::now()->subDays(10),
                'author_id' => $admin->id,
                'translations' => [
                    'fr' => [
                        'title' => 'Les défis de la transformation numérique en Afrique',
                        'excerpt' => 'Analyse des obstacles et opportunités dans le processus de digitalisation des économies africaines.',
                        'content' => "<p>La transformation numérique représente une opportunité sans précédent pour le développement économique et social de l'Afrique. Cependant, plusieurs défis majeurs doivent être relevés pour que cette révolution numérique soit inclusive et durable.</p>\n\n<h3>Infrastructures et connectivité</h3>\n<p>Malgré des progrès significatifs, l'accès à Internet reste inégal sur le continent. Les zones rurales sont particulièrement touchées par la fracture numérique. Les coûts d'accès demeurent élevés par rapport au pouvoir d'achat moyen.</p>\n\n<h3>Formation et compétences</h3>\n<p>Le manque de compétences numériques constitue un frein important. Les systèmes éducatifs doivent s'adapter pour former les talents nécessaires à l'économie numérique.</p>\n\n<h3>Cadre réglementaire</h3>\n<p>L'absence d'un cadre juridique adapté dans certains pays limite le développement de services numériques innovants et la protection des consommateurs.</p>",
                    ],
                    'en' => [
                        'title' => 'Challenges of Digital Transformation in Africa',
                        'excerpt' => 'Analysis of obstacles and opportunities in the digitalization process of African economies.',
                        'content' => "<p><em>This is an automatically translated version of the original French content.</em></p>\n<p>Digital transformation represents an unprecedented opportunity for Africa's economic and social development. However, several major challenges must be addressed for this digital revolution to be inclusive and sustainable.</p>\n\n<h3>Infrastructure and connectivity</h3>\n<p>Despite significant progress, internet access remains unequal across the continent. Rural areas are particularly affected by the digital divide. Access costs remain high compared to average purchasing power.</p>\n\n<h3>Training and skills</h3>\n<p>The lack of digital skills is a significant barrier. Educational systems must adapt to train the talent needed for the digital economy.</p>\n\n<h3>Regulatory framework</h3>\n<p>The absence of an adapted legal framework in certain countries limits the development of innovative digital services and consumer protection.</p>",
                    ],
                ],
            ],
            [
                'category' => ArticleCategory::ARTIFICIAL_INTELLIGENCE,
                'illustration' => 'https://images.unsplash.com/photo-1677442135133-4be2e3a0faab?q=80&w=1000&auto=format&fit=crop',
                'tags' => ['IA', 'Innovation', 'Entreprises', 'Technologie'],
                'featured' => true,
                'status' => ArticleStatus::PUBLISHED,
                'published_at' => Carbon::now()->subDays(3),
                'author_id' => $admin->id,
                'translations' => [
                    'fr' => [
                        'title' => 'Intelligence artificielle : applications concrètes pour les entreprises africaines',
                        'excerpt' => 'Comment les entreprises africaines peuvent tirer parti de l\'IA pour améliorer leurs opérations et services.',
                        'content' => "<p>L'intelligence artificielle (IA) n'est plus une technologie du futur, mais une réalité qui transforme déjà de nombreux secteurs économiques. En Afrique, malgré certaines contraintes, des entreprises innovantes commencent à exploiter le potentiel de l'IA pour résoudre des problèmes locaux et améliorer leur compétitivité.</p>\n\n<h3>Agriculture</h3>\n<p>Des startups comme Hello Tractor au Nigeria ou Aerobotics en Afrique du Sud utilisent l'IA pour optimiser les rendements agricoles, prédire les maladies des cultures et faciliter l'accès aux équipements.</p>\n\n<h3>Santé</h3>\n<p>Dans le domaine médical, l'IA permet d'améliorer le diagnostic de maladies comme le paludisme ou la tuberculose, particulièrement dans les zones où les spécialistes sont rares.</p>\n\n<h3>Services financiers</h3>\n<p>Les institutions financières utilisent l'IA pour évaluer les risques de crédit, détecter les fraudes et proposer des services financiers personnalisés aux populations non bancarisées.</p>",
                    ],
                    'en' => [
                        'title' => 'Artificial Intelligence: Practical Applications for African Businesses',
                        'excerpt' => 'How African businesses can leverage AI to improve their operations and services.',
                        'content' => "<p><em>This is an automatically translated version of the original French content.</em></p>\n<p>Artificial intelligence (AI) is no longer a technology of the future, but a reality that is already transforming many economic sectors. In Africa, despite certain constraints, innovative companies are beginning to harness the potential of AI to solve local problems and improve their competitiveness.</p>\n\n<h3>Agriculture</h3>\n<p>Startups like Hello Tractor in Nigeria or Aerobotics in South Africa use AI to optimize agricultural yields, predict crop diseases, and facilitate access to equipment.</p>\n\n<h3>Health</h3>\n<p>In the medical field, AI improves the diagnosis of diseases such as malaria or tuberculosis, particularly in areas where specialists are scarce.</p>\n\n<h3>Financial services</h3>\n<p>Financial institutions use AI to assess credit risks, detect fraud, and offer personalized financial services to unbanked populations.</p>",
                    ],
                ],
            ],
        ];

        foreach ($articles as $articleData) {
            // Extraire les traductions
            $translations = $articleData['translations'];
            unset($articleData['translations']);

            // Définir la langue par défaut
            $articleData['default_locale'] = LanguageEnum::FRENCH->value;

            // Créer l'article
            $article = Article::create($articleData);

            // Ajouter les traductions
            foreach ($translations as $locale => $translationData) {
                $slug = Str::slug($translationData['title']);
                if (ArticleTranslation::where('slug', $slug)->where('locale', $locale)->exists()) {
                    continue;
                }
                ArticleTranslation::create([
                    'article_id' => $article->id,
                    'locale' => $locale,
                    'title' => $translationData['title'],
                    'slug' => $slug,
                    'excerpt' => $translationData['excerpt'] ?? null,
                    'content' => $translationData['content'] ?? null,
                    'meta_title' => $translationData['meta_title'] ?? $translationData['title'],
                    'meta_description' => $translationData['meta_description'] ?? $translationData['excerpt'] ?? null,
                    'reading_time' => $translationData['reading_time'] ?? $this->calculateReadingTime($translationData['content'] ?? ''),
                ]);
            }
        }
    }

    /**
     * Calcule le temps de lecture estimé en minutes
     */
    protected function calculateReadingTime($content)
    {
        $wordsPerMinute = 200;
        $numberOfWords = str_word_count(strip_tags($content));

        return max(1, ceil($numberOfWords / $wordsPerMinute));
    }
}
