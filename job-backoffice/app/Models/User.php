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
  use HasFactory, Notifiable, HasUlids, SoftDeletes, Notifiable;

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
    return $this->role === 'system-admin';
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
}
