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
        Schema::create('documents', function (Blueprint $table) {
            $table->ulid('document_id')->primary();
            $table->ulid('user_id');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->string('file_name' )->comment('stored file name');
            $table->string('file_path')->comment('S3/cloud path');
            $table->string('file_url')->comment('full URL to access the file');
            $table->enum('type', ['resume', 'cover_letter', 'portfolio', 'certificate', 'other'])->default('other');
            $table->string('mime_type')->comment('application/pdf, image/png, etc.');
            $table->bigInteger('file_size')->comment('in bytes');
            $table->boolean('is_primary')->default(0)->comment('indicates if this is the primary document of its type for the user');
            $table->json('parsed_data')->nullable()->comment('extracted text or metadata from the document');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
