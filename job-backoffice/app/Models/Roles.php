<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roles extends Model
{
  use HasFactory, HasUuids, SoftDeletes;
  protected $table = 'roles';
  protected $primaryKey = 'role_id';
  protected $keyType = 'string';
  public $incrementing = false;
  protected $fillable = [
    'role_name',
  ];
  protected $dates = [
    'deleted_at',
  ];
  // relationship
  public function permissions()
  {
    return $this->belongsToMany(Permissions::class, 'role_permissions', 'role_id', 'permission_id')
      ->withTimestamps()
      ->using(RolePermission::class);
  }
}
