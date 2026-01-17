<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory, HasUlids, SoftDeletes;

    protected $table = 'messages';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'message_id';
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'subject',
        'body',
        'is_read',
        'read_at',
    ];
}
