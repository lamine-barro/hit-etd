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
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('whatsapp')->nullable();
            $table->string('position');
            $table->string('organization');
            $table->string('country');
            $table->enum('actor_type', [
                'startup',
                'etudiant',
                'chercheur',
                'investisseur',
                'media',
                'corporate',
                'service_public',
                'structure_accompagnement',
                'autre'
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_registrations');
    }
};
