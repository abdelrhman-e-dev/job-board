<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory, HasUlids, SoftDeletes;

    protected $table = 'educations';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'education_id';
    protected $fillable = [
        'user_id',
        'institution',
        'degree',
        'field_of_study',
        'start_date',
        'end_date',
        'grade',
        'description',
    ];
    // relation between Education and User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
