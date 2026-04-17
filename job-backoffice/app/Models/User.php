<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements FilamentUser, MustVerifyEmail
{
  /** @use HasFactory<\Database\Factories\UserFactory> */
  use HasFactory, Notifiable, HasUlids, SoftDeletes;

  protected $table = 'users';
  protected $primaryKey = 'user_id';
  protected $keyType = 'string';
  public $incrementing = false;
  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
   */
  protected $fillable = [
    'first_name',
    'last_name',
    'email',
    'password',
    'role',
    'company_id',
    'phone',
    'avatar',
    'bio',
    'city',
    'country',
    'settings',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var list<string>
   */
  // defined dates in table
  protected $dates = [
    'deleted_at',
  ];
  protected $hidden = [
    'password',
    'remember_token',
  ];


  /**
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected $casts = [

    'email_verified_at' => 'datetime',
    'password' => 'hashed',
    'deleted_at' => 'datetime',
  ];

  // implementing FilamentUser interface

  public function canAccessPanel(Panel $panel): bool
  {
    return $this->role->role_name === 'system-admin' && $this->role->active;
  }
  /**
   * Check if user has any of the given roles
   *
   * @param array<string> $roles
   * @return bool
   */
  protected $appends = ['name'];
  public function getNameAttribute(): string
  {
    return trim("{$this->first_name} {$this->last_name}") ?: $this->email;
  }
  // custom column to show full name
  public function getFullNameAttribute()
  {
    return "{$this->first_name} {$this->last_name}";
  }
  // relation between User and Company

  public function company()
  {
    return $this->belongsTo(Company::class, 'company_id', 'company_id');
  }
  public function application()
  {
    return $this->hasManyThrough(Application::class, JobVacancy::class, 'company_id', 'job_id', 'user_id', 'job_id');
  }

  public function applications()
  {
    return $this->hasMany(Application::class, 'job_seeker_id', 'user_id');
  }

  public function hasEmailAuthentication()
  {
    return $this->email_verified_at ? 1 : 0;
  }
  public function documents()
  {
    return $this->hasMany(Document::class, 'user_id', 'user_id');
  }
  // role relation
  public function role()
  {
    return $this->belongsTo(Role::class, 'role_id', 'role_id');
  }
  public function jobs()
  {
    return $this->hasMany(JobVacancy::class, 'company_id', 'company_id');
  }

  // interviews
  public function interviewers()
  {
    return $this->hasMany(Interview::class, 'interviewer_id', 'user_id');
  }
  public function interviews_created_by()
  {
    return $this->hasMany(Interview::class, 'created_by', 'user_id');
  }
  public function interviews_updated_by()
  {
    return $this->hasMany(Interview::class, 'updated_by', 'user_id');
  }

  // offers
  public function offers_created_by()
  {
    return $this->hasMany(Offer::class, 'created_by', 'user_id');
  }
  public function offers_updated_by()
  {
    return $this->hasMany(Offer::class, 'updated_by', 'user_id');
  }
  public static function getOwners()
  {
    return User::where('role_id', "019c57a6-0950-72a0-9941-f0d810d21bf3");
  }

  // company owner
  public function companyOwner()
  {
    return $this->belongsTo(Role::class, 'role_id', 'role_id');
  }

  // admins 
  public static function admins()
  {
    return User::where('role_id', "019c57a2-dc2e-72e0-90fe-c4caddb33907");
  }
  // get the high board of the company (onwers, hiring manager and recruiters) based on the company id which be provided 
  public static function highBoard($company_id)
  {
    return User::whereIn('role_id', ["019c57a6-0950-72a0-9941-f0d810d21bf3", "019c57ad-a219-7124-a4eb-942f9d7e2274", "019c57ad-c8e9-71d0-ada9-eacffd659479" ,"019c57a2-dc2e-72e0-90fe-c4caddb33907"])->where('company_id', $company_id);
  }
}
