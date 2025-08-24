<?php

namespace Database\Seeders;

use App\Enums\ArticleCategory;
use App\Enums\ArticleStatus;
use App\Enums\LanguageEnum;
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
        $authorId = \App\Models\Administrator::first()->id;
        $newIllustration = 'https://images.unsplash.com/photo-1521791136064-7986c2920216?q=80&w=1000&auto=format&fit=crop';

        $articles = [
            [
                'category' => ArticleCategory::FINTECH,
                'illustration' => $newIllustration,
                'tags' => ['Fintech', 'Mobile Money', 'UEMOA', 'Inclusion financière'],
                'featured' => true,
                'status' => ArticleStatus::PUBLISHED,
                'published_at' => Carbon::now()->subDays(2),
                'title' => 'La révolution FinTech en zone UEMOA : Orange Money et Wave en première ligne',
                'excerpt' => 'Comment les solutions de paiement mobile transforment l\'économie ouest-africaine et favorisent l\'inclusion financière.',
                'content' => "<p>L'Afrique de l'Ouest connaît une véritable révolution dans les services financiers grâce à l'essor des technologies FinTech. La Côte d'Ivoire, en tant que locomotive économique de la région, joue un rôle central dans cette transformation.</p><h3>Orange Money : le pionnier</h3><p>Lancé en 2012 en Côte d'Ivoire, Orange Money compte aujourd'hui plus de 50 millions d'utilisateurs en Afrique. Le service a révolutionné les transferts d'argent et les paiements quotidiens, permettant à des millions d'Ivoiriens d'accéder aux services financiers.</p><h3>Wave : la nouvelle génération</h3><p>Arrivée plus récemment, Wave propose des transferts d'argent sans frais et défie les acteurs traditionnels. La startup sénégalaise s'implante progressivement en Côte d'Ivoire avec une approche technologique innovante.</p><h3>Impact sur l'économie</h3><p>Ces services facilitent :</p><ul><li>Les transferts de fonds des diaspora</li><li>Les paiements des commerçants</li><li>L'accès au crédit pour les micro-entrepreneurs</li><li>La bancarisation des populations rurales</li></ul>",
            ],
            [
                'category' => ArticleCategory::CYBERSECURITY,
                'illustration' => $newIllustration,
                'tags' => ['Cybersécurité', 'Afrique', 'Fraude', 'Sécurité mobile'],
                'featured' => false,
                'status' => ArticleStatus::PUBLISHED,
                'published_at' => Carbon::now()->subDays(7),
                'title' => 'Cybersécurité en Afrique : les défis spécifiques du continent',
                'excerpt' => 'Analyse des menaces cybersécuritaires en Afrique et des solutions adaptées au contexte local.',
                'content' => "<p>L'Afrique fait face à des défis uniques en matière de cybersécurité, liés à la fois à la croissance rapide du numérique et aux spécificités socio-économiques du continent.</p><h3>Menaces spécifiques</h3><p>Les cybercriminels exploitent particulièrement :</p><ul><li>La faible sensibilisation des utilisateurs</li><li>Les infrastructures réseau encore fragiles</li><li>Le développement rapide du mobile money</li><li>Les fraudes liées aux transferts internationaux</li></ul><h3>Cas de la Côte d'Ivoire</h3><p>En Côte d'Ivoire, l'ARTCI (Autorité de Régulation des Télécommunications) a mis en place plusieurs initiatives :</p><ul><li>Centre de veille cybersécurité</li><li>Campagnes de sensibilisation</li><li>Réglementation des services numériques</li><li>Coopération régionale</li></ul><h3>Solutions innovantes</h3><p>Des startups africaines développent des solutions de sécurité adaptées, comme des systèmes de détection de fraude pour mobile money ou des outils d'authentification biométrique.</p>",
            ],
            [
                'category' => ArticleCategory::ENTREPRENEURSHIP,
                'illustration' => $newIllustration,
                'tags' => ['Entrepreneuriat', 'Startups', 'Abidjan', 'Écosystème'],
                'featured' => true,
                'status' => ArticleStatus::PUBLISHED,
                'published_at' => Carbon::now()->subDays(4),
                'title' => 'Portrait de l\'écosystème startup d\'Abidjan : succès et défis',
                'excerpt' => 'Découvrez les success stories, les acteurs clés et les défis de l\'écosystème entrepreneurial d\'Abidjan.',
                'content' => "<p>Abidjan s'impose progressivement comme un hub entrepreneurial majeur en Afrique de l'Ouest. La capitale économique ivoirienne attire de plus en plus d'entrepreneurs, d'investisseurs et d'incubateurs.</p><h3>Les success stories</h3><p>Plusieurs startups ivoiriennes ont marqué l'écosystème :</p><ul><li><strong>PayDunya (maintenant DunyaPay)</strong> : plateforme de paiement en ligne</li><li><strong>Julaya</strong> : marketplace pour l'artisanat africain</li><li><strong>CinetPay</strong> : solution de paiement mobile</li><li><strong>SudPay</strong> : services financiers numériques</li></ul><h3>Acteurs de l'écosystème</h3><p>L'écosystème s'appuie sur plusieurs piliers :</p><ul><li><strong>Incubateurs</strong> : Orange Digital Center, CIPME, Impact Hub</li><li><strong>Espaces de coworking</strong> : Hub Ivoire Tech, Oasis500, La Factory</li><li><strong>Investisseurs</strong> : Société Générale Capital, Teranga Capital</li><li><strong>Institutions</strong> : CEPICI, CGECI, ministère du Numérique</li></ul><h3>Défis à relever</h3><p>Malgré les progrès, plusieurs défis persistent :</p><ul><li>Accès au financement pour les early-stage startups</li><li>Formation des talents techniques</li><li>Réglementation parfois complexe</li><li>Marché local encore limité</li></ul>",
            ],
            [
                'category' => ArticleCategory::BLOCKCHAIN,
                'illustration' => $newIllustration,
                'tags' => ['Blockchain', 'Agriculture', 'Traçabilité', 'Cacao'],
                'featured' => false,
                'status' => ArticleStatus::PUBLISHED,
                'published_at' => Carbon::now()->subDays(12),
                'title' => 'Blockchain et agriculture : traçabilité du cacao ivoirien',
                'excerpt' => 'Comment la blockchain révolutionne la traçabilité des produits agricoles, avec l\'exemple du cacao en Côte d\'Ivoire.',
                'content' => "<p>La Côte d'Ivoire, premier producteur mondial de cacao, explore l'utilisation de la blockchain pour améliorer la traçabilité de sa filière cacaoyère.</p><h3>Enjeux de la traçabilité</h3><p>La filière cacao fait face à plusieurs défis :</p><ul><li>Lutte contre le travail des enfants</li><li>Déforestation et durabilité environnementale</li><li>Juste rémunération des producteurs</li><li>Certification et qualité des fèves</li></ul><h3>Solutions blockchain</h3><p>La technologie blockchain offre plusieurs avantages :</p><ul><li><strong>Transparence</strong> : suivi complet de la chaîne d'approvisionnement</li><li><strong>Immutabilité</strong> : données non falsifiables</li><li><strong>Smart contracts</strong> : paiements automatisés aux producteurs</li><li><strong>Certification</strong> : preuves numériques de durabilité</li></ul><h3>Initiatives en cours</h3><p>Plusieurs projets pilotes sont en développement :</p><ul><li>Collaboration avec des multinationales du chocolat</li><li>Partenariats avec des coopératives locales</li><li>Support du Conseil Café-Cacao</li><li>Formation des producteurs aux outils numériques</li></ul><h3>Impact attendu</h3><p>Cette transformation pourrait permettre :</p><ul><li>Amélioration des revenus des producteurs</li><li>Renforcement de la marque \"Cacao de Côte d'Ivoire\"</li><li>Accès privilégié aux marchés premium</li><li>Développement d'une industrie tech agricole</li></ul>",
            ],
            [
                'category' => ArticleCategory::DIVERSITY_INCLUSION,
                'illustration' => $newIllustration,
                'tags' => ['Femmes', 'Tech', 'Leadership', 'Inclusion'],
                'featured' => true,
                'status' => ArticleStatus::PUBLISHED,
                'published_at' => Carbon::now()->subDays(1),
                'title' => 'Femmes leaders dans la tech africaine : portraits inspirants',
                'excerpt' => 'Rencontre avec des femmes qui façonnent l\'avenir technologique de l\'Afrique et brisent les barrières.',
                'content' => "<p>L'Afrique compte de nombreuses femmes leaders qui transforment le paysage technologique du continent. Leurs parcours inspirants montrent la voie vers plus de diversité et d'inclusion dans la tech.</p><h3>Rebecca Enonchong - Cameroun</h3><p>Fondatrice d'AppsTech et figure emblématique de la tech africaine, Rebecca Enonchong milite pour l'entrepreneuriat féminin et a inspiré une génération d'entrepreneures.</p><h3>Judith Owigar - Kenya</h3><p>Co-fondatrice d'Akirachix, elle forme des femmes développeuses et designers au Kenya. Son organisation a déjà formé plus de 2000 femmes aux technologies.</p><h3>Initiatives en Côte d'Ivoire</h3><p>La Côte d'Ivoire voit émerger plusieurs initiatives :</p><ul><li><strong>Women in Tech CI</strong> : communauté des femmes tech ivoiriennes</li><li><strong>Empow'Her</strong> : programmes de formation et mentorat</li><li><strong>Girls in ICT</strong> : sensibilisation des jeunes filles</li><li><strong>Tech Sisters</strong> : réseau de networking et support</li></ul><h3>Défis et opportunités</h3><p>Les femmes dans la tech africaine font face à :</p><ul><li><strong>Défis</strong> : accès limité au financement, stéréotypes, manque de modèles</li><li><strong>Opportunités</strong> : marché en croissance, programmes de soutien, demande croissante</li></ul><h3>Impact et perspectives</h3><p>La participation accrue des femmes dans la tech permet :</p><ul><li>Innovation plus inclusive</li><li>Solutions adaptées aux besoins féminins</li><li>Croissance économique renforcée</li><li>Modèles inspirants pour les nouvelles générations</li></ul>",
            ],
            [
                'category' => ArticleCategory::MOBILE,
                'illustration' => $newIllustration,
                'tags' => ['Mobile', 'Applications', 'Afrique', 'Innovation'],
                'featured' => false,
                'status' => ArticleStatus::PUBLISHED,
                'published_at' => Carbon::now()->subDays(8),
                'title' => 'Le boom des applications mobiles \"Made in Africa\"',
                'excerpt' => 'Découvrez comment les développeurs africains créent des applications innovantes adaptées aux besoins locaux.',
                'content' => "<p>L'Afrique connaît une explosion du développement d'applications mobiles avec des solutions innovantes conçues par et pour les Africains.</p><h3>Applications phares du continent</h3><p>Plusieurs apps africaines ont conquis les marchés :</p><ul><li><strong>M-Pesa (Kenya)</strong> : paiement mobile pionnier</li><li><strong>Jumia (Nigeria)</strong> : e-commerce panafricain</li><li><strong>Flutterwave (Nigeria)</strong> : infrastructure de paiement</li><li><strong>Andela (Nigeria)</strong> : plateforme de développeurs</li></ul><h3>Innovation ivoirienne</h3><p>La Côte d'Ivoire développe ses propres solutions :</p><ul><li><strong>Sama Money</strong> : transferts d'argent simplifiés</li><li><strong>Qelasy</strong> : marketplace locale</li><li><strong>MyToli</strong> : plateforme de services</li><li><strong>Paydunya</strong> : solutions de paiement</li></ul><h3>Spécificités du marché africain</h3><p>Les développeurs africains s'adaptent aux contraintes locales :</p><ul><li>Optimisation pour réseaux 2G/3G</li><li>Applications légères et efficaces</li><li>Support des langues locales</li><li>Adaptation aux modes de paiement locaux</li><li>Fonctionnement offline</li></ul><h3>Défis techniques</h3><p>Le développement mobile en Afrique présente des défis :</p><ul><li>Fragmentation des OS et devices</li><li>Connectivité limitée dans certaines zones</li><li>Coût des données mobiles</li><li>Diversité des langues et cultures</li></ul><h3>Opportunités futures</h3><p>Le secteur mobile africain offre des perspectives prometteuses :</p><ul><li>Croissance rapide de la pénétration smartphone</li><li>Amélioration des infrastructures réseau</li><li>Émergence de la 5G</li><li>Investissements croissants dans la tech</li></ul>",
            ],
        ];

        foreach ($articles as $articleData) {
            $article = Article::create([
                'category' => $articleData['category'],
                'illustration' => $articleData['illustration'],
                'tags' => $articleData['tags'],
                'featured' => $articleData['featured'],
                'status' => $articleData['status'],
                'published_at' => $articleData['published_at'],
                'author_id' => $authorId,
                'default_locale' => LanguageEnum::FRENCH->value,
            ]);

            $slug = Str::slug($articleData['title']);
            if (!ArticleTranslation::where('slug', $slug)->where('locale', 'fr')->exists()) {
                ArticleTranslation::create([
                    'article_id' => $article->id,
                    'locale' => LanguageEnum::FRENCH->value,
                    'title' => $articleData['title'],
                    'slug' => $slug,
                    'excerpt' => $articleData['excerpt'],
                    'content' => $articleData['content'],
                    'reading_time' => $this->calculateReadingTime($articleData['content']),
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