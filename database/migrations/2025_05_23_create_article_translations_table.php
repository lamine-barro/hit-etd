<?php

use App\Enums\LanguageEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('article_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->constrained()->onDelete('cascade');
            $table->string('locale')->index();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->text('content');
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('og_type')->default('article')->nullable();
            $table->integer('reading_time')->nullable();

            // Clé unique pour éviter les doublons de traduction pour un même article
            $table->unique(['article_id', 'locale']);

            $table->timestamps();
        });

        // Modifier la table articles pour déplacer les champs traduits
        Schema::table('articles', function (Blueprint $table) {
            // Supprimer les colonnes qui seront déplacées vers la table de traductions
            // Nous gardons ces colonnes pour la langue par défaut
            // $table->dropColumn(['title', 'slug', 'excerpt', 'content', 'reading_time']);

            // Ajouter une colonne pour la langue par défaut
            $table->string('default_locale')->default(LanguageEnum::FRENCH->value)->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Restaurer les colonnes dans la table articles si nécessaire
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('default_locale');
        });

        Schema::dropIfExists('article_translations');
    }
};
