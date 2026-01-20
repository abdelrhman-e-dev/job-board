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
    Schema::create('job_vacancies', function (Blueprint $table) {
      $table->ulid('job_id')->primary();
      $table->ulid('company_id');
      $table->ulid('category_id')->nullable();
      $table->ulid('posted_by');
      $table->foreign('company_id')->references('company_id')->on('companies')->onDelete('cascade');
      $table->foreign('category_id')->references('category_id')->on('job_categories')->onDelete('set null');
      $table->foreign('posted_by')->references('user_id')->on('users')->onDelete('cascade');
      $table->string('title');
      $table->string('slug')->unique();
      $table->text('description');
      $table->text('requirements');
      $table->enum('type', ['full-time', 'part-time', 'contract', 'internship' , 'remote' ,'hybrid']);
      $table->enum('level',['entry', 'mid', 'senior', 'lead', 'manager']);
      $table->string('location');
      $table->decimal('salary_min', 10, 2)->nullable();
      $table->decimal('salary_max', 10, 2)->nullable();
      $table->string('salary_currency', 3)->nullable();
      $table->json('screening_questions')->nullable();
      $table->enum('status', ['draft', 'active','closed', 'expired'])->default('draft');
      $table->integer('views_count')->default(0);
      $table->integer('applications_count')->default(0);
      $table->timestamp('deadline')->nullable();
      $table->timestamp('published_at')->nullable();
      $table->softDeletes();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('jobs');
  }
};
