<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Exécute les migrations.
     */
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            // Suppression des colonnes qui sont maintenant gérées par les traductions
            $table->dropColumn([
                'title',
                'slug',
                'description',
                'location',
            ]);
        });
    }

    /**
     * Annule les migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            // Restauration des colonnes en cas de rollback
            $table->string('title')->after('type');
            $table->string('slug')->unique()->after('id');
            $table->text('description')->after('title');
            $table->string('location')->after('end_date');
        });
    }
};
