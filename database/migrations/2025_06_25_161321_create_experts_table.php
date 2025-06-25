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
            $table->string('phone');
            $table->string('organization')->nullable();
            $table->json('specialties');
            $table->string('specialty_other')->nullable();
            $table->json('training_types');
            $table->json('training_details')->nullable();
            $table->json('target_audience');
            $table->json('intervention_frequency');
            $table->string('intervention_other')->nullable();
            $table->json('preferred_days');
            $table->json('preferred_times');
            $table->text('remarks')->nullable();
            $table->string('cv_path')->nullable();
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
