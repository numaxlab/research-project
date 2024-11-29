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
        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->json('description')->nullable();
            $table->json('tech_info')->nullable();
            $table->integer('year')->nullable();
            $table->string('pdf_file')->nullable();
            $table->string('url')->nullable();
            $table->json('slug');
            $table->boolean('is_public');
            $table->integer('parent_id')->nullable()->default(0);
            $table->integer('lft')->default(0);
            $table->integer('rgt')->default(0);
            $table->integer('depth')->default(0);
            $table->string('publication_type');
            $table->unsignedBigInteger('project_id');

            $table->foreign('project_id')
                ->references('id')->on('research_projects')
                ->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publications');
    }
};
