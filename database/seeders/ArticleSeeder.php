<?php

namespace Database\Seeders;

use App\Enums\ArticleCategory;
use App\Enums\ArticleStatus;
use App\Models\Administrator;
use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer un administrateur pour le champ author_id
        $admin = Administrator::first();
        
        if (!$admin) {
            $this->command->error('Aucun administrateur trouvé. Veuillez d\'abord créer un administrateur.');
            return;
        }
        
        $articles = [
            [
                'title' => 'L\'écosystème tech ivoirien en pleine expansion',
                'excerpt' => 'Découvrez comment la Côte d\'Ivoire est en train de devenir un hub technologique majeur en Afrique de l\'Ouest.',
                'content' => "<p>L'écosystème technologique ivoirien connaît une croissance remarquable ces dernières années. Avec l'émergence de nombreuses startups innovantes, d'espaces de coworking dynamiques et le soutien croissant des investisseurs, Abidjan s'impose progressivement comme un hub tech incontournable en Afrique de l'Ouest.</p>\n\n<p>Plusieurs facteurs expliquent cette montée en puissance :</p>\n\n<ul>\n<li>Une population jeune et de plus en plus connectée</li>\n<li>Des infrastructures de télécommunication en amélioration constante</li>\n<li>L'implantation de grands groupes technologiques internationaux</li>\n<li>Le développement de formations spécialisées dans le numérique</li>\n<li>Un cadre réglementaire de plus en plus favorable à l'innovation</li>\n</ul>\n\n<p>Des initiatives comme le Village des Technologies de l'Information et de la Biotechnologie (VITIB) à Grand-Bassam ou encore Orange Digital Center à Abidjan témoignent de cette dynamique positive.</p>",
                'category' => ArticleCategory::TECH_ECOSYSTEM,
                'illustration' => 'https://images.unsplash.com/photo-1531482615713-2afd69097998?q=80&w=1000&auto=format&fit=crop',
                'tags' => ['Côte d\'Ivoire', 'Startups', 'Innovation', 'Développement'],
                'featured' => true,
                'status' => ArticleStatus::PUBLISHED,
                'published_at' => Carbon::now()->subDays(5),
                'author_id' => $admin->id
            ],
            [
                'title' => 'Les défis de la transformation numérique en Afrique',
                'excerpt' => 'Analyse des obstacles et opportunités dans le processus de digitalisation des économies africaines.',
                'content' => "<p>La transformation numérique représente une opportunité sans précédent pour le développement économique et social de l'Afrique. Cependant, plusieurs défis majeurs doivent être relevés pour que cette révolution numérique soit inclusive et durable.</p>\n\n<h3>Infrastructures et connectivité</h3>\n<p>Malgré des progrès significatifs, l'accès à Internet reste inégal sur le continent. Les zones rurales sont particulièrement touchées par la fracture numérique. Les coûts d'accès demeurent élevés par rapport au pouvoir d'achat moyen.</p>\n\n<h3>Formation et compétences</h3>\n<p>Le manque de compétences numériques constitue un frein important. Les systèmes éducatifs doivent s'adapter pour former les talents nécessaires à l'économie numérique.</p>\n\n<h3>Cadre réglementaire</h3>\n<p>L'absence d'un cadre juridique adapté dans certains pays limite le développement de services numériques innovants et la protection des consommateurs.</p>",
                'category' => ArticleCategory::DIGITAL_TRANSFORMATION,
                'illustration' => 'https://images.unsplash.com/photo-1484807352052-23338990c6c6?q=80&w=1000&auto=format&fit=crop',
                'tags' => ['Afrique', 'Digital', 'Développement', 'Inclusion numérique'],
                'featured' => false,
                'status' => ArticleStatus::PUBLISHED,
                'published_at' => Carbon::now()->subDays(10),
                'author_id' => $admin->id
            ],
            [
                'title' => 'Intelligence artificielle : applications concrètes pour les entreprises africaines',
                'excerpt' => 'Comment les entreprises africaines peuvent tirer parti de l\'IA pour améliorer leurs opérations et services.',
                'content' => "<p>L'intelligence artificielle (IA) n'est plus une technologie du futur, mais une réalité qui transforme déjà de nombreux secteurs économiques. En Afrique, malgré certaines contraintes, des entreprises innovantes commencent à exploiter le potentiel de l'IA pour résoudre des problèmes locaux et améliorer leur compétitivité.</p>\n\n<h3>Agriculture</h3>\n<p>Des startups comme Hello Tractor au Nigeria ou Aerobotics en Afrique du Sud utilisent l'IA pour optimiser les rendements agricoles, prédire les maladies des cultures et faciliter l'accès aux équipements.</p>\n\n<h3>Santé</h3>\n<p>Dans le domaine médical, l'IA permet d'améliorer le diagnostic de maladies comme le paludisme ou la tuberculose, particulièrement dans les zones où les spécialistes sont rares.</p>\n\n<h3>Services financiers</h3>\n<p>Les institutions financières utilisent l'IA pour évaluer les risques de crédit, détecter les fraudes et proposer des services financiers personnalisés aux populations non bancarisées.</p>",
                'category' => ArticleCategory::ARTIFICIAL_INTELLIGENCE,
                'illustration' => 'https://images.unsplash.com/photo-1677442135133-4be2e3a0faab?q=80&w=1000&auto=format&fit=crop',
                'tags' => ['IA', 'Innovation', 'Entreprises', 'Technologie'],
                'featured' => true,
                'status' => ArticleStatus::PUBLISHED,
                'published_at' => Carbon::now()->subDays(3),
                'author_id' => $admin->id
            ],
            [
                'title' => 'Cybersécurité : protéger les entreprises africaines face aux menaces croissantes',
                'excerpt' => 'Les bonnes pratiques et solutions pour renforcer la sécurité numérique des organisations en Afrique.',
                'content' => "<p>Avec la digitalisation croissante des économies africaines, les cyberattaques se multiplient et ciblent aussi bien les grandes organisations que les PME. La sensibilisation et l'adoption de mesures de protection adaptées deviennent cruciales.</p>\n\n<h3>État des lieux</h3>\n<p>Selon plusieurs rapports, l'Afrique connaît une augmentation significative des cyberattaques, avec des pertes estimées à plusieurs milliards de dollars chaque année. Les secteurs les plus touchés sont la finance, les télécommunications et l'administration publique.</p>\n\n<h3>Principales vulnérabilités</h3>\n<ul>\n<li>Manque de formation et de sensibilisation du personnel</li>\n<li>Utilisation de logiciels obsolètes ou non mis à jour</li>\n<li>Absence de politiques de sécurité formalisées</li>\n<li>Faible investissement dans les solutions de protection</li>\n</ul>\n\n<h3>Recommandations</h3>\n<p>Les entreprises africaines doivent adopter une approche proactive en matière de cybersécurité, incluant la formation régulière des employés, la mise en place de systèmes de sauvegarde robustes et l'élaboration de plans de réponse aux incidents.</p>",
                'category' => ArticleCategory::CYBERSECURITY,
                'illustration' => 'https://images.unsplash.com/photo-1563013544-824ae1b704d3?q=80&w=1000&auto=format&fit=crop',
                'tags' => ['Sécurité', 'Cyberattaques', 'Protection', 'Données'],
                'featured' => false,
                'status' => ArticleStatus::PUBLISHED,
                'published_at' => Carbon::now()->subDays(15),
                'author_id' => $admin->id
            ],
            [
                'title' => 'Le mobile money : moteur de l\'inclusion financière en Afrique',
                'excerpt' => 'Comment les services d\'argent mobile transforment l\'accès aux services financiers sur le continent africain.',
                'content' => "<p>Le mobile money s'est imposé comme une véritable révolution financière en Afrique, permettant à des millions de personnes non bancarisées d'accéder à des services financiers essentiels. La Côte d'Ivoire figure parmi les marchés les plus dynamiques dans ce domaine.</p>\n\n<h3>Un succès incontestable</h3>\n<p>Avec plus de 300 millions de comptes actifs sur le continent, l'Afrique est aujourd'hui le leader mondial du mobile money. Des services comme Orange Money, MTN Mobile Money ou Wave ont transformé la manière dont les Africains effectuent leurs transactions quotidiennes.</p>\n\n<h3>Impact sur l'économie</h3>\n<p>Le mobile money facilite les transferts d'argent, stimule le commerce et permet le développement de nouveaux services comme le crédit digital, l'épargne ou les micro-assurances. Il contribue également à la formalisation de l'économie et à l'augmentation des recettes fiscales.</p>\n\n<h3>Perspectives d'évolution</h3>\n<p>L'avenir du mobile money en Afrique passe par l'interopérabilité entre les différentes plateformes, l'intégration avec d'autres services numériques et l'expansion vers des services financiers plus sophistiqués.</p>",
                'category' => ArticleCategory::FINTECH,
                'illustration' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?q=80&w=1000&auto=format&fit=crop',
                'tags' => ['Mobile Money', 'Inclusion financière', 'Innovation', 'Paiements'],
                'featured' => true,
                'status' => ArticleStatus::PUBLISHED,
                'published_at' => Carbon::now()->subDays(8),
                'author_id' => $admin->id
            ],
            [
                'title' => 'Comment réussir sa startup tech en Côte d\'Ivoire',
                'excerpt' => 'Conseils pratiques et témoignages d\'entrepreneurs qui ont réussi dans l\'écosystème tech ivoirien.',
                'content' => "<p>Lancer une startup technologique en Côte d'Ivoire présente à la fois des opportunités uniques et des défis spécifiques. Voici quelques conseils essentiels pour maximiser vos chances de succès.</p>\n\n<h3>Identifier un besoin réel</h3>\n<p>Les startups qui réussissent sont celles qui répondent à des problèmes concrets rencontrés par les Ivoiriens. Prenez le temps d'étudier le marché et de valider votre idée avant de vous lancer.</p>\n\n<h3>Constituer une équipe complémentaire</h3>\n<p>Entourez-vous de personnes aux compétences variées et complémentaires. La diversité des profils est souvent un facteur clé de réussite.</p>\n\n<h3>Se connecter à l'écosystème</h3>\n<p>Rejoignez des communautés comme Hub Ivoire Tech, participez à des événements et intégrez des programmes d'incubation ou d'accélération qui vous donneront accès à des ressources précieuses.</p>\n\n<h3>Adopter une approche frugale</h3>\n<p>Les ressources financières étant souvent limitées, apprenez à optimiser chaque franc CFA investi et à pivoter rapidement si nécessaire.</p>",
                'category' => ArticleCategory::ENTREPRENEURSHIP,
                'illustration' => 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?q=80&w=1000&auto=format&fit=crop',
                'tags' => ['Startups', 'Entrepreneuriat', 'Conseils', 'Innovation'],
                'featured' => false,
                'status' => ArticleStatus::DRAFT,
                'author_id' => $admin->id
            ],
            [
                'title' => 'Les femmes dans la tech en Afrique : défis et opportunités',
                'excerpt' => 'État des lieux de la place des femmes dans le secteur technologique africain et initiatives pour plus d\'inclusion.',
                'content' => "<p>Malgré des progrès notables ces dernières années, les femmes restent sous-représentées dans le secteur technologique africain. Pourtant, leur inclusion est essentielle pour créer des solutions technologiques véritablement adaptées à l'ensemble de la population.</p>\n\n<h3>État des lieux</h3>\n<p>En Afrique, les femmes représentent moins de 30% des professionnels du secteur tech. Elles sont encore moins nombreuses à occuper des postes de direction ou à fonder des startups technologiques.</p>\n\n<h3>Obstacles persistants</h3>\n<ul>\n<li>Stéréotypes de genre dès l'éducation primaire</li>\n<li>Manque de modèles féminins visibles</li>\n<li>Difficultés d'accès au financement</li>\n<li>Environnements de travail parfois peu inclusifs</li>\n</ul>\n\n<h3>Initiatives prometteuses</h3>\n<p>Des organisations comme Women in Tech Africa, She Code Africa ou African Girls Can Code Initiative œuvrent pour former davantage de femmes aux métiers du numérique et créer un environnement plus inclusif.</p>",
                'category' => ArticleCategory::DIVERSITY_INCLUSION,
                'illustration' => 'https://images.unsplash.com/photo-1573164713988-8665fc963095?q=80&w=1000&auto=format&fit=crop',
                'tags' => ['Femmes', 'Tech', 'Inclusion', 'Diversité'],
                'featured' => false,
                'status' => ArticleStatus::PUBLISHED,
                'published_at' => Carbon::now()->subDays(12),
                'author_id' => $admin->id
            ]
        ];
        
        foreach ($articles as $article) {
            $slug = Str::slug($article['title']);
            if (!Article::query()->whereSlug($slug)->exists()) {
                Article::create($article);
            }
        }
    }
}
