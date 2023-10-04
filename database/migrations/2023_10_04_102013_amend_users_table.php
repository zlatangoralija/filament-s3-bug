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
            $table->uuid('id')->change();
            $table->renameColumn('name', 'first_name');
            $table->string('last_name');
            $table->string('phone');
            $table->string('company')->nullable();
            $table->string('preferred_language')->default('en');
            $table->boolean('privacy');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->id('id')->change();
            $table->renameColumn('first_name', 'name');
            $table->dropColumn('last_name');
            $table->dropColumn('phone');
            $table->dropColumn('company');
            $table->dropColumn('preferred_language');
            $table->dropColumn('privacy');
        });
    }
};
