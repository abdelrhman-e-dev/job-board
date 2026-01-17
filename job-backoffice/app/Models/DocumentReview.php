<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class DocumentReview extends Model
{
    use HasFactory, HasUlids, SoftDeletes;

    protected $table = 'document_reviews';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'document_review_id';
    protected $fillable = [
        'document_id',
        'overall_score',
        'scores',
        'strengths',
        'weaknesses',
        'suggestions',
        'keywords_analysis',
        'ats_compatibility',
        'status',
        'ai_model_version',
    ];
    // relation between DocumentReview and Document
    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id', 'document_id');
    }
}
