<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  use HasFactory, HasUuids;
  protected $table = 'roles';
  protected $primaryKey = 'role_id';
  protected $keyType = 'string';
  public $incrementing = false;
  protected $fillable = [
    'role_name',
  ];
  // get roles 
  public static function getRoles()
  {
    return self::all();
  }
  // relationship
  public function permissions()
  {
    return $this->belongsToMany(Permission::class, 'role_permissions', 'role_id', 'permission_id')
      ->withTimestamps()
      ->using(RolePermission::class);
  }

  // relation between users
  public function user()
  {
    return $this->hasMany(User::class, 'role_id', 'role_id');
  }
}
