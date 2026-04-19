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
      $table->string('cancelled_at')->nullable()->after('feedback');
      $table->text('cancellation_reason')->nullable()->after('cancelled_at');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('interviews', function (Blueprint $table) {
      $table->dropColumn('cancelled_at');
      $table->dropColumn('cancellation_reason');
    });
  }
};
