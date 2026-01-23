<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory, HasUlids, SoftDeletes;

    protected $table = 'applications';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'application_id';
    protected $fillable = [
        'job_id',
        'job_seeker_id',
        'document_id',
        'aiGeneratedScore',
        'ai_feedback',
        'cover_letter',
        'screening_questions',
        'status',
        'rating',
        'status_history',
    ];

    // relation between Application and user (job seeker)
    public function jobSeeker()
    {
        return $this->belongsTo(User::class, 'job_seeker_id', 'user_id');
    }
    // relation between Application and Job
    public function job()
    {
        return $this->belongsTo(JobVacancy::class, 'job_id', 'job_id');
    }
    // relation between Application and Document
    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id', 'document_id'); 
    }
    // relation between Application and reviews
    public function reviews()
    {
        return $this->hasMany(ApplicationReview::class, 'application_id', 'application_id');
    }
    // relation between Application and massages
    public function messages()
    {
        return $this->hasMany(Message::class, 'application_id', 'application_id');
    }
}
