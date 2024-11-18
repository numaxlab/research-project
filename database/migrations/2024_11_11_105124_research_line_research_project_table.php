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
        Schema::create('research_line_research_project', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('project_id');

            $table->foreign('project_id')
                ->references('id')->on('research_projects')
                ->onDelete('cascade');
            $table->unsignedBigInteger('research_line_id');

            $table->foreign('research_line_id')
                ->references('id')->on('research_lines')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('research_line_research_project');
    }
};
