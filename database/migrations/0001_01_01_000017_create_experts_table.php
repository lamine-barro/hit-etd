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
        Schema::create('experts', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email');
            $table->string('profile_picture')->nullable();
            $table->string('phone');
            $table->string('organization')->nullable();
            $table->string('position')->nullable();
            $table->string('linkedin')->nullable();
            $table->json('specialties');
            $table->string('specialty_other')->nullable();
            $table->json('training_types');
            $table->json('pedagogical_methods')->nullable();
            $table->json('target_audiences')->nullable();
            $table->json('intervention_frequencies')->nullable();
            $table->json('preferred_days_detailed')->nullable();
            $table->json('time_slots')->nullable();
            $table->string('cv_path')->nullable();
            $table->string('status')->default('pending');
            $table->text('admin_notes')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experts');
    }
}; 