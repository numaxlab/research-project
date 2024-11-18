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
        Schema::create('research_project_person', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('project_id');

            $table->foreign('project_id')
                ->references('id')->on('research_projects')
                ->onDelete('cascade');
            $table->unsignedBigInteger('person_id');

            $table->foreign('person_id')
                ->references('id')->on('people')
                ->onDelete('cascade');

            $table->string('rol')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('research_project_person');
    }
};
