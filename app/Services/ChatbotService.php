<?php

namespace App\Services;

use App\Models\Event;
use App\Models\Article;
use App\Models\Espace;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotService
{
    private string $apiKey;
    private string $model = 'gpt-4.1-nano';
    private string $apiUrl = 'https://api.openai.com/v1/chat/completions';

    public function __construct()
    {
        $this->apiKey = config('services.openai.api_key');
    }

    public function getResponse(string $message, array $context = []): array
    {
        try {
            $systemPrompt = $this->buildSystemPrompt();
            $dynamicContext = $this->getDynamicContext($message);
            $messages = $this->buildMessages($systemPrompt . $dynamicContext, $message, $context);

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->post($this->apiUrl, [
                'model' => $this->model,
                'messages' => $messages,
                'temperature' => 0.7,
                'max_tokens' => 500,
                'stream' => false,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return [
                    'success' => true,
                    'message' => $data['choices'][0]['message']['content'] ?? 'Désolé, je n\'ai pas pu générer une réponse.',
                ];
            }

            Log::channel('chatbot')->error('ChatbotService API Error', [
                'status' => $response->status(),
                'body' => $response->body(),
                'model' => $this->model,
            ]);

            // Messages d'erreur plus spécifiques
            $errorMessage = 'Je rencontre des difficultés techniques.';
            if ($response->status() === 401) {
                $errorMessage = 'Problème de configuration API. Contactez l\'administrateur.';
            } elseif ($response->status() === 429) {
                $errorMessage = 'Service temporairement saturé. Réessayez dans quelques minutes.';
            } elseif ($response->status() >= 500) {
                $errorMessage = 'Service OpenAI indisponible. Réessayez plus tard.';
            }

            return [
                'success' => false,
                'message' => $errorMessage,
                'fallback' => 'Pour une assistance immédiate, contactez-nous à hello@hubivoiretech.ci ou +225 07 04 85 38 48.',
            ];
        } catch (\Exception $e) {
            Log::channel('chatbot')->error('ChatbotService Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'model' => $this->model,
            ]);

            return [
                'success' => false,
                'message' => 'Une erreur technique est survenue.',
                'fallback' => 'Pour une assistance immédiate, contactez-nous à hello@hubivoiretech.ci ou +225 07 04 85 38 48.',
            ];
        }
    }

    private function buildSystemPrompt(): string
    {
        return "Tu es Ama, l'assistant virtuel du Hub Ivoire Tech, le plus grand Campus de Startups en Afrique basé à Abidjan, Côte d'Ivoire. 
        Tu dois aider les visiteurs en répondant à leurs questions de manière concise, professionnelle et chaleureuse.
        
        ## À PROPOS DU HUB IVOIRE TECH
        Hub Ivoire Tech réunit un écosystème d'incubateurs, d'accélérateurs, d'investisseurs, d'experts et d'entrepreneurs pour stimuler l'innovation et transformer les idées en succès concrets sur le territoire ivoirien et au-delà.
        
        ## NOS SERVICES
        • **Programmes d'accompagnement** : Incubation et accélération avec coaching, mentoring et masterclasses
        • **Espaces de coworking** : Open spaces, bureaux privés, bureaux dédiés, salles de réunion et conférence
        • **Espaces spécialisés** : Fab-lab/atelier pour l'innovation, salle de détente, espaces événementiels
        • **Support administratif** : Aide aux démarches administratives pour faciliter le développement des entreprises
        • **Réseau** : Accès à un réseau d'experts, partenaires stratégiques et investisseurs
        
        ## PAGES IMPORTANTES À RECOMMANDER
        • **/evenements** : Découvrir et s'inscrire aux événements, formations, hackathons
        • **/actualites** : Lire nos articles et dernières actualités du hub
        • **/visitez-le-campus** : Planifier une visite guidée du campus (formulaire de réservation)
        • **/candidatures** : Postuler comme résident, expert ou partenaire
        • **/partenariat** : Explorer les opportunités de partenariat
        
        ## FAQ INTÉGRÉE
        **Qui peut bénéficier des programmes ?**
        Les programmes s'adressent aux startups, porteurs de projets et entrepreneurs désireux de concrétiser leurs idées, en phase de création ou en pleine croissance.
        
        **Types d'espaces disponibles :**
        • Open space, bureaux privés et dédiés (13ème étage, mezzanine)
        • Salles de réunion et conférence équipées
        • Fab-lab/atelier pour prototypage
        • Espaces de détente et événementiels
        
        **Pour rester informé :**
        Inscription à la newsletter et notifications WhatsApp pour recevoir toutes les actualités, formations et événements.
        
        ## INSTRUCTIONS DE RÉPONSE
        • Réponds toujours en français avec un ton professionnel mais chaleureux
        • Sois concis (2-3 phrases maximum) tout en étant informatif  
        • Recommande les liens pertinents (/candidatures, /evenements, /visitez-le-campus)
        • Pour les questions sur l'espace membre : /resident (connexion requise)
        • Ne mentionne pas que tu es une IA, présente-toi comme Ama l'assistante du hub
        • Encourage la visite du campus et l'engagement avec notre écosystème";
    }

    private function buildMessages(string $systemPrompt, string $userMessage, array $context): array
    {
        $messages = [
            ['role' => 'system', 'content' => $systemPrompt]
        ];

        // Add context from previous messages if available
        foreach ($context as $msg) {
            $messages[] = $msg;
        }

        $messages[] = ['role' => 'user', 'content' => $userMessage];

        // Limit to last 10 messages to stay within token limits
        return array_slice($messages, -10);
    }

    private function getDynamicContext(string $message): string
    {
        $dynamicInfo = "\n\n## INFORMATIONS EN TEMPS RÉEL\n";
        
        // Détection des mots-clés pour événements
        if (preg_match('/\b(événement|event|formation|atelier|workshop|hackathon|conférence|séminaire)\b/i', $message)) {
            $upcomingEvents = Event::where('status', 'published')
                ->where('start_date', '>', now())
                ->orderBy('start_date')
                ->limit(3)
                ->get();
                
            if ($upcomingEvents->isNotEmpty()) {
                $dynamicInfo .= "**ÉVÉNEMENTS À VENIR :**\n";
                foreach ($upcomingEvents as $event) {
                    $title = $event->getTranslatedAttribute('title') ?: 'Événement sans titre';
                    $date = $event->start_date->format('d/m/Y à H:i');
                    $price = $event->is_paid ? ($event->getCurrentPrice() . ' ' . $event->currency) : 'Gratuit';
                    $dynamicInfo .= "• {$title} - {$date} ({$price})\n";
                }
                $dynamicInfo .= "→ Voir tous les événements : /evenements\n\n";
            }
        }
        
        // Détection des mots-clés pour articles/actualités
        if (preg_match('/\b(actualité|article|news|nouvelles|info)\b/i', $message)) {
            $recentArticles = Article::where('status', 'published')
                ->where('published_at', '<=', now())
                ->orderBy('published_at', 'desc')
                ->limit(2)
                ->get();
                
            if ($recentArticles->isNotEmpty()) {
                $dynamicInfo .= "**DERNIÈRES ACTUALITÉS :**\n";
                foreach ($recentArticles as $article) {
                    $title = $article->getTranslatedAttribute('title') ?: 'Article sans titre';
                    $date = $article->published_at->format('d/m/Y');
                    $dynamicInfo .= "• {$title} - {$date}\n";
                }
                $dynamicInfo .= "→ Lire toutes les actualités : /actualites\n\n";
            }
        }
        
        // Détection des mots-clés pour espaces
        if (preg_match('/\b(espace|bureau|salle|coworking|réunion|location|louer)\b/i', $message)) {
            $availableSpaces = Espace::where('is_active', true)
                ->where('status', 'available')
                ->limit(3)
                ->get();
                
            if ($availableSpaces->isNotEmpty()) {
                $dynamicInfo .= "**ESPACES DISPONIBLES :**\n";
                foreach ($availableSpaces as $space) {
                    $typeLabel = Espace::FR_TYPES[$space->type] ?? $space->type;
                    $floor = Espace::FR_FLOORS[$space->floor] ?? $space->floor;
                    $price = $space->price_per_hour ? ($space->price_per_hour . ' FCFA/h') : 'Prix sur demande';
                    $dynamicInfo .= "• {$space->name} ({$typeLabel}) - {$floor} - {$price}\n";
                }
                $dynamicInfo .= "→ Réserver un espace : /candidatures → section résident\n\n";
            }
        }
        
        return $dynamicInfo;
    }
}