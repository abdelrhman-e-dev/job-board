<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobCategory extends Model
{
    use HasFactory, HasUlids, SoftDeletes;

    protected $table = 'job_categories';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'category_id';
    protected $fillable = [
        'name',
        'slug',
        'parent_id',
    ];
    protected $dates  =[ 
      'deleted_at'
    ];
    protected function cast()  {
      return [
        'dated_at' => 'datetime',
      ];
    }
}
