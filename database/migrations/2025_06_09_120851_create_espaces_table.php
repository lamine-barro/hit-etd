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
        Schema::create('espaces', function (Blueprint $table) {
            $table->id();
            $table->string('illustration')->nullable();
            $table->json('images')->nullable();
            $table->string('name');
            $table->string('code');
            $table->string('type');
            $table->integer('price');
            $table->integer('minimum_duration')->default(1); // in hours
            $table->string('floor')->nullable();
            $table->string('location')->nullable();
            $table->string('number_of_rooms')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('espaces');
    }
};
