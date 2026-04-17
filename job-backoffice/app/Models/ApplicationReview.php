<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ApplicationReview extends Model
{
  use HasFactory, HasUlids, SoftDeletes;

  protected $table = 'application_reviews';
  protected $keyType = 'string';
  public $incrementing = false;
  protected $primaryKey = 'application_review_id';
  protected $fillable = [
    'application_id',
    'reviewer_id',
    'rating',
    'feedback',
    'recommendation',
    'deleted_at',
    'created_at',
    'updated_at',
  ];
  protected $casts = [
    'deleted_at' => 'datetime',
  ];
  // relation between ApplicationReview and Application
  public function application()
  {
    return $this->belongsTo(Application::class, 'application_id', 'application_id');
  }
  // relation between ApplicationReview and User
  public function reviewer()
  {
    return $this->belongsTo(User::class, 'reviewer_id', 'user_id');
  }
}
