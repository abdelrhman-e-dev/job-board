<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSkill extends Model
{
    use HasFactory, HasUlids;

    protected $table = 'job_skills';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'job_skill_id';
    protected $fillable = [
        'job_id',
        'skill_id',
        'is_required',
    ];

    public function skill()
    {
        return $this->belongsTo(Skill::class, 'skill_id', 'skill_id');
    }
}
