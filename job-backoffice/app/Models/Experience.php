<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory, HasUlids, SoftDeletes;

    protected $table = 'experiences';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'experience_id';
    protected $fillable = [
        'user_id',
        'job_title',
        'company',
        'start_date',
        'end_date',
        'is_current',
        'description',
    ];
    // relation between Experience and User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }  
}
