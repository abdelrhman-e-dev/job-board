<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory, HasUlids, SoftDeletes;

    protected $table = 'documents';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'document_id';
    protected $fillable = [
        'user_id',
        'file_name',
        'file_path',
        'type',
        'file_size',
        'file_url',
        'mime_type',
        'is_primary',
        'parsed_data',
        'deleted_at',
    ];
    protected $dates = [
        'deleted_at',
    ];
    protected $casts = [
        'parsed_data' => 'json',
    ];
    // relation between Document and Application
    public function application()
    {
        return $this->belongsTo(Application::class, 'document_id', 'document_id');
    }
    // relation between Document and document_reviews
    public function document_reviews()
    {
        return $this->hasMany(DocumentReview::class, 'document_id', 'document_id');
    }
    // relation between Document and User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
