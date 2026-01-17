<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class UserSkill extends Model
{
    use HasFactory, HasUlids, SoftDeletes;

    protected $table = 'user_skills';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'user_skill_id';
    protected $fillable = [
        'user_id',
        'skill_id',
        'level',
    ];
}
