<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class RolePermission extends Pivot
{
  public $incrementing = true;
  protected $table = "role_permissions";
  protected $primaryKey = "role_permission_id";
  protected $fillable = [
    'role_id',
    'permission_id',
  ];

  // relationship
  public function role()
  {
    return $this->belongsTo(Role::class, 'role_id');
  }

  public function permission()
  {
    return $this->belongsTo(Permission::class, 'permission_id');
  }
}
