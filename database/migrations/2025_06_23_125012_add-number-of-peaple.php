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
        Schema::table('espaces', function (Blueprint $table) {
            $table->integer('number_of_people')->default(1);
        });
        Schema::table('espace_order_items', function (Blueprint $table) {
            $table->integer('number_of_people')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('espaces', function (Blueprint $table) {
            $table->dropColumn('number_of_people');
        });
        Schema::table('espace_order_items', function (Blueprint $table) {
            $table->dropColumn('number_of_people');
        });
    }
};
