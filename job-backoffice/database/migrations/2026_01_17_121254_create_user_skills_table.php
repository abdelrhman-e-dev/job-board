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
    Schema::create('user_skills', function (Blueprint $table) {
    $table->ulid('user_skill_id')->primary();
    $table->ulid('user_id');
    $table->ulid('skill_id');
    $table->foreign('user_id')
    ->references('user_id')
    ->on('users')
    ->onDelete('cascade');
    $table->foreign('skill_id')
    ->references('skill_id')
    ->on('skills')
    ->onDelete('cascade');
    $table->unique(['user_id', 'skill_id']);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('user_skills');
  }
};
