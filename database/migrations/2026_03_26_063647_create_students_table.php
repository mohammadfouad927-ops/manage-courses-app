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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('nameEn',255);
            $table->string('nameAr',255);
            $table->string('email');
            $table->date('birthDate');
            $table->string('governorate');
            $table->string('NationalId',28);
            $table->string('photoPath')->nullable();
            $table->string('phoneNumber',11);
            $table->boolean('studentStatus');
            $table->string('school');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
