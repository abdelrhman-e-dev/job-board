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
    Schema::create('interviews', function (Blueprint $table) {
      $table->ulid('interview_id')->primary();
      $table->ulid('application_id')->index();
      $table->ulid('interviewer_id')->index();
      $table->ulid('job_id')->index();
      $table->timestamp('scheduled_at')->nullable();
      $table->timestamp('completed_at')->nullable();
      $table->enum('interview_type', ['phone', 'onsite', 'technical'])->default('phone');
      $table->decimal('score', 5, 2)->nullable();
      $table->text('feedback')->nullable();
      $table->enum('result', ['pending', 'pass', 'fail', 'no_show'])->default('pending');
      $table->ulid('created_by')->index();
      $table->ulid('updated_by')->index();
      $table->softDeletes();
      $table->timestamps();

      $table->foreign('application_id')->references('application_id')->on('applications')->onDelete('cascade');
      $table->foreign('interviewer_id')->references('user_id')->on('users')->onDelete('cascade');
      $table->foreign('job_id')->references('job_id')->on('job_vacancies')->onDelete('cascade');
      $table->foreign('created_by')->references('user_id')->on('users')->onDelete('cascade');
      $table->foreign('updated_by')->references('user_id')->on('users')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('interviews');
  }
};
