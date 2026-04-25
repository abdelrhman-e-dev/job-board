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
    Schema::table('applications', function (Blueprint $table) {
      $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
      $table->boolean('is_flagged')->default(0);

    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('applications', function (Blueprint $table) {
      $table->dropColumn(['priority', 'is_flagged']);
    });
  }
};
