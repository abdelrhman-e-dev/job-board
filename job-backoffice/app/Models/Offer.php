<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Offer extends Model
{
  use HasFactory, Notifiable, HasUlids, SoftDeletes;
  protected $table = 'offers';
  protected $primaryKey = 'offer_id';
  protected $keyType = 'string';
  public $incrementing = false;
  protected $fillable = [
    'application_id',
    'job_id',
    'salary',
    'currency',
    'start_date',
    'end_date',
    'status',
    'sent_at',
    'accepted_at',
    'rejected_at',
    'expires_at',
    'notes',
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
   * jobs
   * created_by
   * updated_by
   */
  public function applications()
  {
    return $this->belongsTo(Application::class, 'application_id', 'application_id');
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
