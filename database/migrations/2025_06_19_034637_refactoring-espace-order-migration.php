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
            $table->foreignId('espace_id')->constrained('espaces')->onDelete('restrict');
            $table->dropColumn('reference');
            $table->dropColumn('status')->default('pending');
            $table->renameColumn('total', 'total_amount');
            $table->dropColumn('notes');
            $table->dropColumn('payment_method');
            $table->dropColumn('started_at');
            $table->dropColumn('ended_at');
            $table->dropColumn('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('espace_order_items', function (Blueprint $table) {
            $table->dropForeign(['espace_id']);
            $table->dropColumn('espace_id');
            $table->string('reference')->nullable();
            $table->string('status')->default('pending');
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->text('notes')->nullable();
            $table->string('payment_method')->nullable();
            $table->dateTime('started_at')->nullable();
            $table->dateTime('ended_at')->nullable();
            $table->string('type')->nullable();
        });
    }
};
