<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
  use HasFactory, HasUuids, SoftDeletes;
  protected $table = 'permissions';
  protected $primaryKey = 'permission_id';
  protected $keyType = 'string';
  public $incrementing = false;
  protected $fillable = [
    'permission_name',
    'visibility',
    'group',
    'description'
  ];

  // relationship
  public function roles()
  {
    return $this->belongsToMany(Role::class, 'role_permissions', 'permission_id', 'role_id')
      ->withTimestamps()
      ->using(RolePermission::class);
  }

  // scope
  public function scopeSystemOnly($query)
  {
    return $query->where('visibility', 'system_only');
  }

  public function scopeCompanyAvailable($query)
  {
    return $query->where('visibility', 'company_available');
  }
  public static function getPermissions()
  {
    return self::all();
  }
  public static function getGroups()
  {
    return self::all()->pluck('group')->unique()->toArray();
  }
  public static function getVisibilities()
  {
    return self::all()->pluck('visibility')->unique()->toArray();
  }
}