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
        Schema::create('job_skills', function (Blueprint $table) {
            $table->ulid('job_skill_id')->primary();
            $table->ulid('job_id');
            $table->ulid('skill_id');
            $table->boolean('is_required')->default(false);
            $table->foreign('job_id')->references('job_id')->on('job_vacancies')->onDelete('cascade');
            $table->foreign('skill_id')->references('skill_id')->on('skills')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_skills');
    }
};
