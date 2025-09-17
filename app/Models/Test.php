<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $fillable = [
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

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
