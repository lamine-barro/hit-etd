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
            $table->string('name')->nullable()->change();
            $table->string('phone')->nullable()->change();
            $table->string('profile_picture')->nullable()->change();
            $table->boolean('is_active')->default(true)->change();
            $table->string('category')->nullable()->change();
            $table->text('lock_raison')->nullable()->change();
            $table->boolean('is_verified')->default(false)->change();
            $table->dropColumn('last_name');
            $table->renameColumn('first_name', 'responsible_name');
            $table->renameColumn('phone_number', 'responsible_phone');
            $table->string('responsible_document_type')->nullable();
            $table->string('responsible_document_value')->nullable();
            $table->string('responsible_document_file')->nullable();
            $table->jsonb('documents')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
