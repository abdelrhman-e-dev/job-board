<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table("companies", function (Blueprint $table) {
          $table->enum('status' , ['pending','approved','rejected','suspended'])->default('pending');
          $table->text('rejection_reason')->nullable();
          $table->timestamp('approved_at')->nullable();
          $table->timestamp('rejected_at')->nullable();
          $table->timestamp('suspended_at')->nullable();
          $table->string('specialization')->nullable();
          $table->string('banner')->nullable();
          $table->string('address')->nullable();
          $table->string('city')->nullable();
          $table->string('country')->nullable();
          $table->string('contact_phone')->nullable();
          $table->string('contact_email')->nullable();
          $table->json('social_links')->nullable();
          $table->integer('job_posting_limit')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("companies", function (Blueprint $table) {
          $table->dropColumn('status');
          $table->dropColumn('rejection_reason');
          $table->dropColumn('approved_at');
          $table->dropColumn('rejected_at');
          $table->dropColumn('suspended_at');
          $table->dropColumn('specialization');
          $table->dropColumn('banner');
          $table->dropColumn('address');
          $table->dropColumn('city');
          $table->dropColumn('country');
          $table->dropColumn('contact_phone');
          $table->dropColumn('contact_email');
          $table->dropColumn('social_links');
          $table->dropColumn('job_posting_limit');
          $table->dropColumn('location');
          $table->dropColumn('verified');
        });
    }
};
