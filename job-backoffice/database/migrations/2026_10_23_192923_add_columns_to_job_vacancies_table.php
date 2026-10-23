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
      $table->char('blocked_by', 26)->nullable()->after('closed_by');
      $table->timestamp('blocked_at')->nullable()->after('blocked_by');
      $table->text('block_note')->nullable()->after('blocked_at');
      $table->boolean('block_is_final')->default(false)->after('block_note');
      $table->timestamp('resubmitted_at')->nullable()->after('block_is_final');
      $table->enum('status_before_block', ['active', 'closed', 'archive'])
        ->nullable()->after('resubmitted_at');
      $table->foreign('blocked_by')
        ->references('user_id')->on('users')
        ->nullOnDelete()->cascadeOnUpdate();

    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('job_vacancies', function (Blueprint $table) {
      //
    });
  }
};
