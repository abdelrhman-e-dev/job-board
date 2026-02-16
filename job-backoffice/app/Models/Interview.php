<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;


class Interview extends Model
{
  use HasFactory, HasUlids, SoftDeletes;
  protected $table = 'interviews';
  protected $primaryKey = 'interview_id';
  protected $keyType = 'string';
  public $incrementing = false;
  protected $fillable = [
    'application_id',
    'interviewer_id',
    'job_id',
    'scheduled_at',
    'completed_at',
    'interview_type',
    'score',
    'feedback',
    'result',
    'created_by',
    'updated_by',
    'deleted_at'
  ];
  protected $dates = [
    'deleted_at',
  ];
  protected $casts = [
    'deleted_at' => 'datetime',
  ];

  // relations
  /**
   * applications
   * interviewers
   * jobs
   * created_by
   * updated_by
   */
  public function applications()
  {
    return $this->belongsTo(Application::class, 'application_id', 'application_id');
  }
  public function interviewers()
  {
    return $this->belongsTo(User::class, 'interviewer_id', 'user_id');
  }
  public function created_by()
  {
    return $this->belongsTo(User::class, 'created_by', 'user_id');
  }
  public function updated_by()
  {
    return $this->belongsTo(User::class, 'updated_by', 'user_id');
  }
  public function jobs()
  {
    return $this->belongsTo(JobVacancy::class, 'job_id', 'job_id');
  }
}
