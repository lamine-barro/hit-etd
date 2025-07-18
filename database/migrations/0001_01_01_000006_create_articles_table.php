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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('default_locale')->default(LanguageEnum::FRENCH->value);
            $table->string('category');
            $table->string('illustration')->nullable();
            $table->json('tags')->nullable();
            $table->boolean('featured')->default(false);
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->dateTime('published_at')->nullable();
            $table->foreignId('author_id')->nullable()->constrained('administrators')->onDelete('set null');
            $table->unsignedInteger('views')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
}; 