<?php

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
        Schema::table('articles', function (Blueprint $table) {
            // Supprimer les champs qui sont maintenant gérés dans les traductions
            $table->dropColumn([
                'title',
                'slug',
                'excerpt',
                'content',
                'reading_time',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            // Restaurer les champs supprimés
            $table->string('title')->nullable()->after('default_locale');
            $table->string('slug')->nullable()->unique()->after('title');
            $table->text('excerpt')->nullable()->after('slug');
            $table->text('content')->nullable()->after('excerpt');
            $table->integer('reading_time')->nullable()->after('content');
        });
    }
};
