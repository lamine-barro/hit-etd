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
        Schema::create('espace_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('espace_id')->constrained('espaces')->onDelete('restrict');
            $table->foreignId('espace_order_id')->constrained('espace_orders')->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->decimal('price', 10, 2);
            $table->decimal('total_amount', 10, 2);
            $table->integer('number_of_people')->default(1);
            $table->timestamp('started_at')->nullable();
            $table->timestamp('ended_at')->nullable();
            $table->string('status', 20)->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['started_at', 'ended_at'], 'idx_espace_order_items_started_ended_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('espace_order_items');
    }
}; 