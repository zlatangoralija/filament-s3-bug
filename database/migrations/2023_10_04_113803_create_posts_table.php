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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('id')->on('post_types');
            $table->string('title');
            $table->text('description');
            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->string('city');
            $table->string('address');
            $table->string('zip_code');
            $table->double('latitude');
            $table->double('longitude');
            $table->boolean('active')->default(1);
            $table->integer('status');
            $table->double('price');
            $table->boolean('price_negotiable')->default(0);
            $table->json('attributes')->nullable();
            $table->date('available_from')->nullable();
            $table->date('available_until')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->timestamp('last_renewed_on')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
