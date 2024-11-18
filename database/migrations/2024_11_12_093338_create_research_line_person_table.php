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
        Schema::create('research_line_person', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('research_line_id');

            $table->foreign('research_line_id')
                ->references('id')->on('research_lines')
                ->onDelete('cascade');


            $table->unsignedBigInteger('person_id');

            $table->foreign('person_id')
                ->references('id')->on('people')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('research_line_person');
    }
};
