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
        Schema::create('research_projects', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->json('introduction');
            $table->string('main_image')->nullable();
            $table->json('long_description');
            $table->date('init_date')->nullable();
            $table->date('final_date')->nullable();
            $table->json('financiers')->nullable();
            $table->decimal('amount')->nullable();
            $table->json('documents')->nullable();
            $table->json('videos')->nullable();
            $table->json('images')->nullable();
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
        Schema::dropIfExists('research_projects');
    }
};
