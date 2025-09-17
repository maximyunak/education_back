<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'id',
        'question_id',
        'text',
        'is_correct',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
