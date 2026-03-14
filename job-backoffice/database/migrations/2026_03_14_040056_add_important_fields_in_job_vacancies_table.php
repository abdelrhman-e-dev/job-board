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
      $table->string('education')->nullable()->after('level');
      $table->integer('experience_years')->nullable()->after('education');
      $table->boolean('is_featured')->default(false)->after('experience_years');
      $table->ulid('approved_by')->nullable()->after('is_featured');
      $table->timestamp('approved_at')->nullable()->after('approved_by');
      $table->foreign('approved_by')->references('user_id')->on('users')->onDelete('cascade');
      $table->integer('flags_count')->default(0)->after('approved_at');
      $table->enum('visibility', ['public', 'private', 'members_only', 'unlisted'])->default('public')->after('flags_count');
      $table->timestamp('boost_expires_at')->nullable()->after('visibility');
      $table->enum('source', ['manual', 'api', 'scraped', 'imported'])->default('manual')->after('boost_expires_at');
      $table->string('external_url')->nullable()->after('source');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('job_vacancies', function (Blueprint $table) {
      $table->dropColumn(['education', 'experience_years', 'is_featured', 'approved_by', 'approved_at', 'flags_count', 'visibility', 'boost_expires_at', 'source', 'external_url']);
      $table->dropForeign(['approved_by']);
    });
  }
};
