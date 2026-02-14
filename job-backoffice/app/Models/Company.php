<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
  use HasFactory, HasUlids, SoftDeletes;
  protected $table = 'companies';
  protected $keyType = 'string';
  public $incrementing = false;
  protected $primaryKey = 'company_id';
    protected $fillable = [
    'owner_id',
    'name',
    'slug',
    'logo',
    'website',
    'description',
    'industry',
    'size',
    'location',
    'founded_year',
    'deleted_at',
    'status',
    'rejection_reason',
    'approved_at',
    'rejected_at',
    'suspended_at',
    'specialization',
    'banner',
    'address',
    'city',
    'country',
    'contact_phone',
    'contact_email',
    'social_links',
    'job_posting_limit',
  ];
  protected $dates = [
    'deleted_at' => 'datetime',
  ];
  protected function cast()
  {
    return [
      'founded_year' => 'date',
      'deleted_at' => 'datetime',
    ];
  }
  // relation between Company and User (owner)
  public function owner()
  {
    return $this->belongsTo(User::class, 'owner_id', 'user_id');
  }
  // relation between Company and User (job seekers)
  public function jobSeekers()
  {
    return $this->hasMany(User::class, 'company_id', 'company_id');
  }
  // relation between Company and Jobs
  public function jobs()
  {
    return $this->hasMany(JobVacancy::class, 'company_id', 'company_id');
  }
  // company users
  public function users()
  {
    return $this->hasMany(User::class, 'company_id', 'company_id');
  }
}
