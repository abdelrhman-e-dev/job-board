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
        Schema::create('document_reviews', function (Blueprint $table) {
            $table->ulid('document_review_id')->primary();
            $table->ulid('document_id');
            $table->foreign('document_id')->references('document_id')->on('documents')->onDelete('cascade');
            $table->unsignedTinyInteger('overall_score')->comment('0-100 overall score of the document');
            $table->json('scores')->comment('formatting,content, keywords,structure');
            $table->json('strengths')->nullable()->comment('array of strengths identified in the document');
            $table->json('weaknesses')->nullable()->comment('array of weaknesses identified in the document');
            $table->json('suggestions')->nullable()->comment('array of suggestions for improvement');
            $table->json('keywords_analysis')->nullable()->comment('analysis of keywords relevant to job descriptions');
            $table->boolean('ats_compatibility')->default(false)->comment('indicates if document is ATS compatible');
            $table->enum('status', ['analyzing', 'completed', 'failed'])->default('analyzing')->comment('review status');
            $table->string('ai_model_version')->nullable()->comment('version of AI model used for review');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_reviews');
    }
};
