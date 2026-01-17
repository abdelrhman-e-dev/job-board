<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class SavedJob extends Model
{
    use HasFactory, HasUlids, SoftDeletes;

    protected $table = 'saved_jobs';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'saved_job_id';
    protected $fillable = [
        'user_id',
        'job_id',
        'notes'
    ];
}
