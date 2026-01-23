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
        Schema::create('application_reviews', function (Blueprint $table) {
            $table->ulid('application_review_id')->primary();
            $table->ulid('application_id');
            $table->foreign('application_id')->references('application_id')->on('applications')->onDelete('cascade');
            $table->ulid('reviewer_id');
            $table->foreign('reviewer_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->unsignedTinyInteger('rating')->comment('rating out of 5 given by the reviewer');
            $table->text('feedback')->nullable()->comment('detailed feedback from the reviewer');
            $table->enum('recommendation', ['hire', 'maybe', 'reject'])->comment('reviewer recommendation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_reviews');
    }
};
