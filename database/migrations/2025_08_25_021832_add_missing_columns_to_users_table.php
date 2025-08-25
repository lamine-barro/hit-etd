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
        Schema::table('users', function (Blueprint $table) {
            $table->string('profession')->nullable()->after('category');
            $table->string('organization')->nullable()->after('profession');
            $table->string('city')->nullable()->after('organization');
            $table->text('bio')->nullable()->after('city');
            $table->text('startup_description')->nullable()->after('bio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['profession', 'organization', 'city', 'bio', 'startup_description']);
        });
    }
};
