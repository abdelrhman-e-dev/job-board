<?php

namespace App\Models;


use Carbon\Carbon;
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
    'is_read',
    'read_at',
    'deleted_at',
    'created_at',
    'updated_at',
  ];
  protected $casts = [
    'status_history' => 'array',
  ];
  // relation between Application and user (job seeker)
  public function jobSeeker()
  {
    return $this->belongsTo(User::class, 'job_seeker_id', 'user_id');
  }
  // relation between Application and comapny 
  public function company()
  {
    return $this->belongsTo(Company::class, 'company_id', 'company_id');
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
  // relation with interviews
  public function interviews()
  {
    return $this->hasMany(Interview::class, 'application_id', 'application_id');
  }
  // relation with offers
  public function offers()
  {
    return $this->hasMany(Offer::class, 'application_id', 'application_id');
  }
  // get the date when application reached a specific status
  public function getStatusDate(string $status): ?Carbon
  {
    $history = collect($this->status_history);

    $entry = $history->firstWhere('status', $status);

    return $entry ? Carbon::parse($entry['changed_at']) : null;
  }
  // get current status (last entry)
  public function getCurrentStatus(): string
  {
    return $this->status;
  }

  // get who hired (changed_by when status became hired)
  public function getHiredBy(): ?string
  {
    $history = collect($this->status_history);

    $entry = $history->firstWhere('status', 'hired');

    return $entry['changed_by'] ?? null;
  }

  public const STATUS_OPTIONS = [
    'new' => 'New',
    'reviewing' => 'Reviewing',
    'shortlisted' => 'Shortlisted',
    'interview' => 'Interview',
    'offer' => 'Offer',
    'hired' => 'Hired',
    'rejected' => 'Rejected',
    'withdraw' => 'Withdraw',
  ];
}
