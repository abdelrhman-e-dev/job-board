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
    Schema::table('offers', function (Blueprint $table) {
      $table->string('department')->nullable();
      $table->string('reporting_to')->nullable();
      $table->string('probation_period')->nullable();
      $table->string('notice_period')->nullable();
      $table->string('working_hours')->nullable();
      $table->string('working_days')->nullable();
      $table->string('offer_letter')->nullable();
      $table->text('negotiation_notes')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('offers', function (Blueprint $table) {
      $table->dropColumn([
        'department',
        'reporting_to',
        'probation_period',
        'notice_period',
        'working_hours',
        'working_days',
        'offer_letter',
        'negotiation_notes',
      ]);
    });
  }
};
