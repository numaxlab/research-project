<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->json('function')->nullable();

            $table->string('photo_path')->nullable();
            $table->string('email')->nullable();
            $table->json('web_profiles')->nullable();
            $table->json('biography')->nullable();
            $table->string('cv_file')->nullable();
            $table->unsignedBigInteger('category_id');

            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->onDelete('cascade');
            $table->json('slug');
            $table->boolean('is_public');
            $table->integer('parent_id')->nullable()->default(0);
            $table->integer('lft')->default(0);
            $table->integer('rgt')->default(0);
            $table->integer('depth')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
