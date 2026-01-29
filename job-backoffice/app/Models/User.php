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

class User extends Authenticatable implements FilamentUser
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
  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
      'deleted_at' => 'datetime',
    ];
  }
  // implementing FilamentUser interface
  public function canAccessPanel(Panel $panel): bool
  {
    return $this->hasAnyRole([
      'system-admin',
      'company-manager',
      'hiring-manager',
      'recruiter',
    ]);
  }

  /**
   * Check if user has any of the given roles
   *
   * @param array<string> $roles
   * @return bool
   */
  public function hasAnyRole(array $roles): bool
  {
    return in_array($this->role, $roles);
  }

  protected $appends = ['name'];
  public function getNameAttribute(): string
  {
    return trim("{$this->first_name} {$this->last_name}") ?: $this->email;
  }
}
