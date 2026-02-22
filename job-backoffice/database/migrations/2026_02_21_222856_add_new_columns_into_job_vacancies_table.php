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
    Schema::table('job_vacancies', function (Blueprint $table) {
      $table->ulid('closed_by')->nullable();
      $table->foreign('closed_by')->references('user_id')->on('users')->nullOnDelete();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('job_vacancies', function (Blueprint $table) {
      $table->dropForeign(['closed_by']);
      $table->dropColumn('closed_by');
    });
  }
};
