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
        // Étape 1 : Créer une nouvelle table
        Schema::create('resident_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('facility');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('purpose');
            $table->string('status')->default('confirmed');
            $table->timestamps();
            $table->softDeletes();
        });

        // Étape 2 : Supprimer l'ancienne table
        Schema::dropIfExists('bookings');

        // Étape 3 : Renommer la nouvelle table
        Schema::rename('resident_bookings', 'bookings');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Étape 1 : Créer une nouvelle table avec l'ancienne structure
        Schema::create('old_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->string('phone');
            $table->date('date');
            $table->string('time');
            $table->string('purpose');
            $table->json('spaces');
            $table->text('message')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
            $table->softDeletes();
        });

        // Étape 2 : Supprimer la nouvelle table
        Schema::dropIfExists('bookings');

        // Étape 3 : Renommer l'ancienne table
        Schema::rename('old_bookings', 'bookings');
    }
};
