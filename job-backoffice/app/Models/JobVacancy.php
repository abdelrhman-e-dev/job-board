<?php

namespace App\Models;

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
    'posted_by',
    'category_id',
    'title',
    'slug',
    'description',
    'requirements',
    'type',
    'level',
    'location',
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
  ];
  protected $dates = [
    'deadline' => 'datetime',
    'published_at' => 'datetime',
    'deleted_at' => 'datetime',
  ];
  protected $casts = [

    'screening_questions' => 'array',
    'deadline' => 'datetime',
    'published_at' => 'datetime',
    'deleted_at' => 'datetime',

  ];
  // relation between Job and User (posted_by)
  public function user()
  {
    return $this->belongsTo(User::class, 'posted_by', 'user_id');
  }
  // relation between Job and applications
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
    return $this->hasMany(JobSkill::class, 'job_id', 'job_skill_id');
  }
  // relation between job and job category
  public function jobCategory()
  {
    return $this->belongsTo(JobCategory::class, 'category_id', 'category_id');
  }
}
