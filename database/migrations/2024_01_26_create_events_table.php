<?php

use App\Enums\Currency;
use App\Enums\EventStatus;
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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('default_locale', 10);
            $table->string('slug')->unique();
            $table->string('type');
            $table->string('title');
            $table->text('description');
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->string('location');
            $table->boolean('is_remote')->default(false);
            $table->integer('max_participants');
            $table->dateTime('registration_end_date');
            $table->string('external_link')->nullable();
            $table->boolean('is_paid')->default(false);
            $table->decimal('price', 10, 2)->nullable();
            $table->string('currency')->default(Currency::XOF->value);
            $table->decimal('early_bird_price', 10, 2)->nullable();
            $table->dateTime('early_bird_end_date')->nullable();
            $table->string('illustration')->nullable();
            $table->string('status')->default(EventStatus::DRAFT->value);
            $table->uuid('created_by');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
