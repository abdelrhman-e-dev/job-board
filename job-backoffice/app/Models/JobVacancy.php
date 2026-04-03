<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobVacancy extends Model
{
  use HasFactory, HasUlids, SoftDeletes;
  protected $table = 'job_vacancies';
  protected $keyType = 'string';
  public $incrementing = false;
  protected $primaryKey = 'job_id';
  protected $fillable = [
    'company_id',
    'category_id',
    'posted_by',
    'closed_by',
    'title',
    'slug',
    'description',
    'requirements',
    'required_documents',
    'type',
    'location',
    'address',
    'city',
    'level',
    'education',
    'experience_years',
    'is_featured',
    'approved_by',
    'approved_at',
    'flags_count',
    'visibility',
    'boost_expires_at',
    'source',
    'external_url',
    'salary_min',
    'salary_max',
    'salary_currency',
    'screening_questions',
    'status',
    'views_count',
    'applications_count',
    'deadline',
    'published_at',
    'deleted_at',
    'created_at',
    'updated_at',
    'closed_at'
  ];
  protected $dates = [
    'deadline' => 'datetime',
    'published_at' => 'datetime',
    'deleted_at' => 'datetime',
  ];
  protected $casts = [

    'screening_questions' => 'array',
    'description' => 'array',
    'requirements' => 'array',
    'required_documents' => 'array',
    'deadline' => 'datetime',
    'published_at' => 'datetime',
    'deleted_at' => 'datetime',

  ];


  // 'full-time','part-time','contract','internship'
  public const TYPE_OPTIONS = [
    'full-time' => 'Full Time',
    'part-time' => 'Part Time',
    'contract' => 'Contract',
    'internship' => 'Internship',
  ];
  // required documents 
  public const REQUIRED_DOCUMENTS_OPTIONS = [
    'cv' => 'CV',
    'cover_letter' => 'Cover Letter',
    'certificate' => 'Certificate',
    'license' => 'License',
  ];
  // 'entry','mid','senior','lead','manager'
  public const LEVEL_OPTIONS = [
    'entry' => 'Entry',
    'mid' => 'Mid',
    'senior' => 'Senior',
    'lead' => 'Lead',
    'manager' => 'Manager',
  ];

  // 'public','private','members_only','unlisted'
  public const VISIBILITY_OPTIONS = [
    'public' => 'Public',
    'private' => 'Private (link only)',
  ];
  public const CURRENCY_OPTIONS = [
    'USD' => 'USD',
    'EUR' => 'EUR',
    'GBP' => 'GBP',
    'EGP' => 'EGP',
    'SAR' => 'SAR',
    'AED' => 'AED',
    'KWD' => 'KWD',
    'QAR' => 'QAR',
  ];
  // 'draft','active','closed','expired','blocked','archive' , 'trashed'
  public const STATUS_OPTIONS_FOR_ADMIN = [
    'draft' => 'Draft',
    'active' => 'Active',
    'closed' => 'Closed',
    'expired' => 'Expired',
    'blocked' => 'Blocked',
    'archive' => 'Archive',
    'trashed' => 'Trashed',
  ];
  public const STATUS_OPTIONS_FOR_COMPANY = [
    'draft' => 'Draft',
    'active' => 'Active',
    'closed' => 'Closed',
    'archive' => 'Archive',
  ];
  public const LOCATION_TYPE_OPTIONS = [
    'remote' => 'Remote',
    'hybrid' => 'Hybrid',
    'onsite' => 'On Site',
  ];
  // relation between Job and User (posted_by)
  public function creator()
  {
    return $this->belongsTo(User::class, 'posted_by', 'user_id');
  }
  public function applications()
  {
    return $this->hasMany(Application::class, 'job_id', 'job_id');
  }
  // relation between Job and Company
  public function company()
  {
    return $this->belongsTo(Company::class, 'company_id', 'company_id');
  }
  // relation between Job and saved jobs
  public function savedJobs()
  {
    return $this->hasMany(SavedJob::class, 'job_id', 'job_id');
  }
  // relation between Job and skills
  public function skills()
  {
    return $this->hasMany(JobSkill::class, 'job_id', 'job_id');
  }
  // relation between job and job category
  public function jobCategory()
  {
    return $this->belongsTo(JobCategory::class, 'category_id', 'category_id');
  }

  // interviews
  public function interviews()
  {
    return $this->hasMany(Interview::class, 'job_id', 'job_id');
  }
  // offers
  public function offers()
  {
    return $this->hasMany(Offer::class, 'job_id', 'job_id');
  }
}
