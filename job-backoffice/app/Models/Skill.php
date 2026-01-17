<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Skill extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasUlids;

    protected $primaryKey = 'skill_id';
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        'name',
        'slug',
    ];
}
