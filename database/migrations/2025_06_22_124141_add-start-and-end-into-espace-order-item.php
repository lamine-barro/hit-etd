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
        Schema::table('espace_order_items', function (Blueprint $table) {
            $table->timestamp('started_at')->nullable();
            $table->timestamp('ended_at')->nullable();
            $table->index(['started_at', 'ended_at'], 'idx_espace_order_items_started_ended_at');
            $table->string('status', 20)->default('pending');
            $table->text('notes');
        });
        Schema::table('espace_orders', function (Blueprint $table) {
            $table->timestamp('started_at')->nullable()->change();
            $table->timestamp('ended_at')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('espace_order_items', function (Blueprint $table) {
            $table->dropColumn(['started_at', 'ended_at', 'status', 'notes']);
            $table->dropIndex('idx_espace_order_items_started_ended_at');
        });
        Schema::table('espace_orders', function (Blueprint $table) {
            $table->timestamp('started_at')->nullable(false)->change();
            $table->timestamp('ended_at')->nullable(false)->change();
        });
    }
};
