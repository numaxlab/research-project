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
        Schema::create('research_lines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->json('short_description')->nullable();
            $table->json('long_description')->nullable();
            $table->timestamps();
            $table->json('slug');
            $table->boolean('is_public');
            $table->integer('parent_id')->nullable()->default(0);
            $table->integer('lft')->default(0);
            $table->integer('rgt')->default(0);
            $table->integer('depth')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('research_lines');
    }
};
