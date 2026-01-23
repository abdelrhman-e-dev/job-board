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
        Schema::create('applications', function (Blueprint $table) {
            $table->ulid('application_id')->primary();
            $table->ulid('job_id');
            $table->foreign('job_id')->references('job_id')->on('job_vacancies')->onDelete('cascade');
            $table->ulid('job_seeker_id');
            $table->foreign('job_seeker_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->ulid('document_id');
            $table->foreign('document_id')->references('document_id')->on('documents')->onDelete('cascade');
            $table->text('cover_letter')->nullable();
            $table->json('screening_questions')->nullable();
            $table->enum('status', ['new', 'reviewing' , 'shortlisted' , 'interview' , 'offer' , 'hired' , 'rejected' , 'withdraw'])->default('new');
            $table->unsignedTinyInteger('rating')->nullable()->comment('rating out of 5 given by the employer');
            $table->json('status_history')->nullable()->comment('tracks status changes with timestamps');
            $table->boolean('is_read')->default(false)->comment('indicates if the application has been viewed by the employer');
            $table->timestamp('read_at')->nullable()->comment('timestamp when the application was first viewed');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
