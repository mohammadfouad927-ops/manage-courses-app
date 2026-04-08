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
        Schema::create('training_programs_courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trainingProgram_id');
            $table->unsignedBigInteger('course_id');
            $table->timestamps();

            $table->foreign('trainingProgram_id')->references('id')->on('training_programs');
            $table->foreign('course_id')->references('id')->on('courses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_programs_courses');
    }
};
