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
    Schema::table('interviews', function (Blueprint $table) {
      $table->enum('interview_stage', ['screening', 'hr', 'technical', 'panel', 'final', 'offer_discussion'])->default('screening');
      $table->tinyInteger('interview_round')->default(1);
      $table->string('location')->nullable();
      $table->text('meeting_link')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('interviews', function (Blueprint $table) {
      $table->dropColumn(['interview_stage', 'interview_round', 'location', 'meeting_link', 'scheduled_at', 'completed_at']);
    });
  }
};
