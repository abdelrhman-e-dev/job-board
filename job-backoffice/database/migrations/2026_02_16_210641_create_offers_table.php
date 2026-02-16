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
    Schema::create('offers', function (Blueprint $table) {
      $table->ulid('offer_id')->primary();
      $table->ulid('application_id')->index();
      $table->ulid('job_id')->index();
      $table->decimal('salary', 10, 2)->nullable();
      $table->string('currency', 3)->default('USD');
      $table->date('start_date')->nullable();
      $table->date('end_date')->nullable();
      $table->enum('status', ['draft', 'sent', 'accepted', 'rejected', 'expired'])->default('draft');
      $table->timestamp('sent_at')->nullable();
      $table->timestamp('accepted_at')->nullable();
      $table->timestamp('rejected_at')->nullable();
      $table->timestamp('expires_at')->nullable();
      $table->text('notes')->nullable();
      $table->ulid('created_by')->index();
      $table->ulid('updated_by')->index();
      $table->softDeletes();
      $table->timestamps();

      $table->foreign('application_id')->references('application_id')->on('applications');
      $table->foreign('job_id')->references('job_id')->on('job_vacancies');
      $table->foreign('created_by')->references('user_id')->on('users');
      $table->foreign('updated_by')->references('user_id')->on('users');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('offers');
  }
};
