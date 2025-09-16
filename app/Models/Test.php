<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $fillable = [
        'id',
        'title',
        'description',
        'max_attempts',
        'passing_score',
        'duration',
        'popularity_count',
        'status',
        'author_id',
        'theme_id',
    ];
}
