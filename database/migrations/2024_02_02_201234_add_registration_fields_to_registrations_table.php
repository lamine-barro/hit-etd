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
        Schema::table('registrations', function (Blueprint $table) {
            if (! Schema::hasColumn('registrations', 'name')) {
                $table->string('name')->after('id');
            }
            if (! Schema::hasColumn('registrations', 'email')) {
                $table->string('email')->after('name');
            }
            if (! Schema::hasColumn('registrations', 'whatsapp')) {
                $table->string('whatsapp')->nullable()->after('email');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('EventRegistrations', function (Blueprint $table) {
            $table->dropColumn([
                'name',
                'email',
                'whatsapp',
            ]);
        });
    }
};
